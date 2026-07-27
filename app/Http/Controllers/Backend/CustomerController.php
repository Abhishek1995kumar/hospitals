<?php

namespace App\Http\Controllers\backend;


use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Backend\Role;
use App\Traits\ValidationTrait;
use App\Models\Backend\Customer;
use App\Models\Backend\Hospital;
use App\Jobs\SendWelcomeEmailJob;
use App\Models\Backend\Department;
use App\Mail\CustomerRegisterMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Backend\Subscription;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Services\CustomerRegistrationService;

class CustomerController extends Controller {
    use ValidationTrait;
    public function index(Request $request) {
        if ($request->ajax()) {
            $view = view('backend.customer.index');
            return $view->renderSections()['content']; 
        }
        return view('backend.customer.index');
    }

    public function create(Request $request) {
        $countries = DB::table('countries')->pluck('id', 'name')->toArray();
        if ($request->ajax()) {
            $view = view('backend.customer.create', compact('countries'));
            return $view->renderSections()['content'];
        }
        return view('backend.customer.index'); // Normal load par index par hi rakhe
    }


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


    public function save(Request $request, CustomerRegistrationService $registrationService) {
        try {
            $data = $request->all();
            $validation = $this->validationCustomerTait($data);
            if ($validation) {
                return json_response(false, 410, "Validation failed", $validation);
            }

            $customerData = $registrationService->register($data); // Register Customer via Service
            SendWelcomeEmailJob::dispatch(
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




    public function list(Request $request) {
        try {
            $customerId = authUser()->customer_id;
            $type = $request->get('type');
            $data = [];
            switch ($type) {
                case 'customer':
                    if(empty(authUser()->customer_id)) {
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
                                        'customer_table_id'         => $query->customer_table_id,
                                        'customer_name'             => $query->customer_name,
                                        'email'                     => secure($query->email, 'D'),
                                        'mobile_no'                 => secure($query->mobile_no, 'D'),
                                        'plan_name'                 => $query->plan_name,
                                        'subscription_status'       => $query->subscription_status,
                                        'trial_end_date'            => $query->trial_end_date,
                                        'subscription_start_date'   => $query->sub_start_date,
                                        'subscription_end_date'     => $query->sub_end_date,
                                        'plan_price'                => $query->plan_price,
                                        'invoice_no'                => $query->invoice_no,
                                        'transaction_id'            => $query->transaction_id,
                                        'paid_amount'               => $query->paid_amount,
                                        'payment_status'            => $query->payment_status,
                                        'plan_features'             => $query->plan_features ?? '--',
                                    ];
                            }, $superAdminQuerys
                        );
                    } else {
                        $customerQuerys = DB::select("SELECT c.id AS customer_table_id, c.customer_name, c.mobile_no, c.max_hospitals, c.max_users, c.max_firms, 
                                            C.subscription_status, 
                                            DATE_FORMAT(c.subscription_start_date, '%d %M %Y') AS sub_start_date, 
                                            DATE_FORMAT(c.subscription_end_date, '%d %M %Y') AS sub_end_date, 
                                            p.id AS plan_id, p.plan_name, p.duration_days, m.name AS module_name, GROUP_CONCAT(DISTINCT f.feature_name SEPARATOR ', ') AS plan_features
                                            FROM customers c 
                                            JOIN plans p ON p.id = c.current_plan_id 
                                            LEFT JOIN feature_plans fp ON fp.plan_id = p.id 
                                            LEFT JOIN features f ON f.id = fp.feature_id 
                                            LEFT JOIN modules m ON m.id = f.module_id 
                                            WHERE c.id=$customerId AND c.status=1 AND c.subscription_status=1
                                            GROUP BY c.id, p.id, f.id; -- Active Subscription
                        ");
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
                    break;

                case 'hospital':
                    $data = DB::select('SELECT * FROM customers');
                    break;
                    
                case 'subscription':
                    if(empty($customerId)) {
                        $expireSubscriptionAlert = DB::select("SELECT 
                                        c.id AS customer_id,
                                        c.customer_name,
                                        c.mobile_no,
                                        c.subscription_end_date,
                                        DATEDIFF(c.subscription_end_date, CURDATE()) AS days_left,
                                        p.plan_name
                                    FROM customers c
                                    JOIN plans p ON p.id = c.current_plan_id
                                    WHERE c.subscription_status = 1 
                                    AND c.subscription_end_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY);
                        ");
                        $data = array_map(function($query) {
                                    return [
                                        'customer_id'               => $query->customer_id,
                                        'customer_name'             => $query->customer_name,
                                        'mobile_no'                 => secure($query->mobile_no, 'D'),
                                        'plan_name'                 => $query->plan_name,
                                        'subscription_end_date'     => $query->subscription_end_date,
                                        'days_left'                 => $query->days_left,
                                    ];
                            }, $expireSubscriptionAlert
                        );
                        
                    } else {
                        $activeSubscriptionCustomer = "SELECT cs.id AS subscription_id, cs.invoice_no, cs.transaction_id,
                                                cs.amount, cs.start_date, cs.end_date, p.plan_name,
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
                                            WHERE cs.customer_id=? -- Specific Customer ID
                                            ORDER BY cs.id DESC;
                        ";
                        $data = DB::select($activeSubscriptionCustomer, [$customerId]);
                    }
                    break;


                case 'billing':
                    $data = $query([authUser()->customer_id]);
                    break;

                case 'user':
                    $data = DB::select('SELECT * FROM customers');
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
}
