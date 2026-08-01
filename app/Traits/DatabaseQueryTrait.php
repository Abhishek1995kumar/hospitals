<?php

namespace App\Traits;

use Exception;
use Throwable;
use App\Models\Logs;
use App\Models\User;
use App\Mail\OtpVerified;
use App\Models\Admin\LoginOtp;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

trait DatabaseQueryTrait {
    // customer list queries function start
        public function customerListTrait() {
            try {
                $customerId = authUser()->customer_id;
                if(empty($customerId)) {
                    $superAdminQuerys = DB::select("SELECT 
                        c.id AS customer_table_id, c.customer_name, c.email, c.mobile_no, c.subscription_status, c.trial_end_date, 
                        DATE_FORMAT(c.subscription_start_date, '%d %M %Y') AS sub_start_date, 
                        DATE_FORMAT(c.subscription_end_date, '%d %M %Y') AS sub_end_date, 
                        p.plan_name, p.price AS plan_price,
                        cs.invoice_no, cs.transaction_id, cs.amount AS paid_amount, 
                        CASE cs.payment_status
                            WHEN 1 THEN 'Razorpay'
                            WHEN 2 THEN 'Stripe'
                            WHEN 3 THEN 'Cash'
                            WHEN 4 THEN 'Bank Transfer'
                            ELSE 'Mango Pay'
                        END AS payment_status,
                        GROUP_CONCAT(DISTINCT f.feature_name SEPARATOR ', ') AS plan_features
                        FROM customers c
                        JOIN plans p ON p.id = c.current_plan_id
                        JOIN customer_subscriptions cs ON cs.customer_id = c.id AND cs.status = 1
                        LEFT JOIN feature_plans fp ON fp.plan_id = p.id
                        LEFT JOIN features f ON f.id = fp.feature_id AND f.status = 1
                        WHERE c.status = 1
                        GROUP BY c.id, cs.id;
                    ");
                    $data = array_map(function($query) {
                                return [
                                    'customer_table_id'       => $query->customer_table_id,
                                    'customer_name'           => $query->customer_name,
                                    'email'                   => secure($query->email, 'D'),
                                    'mobile_no'               => secure($query->mobile_no, 'D'),
                                    'plan_name'               => $query->plan_name,
                                    'subscription_status'     => $query->subscription_status,
                                    'trial_end_date'          => $query->trial_end_date,
                                    'subscription_start_date' => $query->sub_start_date,
                                    'subscription_end_date'   => $query->sub_end_date,
                                    'plan_price'              => $query->plan_price,
                                    'invoice_no'              => $query->invoice_no,
                                    'transaction_id'          => $query->transaction_id,
                                    'paid_amount'             => $query->paid_amount,
                                    'payment_status'          => $query->payment_status,
                                    'plan_features'           => $query->plan_features ?? '--',
                                ];
                        }, $superAdminQuerys
                    );
                } else {
                    $queries = DB::select("SELECT c.id AS customer_table_id, c.customer_name, c.mobile_no, c.max_hospitals, c.max_users, c.max_firms, 
                                        C.subscription_status, 
                                        DATE_FORMAT(c.subscription_start_date, '%d %M %Y') AS sub_start_date, 
                                        DATE_FORMAT(c.subscription_end_date, '%d %M %Y') AS sub_end_date, 
                                        p.id AS plan_id, p.plan_name, p.duration_days, m.name AS module_name, GROUP_CONCAT(DISTINCT f.feature_name SEPARATOR ', ') AS plan_features
                                        FROM customers c 
                                        JOIN plans p ON p.id = c.current_plan_id 
                                        LEFT JOIN feature_plans fp ON fp.plan_id = p.id 
                                        LEFT JOIN features f ON f.id = fp.feature_id 
                                        LEFT JOIN modules m ON m.id = f.module_id 
                                        WHERE c.id=? AND c.status=1 AND c.subscription_status=1
                                        GROUP BY c.id, p.id, f.id; -- Active Subscription
                    ");
                    $customerQuerys = DB::select($queries, [$customerId]);
                    $data = array_map(function($query) {
                            return [
                                'customer_table_id'         => $query->customer_table_id,
                                'customer_name'             => $query->customer_name,
                                'mobile_no'                 => secure($query->mobile_no, 'D'),
                                'plan_name'                 => $query->plan_name,
                                'subscription_status'       => $query->subscription_status,
                                'subscription_start_date'   => $query->sub_start_date,
                                'subscription_end_date'     => $query->sub_end_date,
                                'plan_features'             => $query->plan_features ?? '--',
                            ];
                        }, $customerQuerys
                    );
                }
                return $data;

            } catch(Throwable $th) {
                Log::error($th->getMessage());
                return [];
            }
        }

        public function customerSubscriptionListTrait() {
            try {
                $customerId = authUser()->customer_id;
                if(empty($customerId)) {
                    $queries = DB::select("SELECT 
                                    c.id AS customer_id,
                                    c.customer_name,
                                    c.mobile_no,
                                    c.subscription_end_date,
                                    DATE_FORMAT(c.subscription_start_date, '%d %M %Y') AS sub_start_date, 
                                    DATEDIFF(c.subscription_end_date, CURDATE()) AS days_left,
                                    p.plan_name
                                FROM customers c
                                JOIN plans p ON p.id = c.current_plan_id
                                WHERE c.subscription_status = 1;
                    ");
                    $data = array_map(function($query) {
                                return [
                                    'customer_id'               => $query->customer_id,
                                    'customer_name'             => $query->customer_name,
                                    'mobile_no'                 => secure($query->mobile_no, 'D'),
                                    'plan_name'                 => $query->plan_name,
                                    'subscription_end_date'     => $query->subscription_end_date,
                                    'days_left'                 => $query->days_left . ' Day',
                                ];
                        }, $queries
                    );
                    
                } else {
                    $queries = "SELECT cs.id AS subscription_id,
                                            cs.amount, p.plan_name,
                                            DATE_FORMAT(cs.start_date, '%d %M %Y') AS start_date, 
                                            DATE_FORMAT(cs.end_date, '%d %M %Y') AS end_date,
                                            CASE
                                                WHEN cs.payment_gateway = 1 THEN 'Razorpay'
                                                WHEN cs.payment_gateway = 2 THEN 'Stripe'
                                                WHEN cs.payment_gateway = 3 THEN 'Cash'
                                                WHEN cs.payment_gateway = 4 THEN 'Bank Transfer'
                                                WHEN cs.payment_gateway = 5 THEN 'Mango Pay'
                                            END AS gateway_name,
                                            CASE 
                                                WHEN cs.payment_status = 1 THEN 'Success'
                                                WHEN cs.payment_status = 2 THEN 'Pending'
                                                WHEN cs.payment_status = 3 THEN 'Failed'
                                            END AS status_text
                                        FROM customer_subscriptions cs
                                        JOIN plans p ON p.id = cs.plan_id
                                        WHERE cs.customer_id=? -- Specific Customer ID
                                        ORDER BY cs.id DESC;
                    ";
                    $active = DB::select($queries, [$customerId]);
                    $data = array_map(function($query) {
                                return [
                                    'subscription_id' => $query->subscription_id,
                                    'amount'          => $query->amount,
                                    'plan_name'       => $query->plan_name,
                                    'start_date'      => $query->start_date,
                                    'end_date'        => $query->end_date,
                                    'gateway_name'    => $query->gateway_name,
                                    'status_text'     => $query->status_text,
                                ];
                        }, $queries
                    );
                }
                return $data;
                
            } catch(Throwable $th) {
                Log::error($th->getMessage());
                return [];
            }
        }

        public function customerBillingInvoiceListTrait() {
            try {
                $customerId = authUser()->customer_id;
                if(empty($customerId)) {
                    $queries = DB::select("SELECT cs.id AS subscription_id, cs.invoice_no, cs.transaction_id,
                                cs.amount, 
                                DATE_FORMAT(cs.start_date, '%d %M %Y') AS start_date, 
                                DATE_FORMAT(cs.end_date, '%d %M %Y') AS end_date,
                                p.plan_name,
                                CASE cs.payment_gateway
                                    WHEN 1 THEN 'Razorpay'
                                    WHEN 2 THEN 'Stripe'
                                    WHEN 3 THEN 'Cash'
                                    WHEN 4 THEN 'Bank Transfer'
                                    WHEN 5 THEN 'Mango Pay'
                                END AS gateway_name,
                                CASE cs.payment_status
                                    WHEN 1 THEN 'Success'
                                    WHEN 2 THEN 'Pending'
                                    WHEN 3 THEN 'Failed'
                                END AS status_text,
                                cs.status AS is_current_plan
                            FROM customer_subscriptions cs
                            JOIN plans p ON p.id = cs.plan_id
                            ORDER BY cs.id DESC;
                    ");
                    $data = array_map(function($query) {
                                return [
                                    'subscription_id' => $query->subscription_id,
                                    'amount'          => $query->amount,
                                    'plan_name'       => $query->plan_name,
                                    'start_date'      => $query->start_date,
                                    'end_date'        => $query->end_date,
                                    'gateway_name'    => $query->gateway_name,
                                    'status_text'     => $query->status_text,
                                ];
                        }, $queries
                    );
                } else {
                    $query = "SELECT cs.id AS subscription_id, cs.invoice_no, cs.transaction_id,
                                cs.amount, 
                                DATE_FORMAT(cs.start_date, '%d %M %Y') AS start_date, 
                                DATE_FORMAT(cs.end_date, '%d %M %Y') AS end_date,
                                p.plan_name,
                                CASE cs.payment_gateway
                                    WHEN 1 THEN 'Razorpay'
                                    WHEN 2 THEN 'Stripe'
                                    WHEN 3 THEN 'Cash'
                                    WHEN 4 THEN 'Bank Transfer'
                                    WHEN 5 THEN 'Mango Pay'
                                END AS gateway_name,
                                CASE cs.payment_status
                                    WHEN 1 THEN 'Success'
                                    WHEN 2 THEN 'Pending'
                                    WHEN 3 THEN 'Failed'
                                END AS status_text,
                                cs.status AS is_current_plan
                            FROM customer_subscriptions cs
                            JOIN plans p ON p.id = cs.plan_id
                            WHERE cs.customer_id=?
                            ORDER BY cs.id DESC;
                    ";
                    $invoice = DB::select($query, [$customerId]);
                    $data = array_map(function($query) {
                                return [
                                    'subscription_id' => $query->subscription_id,
                                    'amount'          => $query->amount,
                                    'plan_name'       => $query->plan_name,
                                    'invoice_no'      => $query->invoice_no,
                                    'transaction_id'  => $query->transaction_id,
                                    'start_date'      => $query->start_date,
                                    'end_date'        => $query->end_date,
                                    'gateway_name'    => $query->gateway_name,
                                    'status_text'     => $query->status_text,
                                ];
                        }, $invoice
                    );
                }
                return $data;
                
            } catch(Throwable $th) {
                Log::error($th->getMessage());
                return [];
            }
        }

        public function customerHospitalListTrait() {
            try {
                $customerId = authUser()->customer_id;
                if(empty($customerId)) {
                    $query = "SELECT h.id AS hospital_id, h.name AS hospital_name, h.phone, 
                                h.license_no, h.registration_no, DATE_FORMAT(h.license_expiry_date, '%d %F %Y') AS license_expiry_date, 
                                c.max_hospitals, c.max_users, c.max_firms,
                                CASE 
                                    WHEN h.hospital_type = 1 THEN 'General'
                                    WHEN h.hospital_type = 2 THEN 'Speciality'
                                    WHEN h.hospital_type = 3 THEN 'Multi Speciality'
                                    WHEN h.hospital_type = 4 THEN 'Clinic'
                                    WHEN h.hospital_type = 5 THEN 'Diagnostic Center'
                                    ELSE 'Other'
                                END hospital_type,
                                c.customer_name, f.name AS firm_name, f.address AS firm_address
                                FROM hospitals h 
                                JOIN customers c ON c.id = h.customer_id AND c.subscription_status=1 AND c.status=1
                                LEFT JOIN firms f ON f.hospital_id = h.id AND f.status=1 
                                WHERE h.status = 1;
                    ";
                    $limitQuotaUsageVerification = DB::select($query);
                    $data = array_map(function($query) {
                            return [
                                'hospital_name'       => $query->hospital_name,
                                'customer_name'       => $query->customer_name,
                                'max_hospitals'       => $query->max_hospitals,
                                'max_users'           => $query->max_users,
                                'max_firms'           => $query->max_firms,
                                'phone'               => secure($query->phone, 'D'),
                                'license_no'          => $query->license_no,
                                'registration_no'     => $query->registration_no,
                                'license_expiry_date' => $query->license_expiry_date,
                                'hospital_type'       => $query->hospital_type,
                                'firm_address'        => $query->firm_address ?? '--',
                            ];
                        }, $limitQuotaUsageVerification
                    );
                    
                } else {
                    $query = "SELECT h.id AS hospital_id, h.name AS hospital_name, h.phone, 
                                h.license_no, h.registration_no, DATE_FORMAT(h.license_expiry_date, '%d %F %Y') AS license_expiry_date, 
                                c.max_hospitals, c.max_users, c.max_firms,
                                CASE 
                                    WHEN h.hospital_type = 1 THEN 'General'
                                    WHEN h.hospital_type = 2 THEN 'Speciality'
                                    WHEN h.hospital_type = 3 THEN 'Multi Speciality'
                                    WHEN h.hospital_type = 4 THEN 'Clinic'
                                    WHEN h.hospital_type = 5 THEN 'Diagnostic Center'
                                    ELSE 'Other'
                                END hospital_type,
                                c.customer_name, f.name AS firm_name, f.address AS firm_address
                                FROM hospitals h 
                                JOIN customers c ON c.id = h.customer_id AND c.subscription_status=1 AND c.status=1
                                LEFT JOIN firms f ON f.hospital_id = h.id AND f.status=1 
                                WHERE h.status = 1 AND c.id=?; 
                    ";
                    $limitQuotaUsageVerification = DB::select($query, [$customerId]);
                    $data = array_map(function($query) {
                            return [
                                'hospital_name'       => $query->hospital_name,
                                'customer_name'       => $query->customer_name,
                                'phone'               => secure($query->phone, 'D'),
                                'license_no'          => $query->license_no,
                                'registration_no'     => $query->registration_no,
                                'license_expiry_date' => $query->license_expiry_date,
                                'hospital_type'       => $query->hospital_type,
                                'firm_address'        => $query->firm_address ?? '--',
                            ];
                        }, $limitQuotaUsageVerification
                    );
                }
                return $data;

            } catch(Throwable $th) {
                Log::error($th->getMessage());
                return [];
            }
        }


        public function customerEmployeeListTrait() {
            try {
                $customerId = authUser()->customer_id;
                if(empty($customerId)) {
                    $queries = "SELECT u.id, CONCAT(u.fname, ' ' , u.lname) AS user_name, h.name AS hospital_name, u.user_id,
                                c.customer_name, f.name AS firm_name, f.address AS firm_address, f.firm_id,
                                CASE 
                                    WHEN u.user_type = 1 THEN 'Super Admin'
                                    WHEN u.user_type = 2 THEN 'Admin'
                                    WHEN u.user_type = 3 THEN 'Customer Admin'
                                    WHEN u.user_type = 4 THEN 'Hospital Admin'
                                    WHEN u.user_type = 5 THEN 'HR'
                                    WHEN u.user_type = 6 THEN 'Manager'
                                    WHEN u.user_type = 7 THEN 'Leader'
                                    WHEN u.user_type = 8 THEN 'Employee'
                                    ELSE 'Other'
                                END user_type,
                                CASE 
                                    WHEN u.status = 1 THEN 'Active'
                                    ELSE 'Inactive'
                                END user_status,
                                CASE 
                                    WHEN h.hospital_type = 1 THEN 'General'
                                    WHEN h.hospital_type = 2 THEN 'Speciality'
                                    WHEN h.hospital_type = 3 THEN 'Multi Speciality'
                                    WHEN h.hospital_type = 4 THEN 'Clinic'
                                    WHEN h.hospital_type = 5 THEN 'Diagnostic Center'
                                    ELSE 'Other'
                                END hospital_type                          
                                FROM users u
                                LEFT JOIN customers c ON c.id = u.customer_id AND c.subscription_status=1 AND c.status=1
                                LEFT JOIN hospitals h ON h.id = u.hospital_id AND h.status=1
                                LEFT JOIN firms f ON f.hospital_id = h.id AND f.status=1 
                                LEFT JOIN departments d ON d.id = u.department_id AND d.status=1 
                                WHERE u.is_system = 1 AND u.status=1;
                    ";
                    $employees = DB::select($queries);
                    $data = array_map(function($query) {
                            return [
                                'id'            => $query->id,
                                'customer_name' => $query->customer_name,
                                'user_name'     => $query->user_name,
                                'hospital_name' => $query->hospital_name,
                                'firm_name'     => $query->firm_name,
                                'firm_address'  => $query->firm_address,
                                'firm_id'       => $query->firm_id,
                                'user_type'     => $query->user_type,
                                'user_status'   => $query->user_status,
                                'hospital_type' => $query->hospital_type,
                            ];
                        }, $employees
                    );
                     
                } else {
                    $query = "SELECT u.id, CONCAT(u.fname, ' ' , u.lname) AS user_name, h.name AS hospital_name, u.user_id,
                                c.customer_name, f.name AS firm_name, f.address AS firm_address, f.firm_id,
                                CASE 
                                    WHEN u.user_type = 1 THEN 'Super Admin'
                                    WHEN u.user_type = 2 THEN 'Admin'
                                    WHEN u.user_type = 3 THEN 'Customer Admin'
                                    WHEN u.user_type = 4 THEN 'Hospital Admin'
                                    WHEN u.user_type = 5 THEN 'HR'
                                    WHEN u.user_type = 6 THEN 'Manager'
                                    WHEN u.user_type = 7 THEN 'Leader'
                                    WHEN u.user_type = 8 THEN 'Employee'
                                    ELSE 'Other'
                                END user_type,
                                CASE 
                                    WHEN u.status = 1 THEN 'Active'
                                    ELSE 'Inactive'
                                END user_status,
                                CASE 
                                    WHEN h.hospital_type = 1 THEN 'General'
                                    WHEN h.hospital_type = 2 THEN 'Speciality'
                                    WHEN h.hospital_type = 3 THEN 'Multi Speciality'
                                    WHEN h.hospital_type = 4 THEN 'Clinic'
                                    WHEN h.hospital_type = 5 THEN 'Diagnostic Center'
                                    ELSE 'Other'
                                END hospital_type,                              
                                FROM users u
                                JOIN customers c ON c.id = u.customer_id AND c.subscription_status=1 AND c.status=1
                                JOIN hospitals h ON h.id = u.hospital_id AND h.status=1
                                JOIN firms f ON f.hospital_id = h.id AND f.status=1 
                                LEFT JOIN departments d ON d.id = u.department_id AND d.status=1 
                                WHERE u.is_system = 1 AND u.status=1 AND c.id=?;
                    ";
                    $employees = DB::select($query, [$customerId]);
                    $data = array_map(function($query) {
                            return [
                                'id'            => $query->id,
                                'customer_name' => $query->customer_name,
                                'user_name'     => $query->user_name,
                                'hospital_name' => $query->hospital_name,
                                'firm_name'     => $query->firm_name,
                                'firm_address'  => $query->firm_address,
                                'firm_id'       => $query->firm_id,
                                'user_type'     => $query->user_type,
                                'user_status'   => $query->user_status,
                                'hospital_type' => $query->hospital_type,
                            ];
                        }, $employees
                    );
                }
                return $data;

            } catch(Throwable $th) {
                Log::error($th->getMessage());
                return [];
            }
        }
    // customer list queries function end



    // Role permission management query start
        public function authModuleListTrait() {
            return DB::table('modules')
                    ->where('status', 1)
                    ->whereNull('parent_id')
                    ->orderBy('name')
                    ->select('name', 'id')
                    ->get();
        }

        public function loggedInRolesTrait($user) {
            return DB::table('user_roles')
                    ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                    ->join('users', 'users.id', '=', 'user_roles.user_id')
                    ->where('user_roles.user_id', $user->id)
                    ->select('roles.id', 'roles.code', 'roles.is_system', 'roles.scope', 'roles.customer_id', 'roles.hospital_id', 'roles.firm_id', 'roles.is_full_access', 'users.user_type')
                    ->get();
        }

        public function roleTrait() {
            return DB::table('roles')
                    ->select('id', 'name', 'code', 'is_system', 'scope', 'customer_id', 'hospital_id', 'firm_id', 'role_priority', 'is_full_access')
                    ->where('status', 1)
                    ->where('is_system', 0)
                    ->where('scope', 0);
        }

        public function customerRoleTrait($customerId) {
            return DB::table('roles')
                    ->select('id', 'name', 'code', 'is_system', 'scope', 'customer_id', 'hospital_id', 'firm_id', 'role_priority', 'is_full_access')
                    ->where('status', 1)
                    ->where('is_system', 1)
                    ->where('scope', 1)
                    ->where('customer_id', $customerId);

        }

        public function permissionTrait() {
            return DB::table('permissions')
                        ->leftJoin('modules', 'modules.id', '=', 'permissions.module_id')
                        ->select('permissions.id', 'modules.name as modules_name', 'permissions.name', 'permissions.action AS permission_action')
                        ->where('permissions.status', 1)
                        ->get();
        }

        public function rolePermissionTrait() {
            return DB::select("SELECT rp.id, r.name AS role_name, p.action as permission_action, r.customer_id, rp.customer_id FROM role_permissions rp
                    JOIN roles r ON r.id = rp.role_id AND r.status=1
                    JOIN permissions P ON p.id = rp.permission_id
                    WHERE rp.customer_id IS NULL
            ");
        }

        public function customerRolePermissionTrait($customerId) {
            return DB::table('role_permissions')
                    ->leftJoin('roles', 'roles.id', '=', 'role_permissions.role_id')
                    ->leftJoin('permissions', 'permissions.id', '=', 'role_permissions.permission_id')
                    ->select('role_permissions.id', 'roles.name as role_name', 'permissions.action as permission_action', 'roles.customer_id', 'role_permissions.customer_id')
                    ->where('role_permissions.customer_id', $customerId)
                    ->get();
        }

        public function userRoleTrait() {
            return DB::select("SELECT  ur.id user_role_id, CONCAT(u.fname, ' ', u.lname) user_name, r.name AS role_name FROM `users` u
                            JOIN user_roles ur ON ur.user_id = u.id
                            JOIN roles r ON r.id = ur.role_id
                            WHERE ur.customer_id IS NULL AND u.is_system=0
            ");
        }

        public function customerUserRoleTrait($customerId) {
            $data = "SELECT  ur.id user_role_id, CONCAT(u.fname, ' ', u.lname) user_name, r.name AS role_name FROM `users` u
                            JOIN user_roles ur ON ur.user_id = u.id
                            JOIN roles r ON r.id = ur.role_id
                            WHERE ur.customer_id IS NOT NULL AND u.is_system=0 AND ur.customer_id=?
            ";
            return DB::select($data, [$customerId]);
        }

        public function moduleTrait() {
            return DB::select("SELECT id, name,
                    CASE 
                        WHEN status=1 THEN 'Active'
                        ELSE 'Inactive'
                    END module_status
                    FROM modules
                    WHERE parent_id IS NULL
                ");
        }

        public function childModuleTrait() {
            return DB::select("SELECT m.id, m.name AS child_name, mp.name as parent_name,
                    CASE 
                        WHEN m.status=1 THEN 'Active'
                        ELSE 'Inactive'
                    END module_status 
                    FROM modules m
                    JOIN modules mp ON mp.id = m.parent_id
                    WHERE m.parent_id IS NOT NULL
                ");
        }

        public function customerUserListTrait($customerId) {
            return DB::table('users')
                    ->select('id', 'fname', 'lname', 'user_type')
                    ->where('status', 1)
                    ->where('customer_id', $customerId);
        }
    // Role permission management query end



    // Pharmacy management query start
        public function madicineListTrait() {
            $data = DB::table('pharmacy_medicines')
                        ->leftJoin('pharmacy_suppliers', 'pharmacy_suppliers.id', '=', 'pharmacy_medicines.pharmacy_supplier_id')
                        ->leftJoin('pharmacy_categories', 'pharmacy_categories.id', '=', 'pharmacy_medicines.category_id') // Corrected Join
                        ->select(
                            'pharmacy_medicines.id', 'pharmacy_medicines.brand_name', 'pharmacy_medicines.generic_name', 'pharmacy_medicines.hsn_code', 
                            'pharmacy_medicines.drug_type', 'pharmacy_medicines.unit_of_measure', 'pharmacy_medicines.min_reorder_level', 
                            'pharmacy_medicines.rack_number', 'pharmacy_medicines.shelf_number',
                            'pharmacy_suppliers.name as supplier_name', 
                            'pharmacy_categories.name as category_name'
            )// ->where('pharmacy_medicines.customer_id', authUser()->customer_id) // Added Table Prefix
            ->get();
            return $data;
        }


        public function batchMadicineListTrait() {
            $data = DB::table('pharmacy_medicine_batches')
                        ->leftJoin('pharmacy_medicines', 'pharmacy_medicines.id', '=', 'pharmacy_medicine_batches.medicine_id')
                        ->leftJoin('pharmacy_suppliers', 'pharmacy_suppliers.id', '=', 'pharmacy_medicines.pharmacy_supplier_id')
                        ->leftJoin('pharmacy_categories', 'pharmacy_categories.id', '=', 'pharmacy_medicines.category_id')
                        ->select(
                            'pharmacy_medicine_batches.id', 'pharmacy_medicine_batches.mfg_date', 'pharmacy_medicine_batches.expiry_date',
                            'pharmacy_medicine_batches.purchase_qty', 'pharmacy_medicine_batches.current_qty', 'pharmacy_medicine_batches.unit_cost_price',
                            'pharmacy_medicine_batches.unit_mrp', 'pharmacy_medicine_batches.selling_price', 'pharmacy_medicine_batches.tax_percentage',
                            'pharmacy_medicine_batches.batch_number',
                            'pharmacy_medicines.generic_name', 'pharmacy_medicines.brand_name',
                            'pharmacy_suppliers.name as supplier_name'
            ) // ->where('pharmacy_medicines.customer_id', authUser()->customer_id)
            ->get();
            return $data;
        }


        public function firstExpireFirstOut() { 
            $data = DB::select("SELECT b.id AS batch_id, b.batch_number,
                        b.current_qty, b.expiry_date, b.unit_mrp, b.selling_price
                        FROM pharmacy_medicine_batches b
                        WHERE b.expiry_date >= CURDATE() 
                        AND b.customer_id=?
                        AND b.medicine_id=?
                        AND b.current_qty > 0
                        ORDER BY b.expiry_date ASC
            ");
            return $data;
        }

        public function expiredMedicineAlert() { 
            $data = DB::select("SELECT m.brand_name, m.generic_name, b.batch_number, b.current_qty,
                            b.expiry_date, s.company_name AS supplier_name
                        FROM pharmacy_medicine_batches b
                        JOIN pharmacy_medicines m ON m.id = b.medicine_id
                        LEFT JOIN pharmacy_suppliers s ON s.id = b.pharmacy_supplier_id
                        WHERE b.customer_id=? 
                        AND b.current_qty > 0 
                        AND b.expiry_date < CURDATE();
            ");
            return $data;
        }

        public function nearExpiryWarning() { 
            $data = DB::select("SELECT m.brand_name, b.batch_number, b.current_qty,
                            b.expiry_date, DATEDIFF(b.expiry_date, CURDATE()) AS days_left
                        FROM pharmacy_medicine_batches b
                        JOIN pharmacy_medicines m ON m.id = b.medicine_id
                        WHERE b.customer_id=?
                        AND b.current_qty > 0 
                        AND b.expiry_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 60 DAY)
                        ORDER BY b.expiry_date ASC;
            ");
            return $data;
        }

        public function lowStockAndReorderAlerts() { 
            $data = DB::select("SELECT m.id AS medicine_id, m.brand_name, m.generic_name,
                            m.min_reorder_level, COALESCE(SUM(b.current_qty), 0) AS total_available_qty,
                            s.company_name AS preferred_supplier
                        FROM pharmacy_medicines m
                        LEFT JOIN pharmacy_medicine_batches b ON b.medicine_id = m.id AND b.expiry_date >= CURDATE()
                        LEFT JOIN pharmacy_suppliers s ON s.id = m.pharmacy_supplier_id
                        WHERE m.customer_id=? 
                        AND m.status = 1
                        GROUP BY m.id, m.brand_name, m.generic_name, m.min_reorder_level, s.company_name
                        HAVING total_available_qty <= m.min_reorder_level;
            ");
            return $data;
        }

        public function medicineSearchAndLocation() { 
            $data = DB::select("SELECT m.brand_name, m.generic_name, m.rack_number,
                        m.shelf_number, c.name AS category_name, SUM(b.current_qty) AS stock_available
                    FROM pharmacy_medicines m
                    LEFT JOIN pharmacy_categories c ON c.id = m.category_id
                    LEFT JOIN pharmacy_medicine_batches b ON b.medicine_id = m.id
                    WHERE m.customer_id = ? 
                    AND m.brand_name LIKE '%?%'
                    GROUP BY m.id, m.brand_name, m.generic_name, m.rack_number, m.shelf_number, c.name;
            ");
            return $data;
        }

        public function scheduleHNarcoticMedicinesList() {
            $data = DB::select("SELECT m.brand_name, m.generic_name, m.hsn_code,
                        CASE 
                            WHEN m.drug_type = 1 THEN 'OTC'
                            WHEN m.drug_type = 2 THEN 'SCHEDULE_H'
                            WHEN m.drug_type = 3 THEN 'SCHEDULE_H1'
                            WHEN m.drug_type = 4 THEN 'NARCOTIC'
                        END AS drug_category, SUM(b.current_qty) AS total_stock
                    FROM pharmacy_medicines m
                    JOIN pharmacy_medicine_batches b ON b.medicine_id = m.id
                    WHERE m.customer_id = ? 
                    AND m.drug_type IN (2, 3, 4)
                    GROUP BY m.id, m.brand_name, m.generic_name, m.hsn_code, m.drug_type;
            ");
            return $data;
        }

        public function ledgerAndAccountingQueries() {
            $data = DB::select("SELECT s.id, s.company_name, s.name, s.contact,
                            s.gst_no, s.drug_license_no, s.opening_balance, s.credit_limit
                        FROM pharmacy_suppliers s
                        WHERE s.customer_id = ? 
                        AND s.party_type IN (2, 3) -- 2 = Supplier
                        AND s.status = 1;
            ");
            return $data;
        }

        public function udharOverlimitCustomerAlert() {
            $data = DB::select("SELECT s.name AS customer_name,
                            s.contact, s.opening_balance, s.credit_limit
                        FROM pharmacy_suppliers s
                        WHERE s.customer_id = ? 
                        AND s.party_type IN (1, 3) -- Customer or Both
                        AND s.balance_type = 1 -- Credit
                        AND s.opening_balance > s.credit_limit;
            ");
            return $data;
        }

        public function salesStockDeduction() {
            $data = DB::select("UPDATE pharmacy_medicine_batches 
                        SET current_qty = current_qty - 5,
                            updated_at = NOW()
                        WHERE id = ?
                        AND customer_id = ? 
                        AND current_qty >= 5;
            ");
            return $data;
        }

        public function totalPharmacyStockValueReport() {
            $data = DB::select("SELECT 
                        COUNT(DISTINCT b.medicine_id) AS total_unique_medicines,
                        SUM(b.current_qty) AS total_items_in_stock,
                        SUM(b.current_qty * b.unit_cost_price) AS total_investment_cost,
                        SUM(b.current_qty * b.unit_mrp) AS total_mrp_value,
                        SUM(b.current_qty * b.selling_price) AS total_expected_revenue
                    FROM pharmacy_medicine_batches b
                    WHERE b.customer_id = ? 
                    AND b.current_qty > 0 
                    AND b.expiry_date >= CURDATE();
            ");
            return $data;
        }

        public function categoryWiseStockBreakdown() {
            $data = DB::select("SELECT 
                            c.name AS category_name,
                            COUNT(m.id) AS total_medicines,
                            COALESCE(SUM(b.current_qty), 0) AS total_quantity,
                            COALESCE(SUM(b.current_qty * b.selling_price), 0) AS category_stock_value
                        FROM pharmacy_categories c
                        LEFT JOIN pharmacy_medicines m ON m.category_id = c.id
                        LEFT JOIN pharmacy_medicine_batches b ON b.medicine_id = m.id
                        WHERE c.customer_id = ?
                        GROUP BY c.id, c.name;
            ");
            return $data;
        }

        public function multiTenantAnalyticsBySuperAdmin() {
            $data = DB::select("SELECT 
                            c.customer_id,
                            COUNT(DISTINCT m.id) AS total_medicines_added,
                            COUNT(DISTINCT b.id) AS total_active_batches,
                            SUM(b.current_qty) AS total_inventory_units
                        FROM pharmacy_categories c
                        LEFT JOIN pharmacy_medicines m ON m.customer_id = c.customer_id
                        LEFT JOIN pharmacy_medicine_batches b ON b.customer_id = c.customer_id
                        GROUP BY c.customer_id;
            ");
            return $data;
        }
    // Pharmacy management query end


}