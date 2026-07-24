<?php

namespace App\Services;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Backend\Role;
use App\Traits\ValidationTrait;
use App\Models\Backend\Customer;
use App\Models\Backend\Hospital;
use App\Models\Backend\Department;
use App\Mail\CustomerRegisterMail;
use Illuminate\Support\Facades\DB;
use App\Models\Backend\Subscription;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;



class CustomerRegistrationService {
    public function register(array $data): array {
        DB::beginTransaction();
        try {
            $planId = (int) $data['plan_name'];
            $planRecord = DB::table('plans')->where('id', $planId)->where('status', 1)->first();
            if (!$planRecord) {
                throw new \Exception("Plan not found or inactive.");
            }

            // 1. Create Customer
            $customer = new Customer();
            $generatedCustId = generateUniqueCustomerCode(); 
            if (!$generatedCustId) {
                throw new \Exception("Failed to generate a unique Customer Code.");
            }
            $customer->customer_id = $generatedCustId;
            $customer->customer_name = trim($data['customer_name']);
            $customer->customer_slug = str_replace(' ', '_', strtolower(trim($data['customer_name'])));
            $customer->email = secure(trim($data['email']), 'E');
            $customer->mobile_no = secure(trim($data['mobile_no']), 'E');
            $customer->alternate_mobile = secure(trim($data['alternate_mobile']), 'E');
            $customer->website = trim($data['website']);
            $customer->is_trial = ($planRecord->price == 0) ? 1 : 0;
            $customer->country = (int) trim($data['country_name']);
            $customer->state = (int) trim($data['state_name']);
            $customer->city = (int) trim($data['city_name']);
            $customer->address = trim($data['address']);
            $customer->save(); 

            $lastCustId = $customer->id; 
            if (!$lastCustId) {
                throw new \Exception("Customer saved but Primary Auto-Increment ID not returned.");
            }
            
            // 2. Create Default Hospital/Clinic
            $hospital = new Hospital();
            $hospitalName = explode(' ', trim($data['customer_name']));
            $generatedHospId = generateUniqueHospitalId(); 
            if (!$generatedHospId) {
                throw new \Exception("Failed to generate a unique hospital code.");
            }
            $hospital->customer_id = $lastCustId;
            $hospital->hospital_id = $generatedHospId;
            $hospital->name = array_shift($hospitalName);
            $hospital->email = secure(trim($data['email']), 'E');
            $hospital->phone = secure(trim($data['mobile_no']), 'E');
            $hospital->is_hospital_clinic = (int) trim($data['is_hospital_clinic']);
            $hospital->save();

            $lastHospId = $hospital->id;
            if (!$lastHospId) {
                throw new \Exception("Hospital saved but Primary Auto-Increment ID not returned.");
            }

            // 3. Create Default Department
            $department = new Department();
            $generatedDeptId = generateDepartmentId(); 
            if (!$generatedDeptId) {
                throw new \Exception("Failed to generate a unique department code.");
            }
            $department->customer_id = $lastCustId;
            $department->hospital_id = $lastHospId;
            $department->firm_id = NULL;
            $department->department_id = $generatedDeptId;
            $department->name = 'Customer Administrator';
            $department->description = 'Customer administrator department';
            $department->status = 1;
            $department->updated_at = NULL;
            $department->save();

            $lastDeptId = $department->id; 
            if (!$lastDeptId) {
                throw new \Exception("Department saved but Primary Auto-Increment ID not returned.");
            }

            // 4. Create Customer Admin User
            $explodeName = explode(' ', trim($data['customer_name']));
            $plainPassword = generateUserPassword(8);
            
            $user = new User();
            $user->is_system = 1;
            $user->customer_id = $lastCustId;
            $user->hospital_id = $lastHospId;
            $user->department_id = $lastDeptId;
            $user->user_id = 'U_' . rand(100000, 999999);
            $user->fname = array_shift($explodeName);
            $user->lname = !empty($explodeName) ? implode(' ', $explodeName) : '';
            $user->username = generateUniqueUsername(trim($data['email']));
            $user->email = secure(trim($data['email']), 'E');
            $user->phone = secure(trim($data['mobile_no']), 'E');
            $user->user_type = 3;
            $user->gender = 'male';
            $user->created_by = auth()->user()->id;
            $user->password = Hash::make($plainPassword);
            $user->default_password = secure($plainPassword, 'E');
            $user->save();
            $lastUserId = $user->id;
            
            // 5. Assign Role
            $role = new Role();
            $role->customer_id = $lastCustId;
            $role->hospital_id = $lastHospId;
            $role->firm_id = NULL;
            $role->name = 'Customer Admin';
            $role->code = 'customer_admin';
            $role->role_priority = 100;
            $role->protected_role = 0;
            $role->scope = 1;
            $role->is_system = 1;
            $role->status = 1;
            $role->created_by = auth()->user()->id;
            $role->updated_at = NULL;
            $role->save();
            $lastRoleId = $role->id;

            DB::table('user_roles')->insert([
                'customer_id' => $lastCustId, 
                'hospital_id' => $lastHospId,
                'role_id'     => $lastRoleId,
                'user_id'     => $lastUserId
            ]);

            // 6. Create Subscription
            $subscription = new Subscription();
            $subscription->customer_id = $lastCustId;
            $subscription->plan_id = $planRecord->id;
            $subscription->amount = $planRecord->price;
            $subscription->start_date = now();
            $subscription->payment_gateway = 3;
            $subscription->payment_status = 1;
            $subscription->end_date = now()->addDays($planRecord->duration_days);
            $subscription->invoice_no = generateInvoiceId();
            $subscription->transaction_id = generateTransactionId();
            $subscription->save();

            // Update Customer Subscription Data
            $customer->max_hospitals = $planRecord->max_hospitals;
            $customer->max_users = $planRecord->max_users;
            $customer->max_firms = $planRecord->max_firms;
            $customer->current_plan_id = $planRecord->id;
            $customer->trial_end_date = now()->addDays($planRecord->duration_days);
            $customer->subscription_start_date = $subscription->start_date;
            $customer->subscription_end_date = $subscription->end_date;
            $customer->last_payment_date = $subscription->start_date;
            $customer->next_billing_date = $subscription->end_date->copy()->addDay();
            $customer->subscription_status = 1; 
            $customer->save();
            DB::commit();
            return [
                'email'    => trim($data['email']),
                'name'     => trim($data['customer_name']),
                'password' => $plainPassword
            ];

        } catch (Throwable $th) {
            DB::rollback();
            throw $th; // Exception throw karna zaroori hai taaki controller catching sambhal sake
        }
    }

}


