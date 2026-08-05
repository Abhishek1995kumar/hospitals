<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Jobs\SendMailJob;
use App\Models\Backend\Role;
use App\Traits\ValidationTrait;
use App\Models\Backend\Customer;
use App\Models\Backend\Hospital;
use App\Traits\DatabaseQueryTrait;
use App\Models\Backend\Department;
use App\Mail\CustomerRegisterMail;
use App\Http\Controllers\Controller;
use App\Models\Backend\Subscription;
use App\Services\CustomerRegistrationService;
use App\Console\Commands\CustomerSubscriptionReminder;



class CustomerController extends Controller {
    use ValidationTrait, DatabaseQueryTrait;
    protected CustomerSubscriptionReminder $subscriptionService;
    protected CustomerRegistrationService $registrationService;

    public function __construct(CustomerSubscriptionReminder $subscriptionService, CustomerRegistrationService $registrationService) {
        $this->subscriptionService = $subscriptionService;
        $this->registrationService = $registrationService;

    }

    public function index(Request $request) {
        if ($request->ajax()) {
            $view = view('backend.customer.index');
            return $view->renderSections()['content']; 
        }
        return view('backend.customer.index');
    }

    
    public function list(Request $request) {
        try {
            $customerId = authUser()->customer_id;
            $type = $request->get('type');
            $data = [];
            switch ($type) {
                case 'customer':
                    $data = $this->customerListTrait();
                    break;

                case 'hospital':
                    $data = $this->customerHospitalListTrait();
                    break;
                    
                case 'subscription':
                    $data = $this->customerSubscriptionListTrait();
                    break;

                case 'billing':
                    $data = $this->customerBillingInvoiceListTrait();
                    break;

                case 'user':
                    $data = $this->customerEmployeeListTrait();
                    break;
                
                default:
                    return response()->json(['status' => false, 'message' => 'Invalid type', 'data' => []], 400);
            }

            return response()->json([
                'status' => true,
                'data'   => $data
            ], 200);

        } catch(Throwable $th) {
            Log::error("Error while getting data : " . $th->getMessage());
            return json_response(false, 500, "Something went wrong: " . $th->getMessage());
        }
    }



    // Customer Create and Save
        public function create(Request $request) {
            $countries = DB::table('countries')->pluck('id', 'name')->toArray();
            if ($request->ajax()) {
                $view = view('backend.customer.create', compact('countries'));
                return $view->renderSections()['content'];
            }
            return view('backend.customer.index'); // Normal load par index par hi rakhe
        }


        public function saveFromSuperAdminPanel(Request $request) {
            try {
                $data = $request->all();
                $validation = $this->validationCustomerTait($data);
                if ($validation) {
                    return json_response(false, 410, "Validation failed", $validation);
                }

                $customerData = $this->registrationService->register($data); // Register Customer via Service
                SendMailJob::dispatch(
                    $customerData['email'],
                    [
                        'name'     => $customerData['name'],
                        'email'    => $customerData['email'],
                        'password' => $customerData['password']
                    ],
                    'Registration Successful',
                    'backend.emails.customer_register',
                    CustomerRegisterMail::class
                );

                // Log Action
                storeLog("Customer Registration");

                return json_response(true, 200, "Customer created successfully.");

            } catch (\Throwable $th) {
                \Log::error("Customer Save Error: " . $th->getMessage());
                return json_response(false, 500, "Something went wrong: " . $th->getMessage());
            }
        }
    // End Customer Create and Save



    // Employee Create and Save
        public function employeeCreate(Request $request) {
            $countries = DB::table('countries')->pluck('id', 'name')->toArray();
            $roles = Role::all();
            if ($request->ajax()) {
                $view = view('backend.customer.employee_create', compact('countries', 'roles'));
                return $view->renderSections()['content'];
            }
        }

        public function employeeSave(Request $request) {
            try {
                $data = $request->all();
                $validation = $this->validationEmployeeTrait($data);
                if ($validation) {
                    return json_response(false, 410, "Validation failed", $validation);
                }

                // Create User
                $user = new User();
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = Hash::make($data['password']);
                $user->customer_id = authUser()->customer_id; // Assign to the logged-in customer's ID
                $user->role_id = $data['role_id'];
                $user->save();

                // Log Action
                storeLog("Employee Created");

                return json_response(true, 200, "Employee created successfully.");

            } catch (\Throwable $th) {
                \Log::error("Employee Save Error: " . $th->getMessage());
                return json_response(false, 500, "Something went wrong: " . $th->getMessage());
            }
        }
    // End Employee Create and Save




    // Get States and Cities
        public function getStates($country_id) {
            $states = DB::table('states')
                        ->where('country_id', $country_id)
                        ->pluck('name', 'id'); // [id => name] array return karega

            return response()->json($states);
        }

        public function getCities($state_id) {
            $states = DB::table('cities')
                        ->where('state_id', $state_id)
                        ->pluck('name', 'id'); // [id => name] array return karega

            return response()->json($states);
        }

}
