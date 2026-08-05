<?php


namespace App\Services;

use App\Models\User;
use App\Notifications\CompanyNotification;


use App\Jobs\SendMailJob;
use Illuminate\Support\Facades\DB;
use App\Mail\CustomerRegisterMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionExpireAlertMail;
use App\Services\SubscriptionReminderService;

class SubscriptionReminderService {
    // Subscription expiring
        public function sendEmailReminder() {
            $customers = DB::select("SELECT c.customer_name, c.email, c.subscription_end_date,
                            DATEDIFF(c.subscription_end_date, CURDATE()) AS days_left, p.plan_name
                        FROM customers c
                        JOIN plans p ON p.id = c.current_plan_id
                        WHERE c.subscription_status = 1
                        AND DATEDIFF(c.subscription_end_date, CURDATE()) IN (7,3,1,0)
            ");
            
            $allExpiringEmaill = array_map(function($query) {
                    return [
                        'customer_name'         => $query->customer_name,
                        'email'                 => secure($query->email, 'D'),
                        'subscription_end_date' => $query->subscription_end_date,
                        'days_left'             => $query->days_left,
                        'plan_name'             => $query->plan_name
                    ];
                }, $customers
            );
            
            foreach ($allExpiringEmaill as $customer) {
                SendMailJob::dispatch(
                    $customer['email'],
                    [
                        'name' => $customer['customer_name'],
                        'email' => $customer['email'],
                        'plan_name' => $customer['plan_name'],
                        'days_left' => $customer['days_left'],
                        'expiry_date' => date('d M Y', strtotime($customer['subscription_end_date'])),
                    ],
                    "Subscription Expiry Reminder ({$customer['days_left']} Day(s) Left)",
                    'backend.emails.reminder-alert',
                    SubscriptionExpireAlertMail::class
                );
                Log::info("SubscriptionReminderService : reminder mail queued for {$customer['customer_name']}");
            }
            
            return $allExpiringEmaill;
        }


        public function updateCustomerService() {
            try {
                $customers = DB::select("SELECT c.id, c.subscription_end_date,
                            DATEDIFF(c.subscription_end_date, CURDATE()) AS days_left
                            FROM customers c
                            WHERE c.subscription_status = 1
                ");

                $allExpiringEmaill = array_map(function($query) {
                        return [
                            'id'                    => $query->id,
                            'days_left'             => $query->days_left,
                            'subscription_end_date' => $query->subscription_end_date
                        ];
                    }, $customers
                );

                foreach($allExpiringEmaill as $customer) {
                    $customerId = $customer['id'];
                    if($customer['days_left'] <= 0) {
                        DB::transaction(function () use ($customerId) {
                            DB::table('customers')
                                ->where('id', $customerId)
                                ->update([
                                    'status' => 0,
                                    'subscription_status' => 2
                                ]);

                            DB::table('users')
                                ->where('customer_id', $customerId)
                                ->update([
                                    'status' => 0
                                ]);

                            DB::table('customer_subscriptions')
                                ->where('customer_id', $customerId)
                                ->update([
                                    'status' => 0
                                ]);
        
                            DB::table('hospitals')
                                ->where('customer_id', $customerId)
                                ->update([
                                    'status' => 0
                                ]);
        
                            DB::table('firms')
                                ->where('customer_id', $customerId)
                                ->update([
                                    'status' => 0
                                ]);
                        });
                    }
                }

            } catch(Throwable $th) {

            }
        }


        public function getExpiringCustomers() {
            DB::select("SELECT 
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
                }, $expireSubscriptionAlert
            );
        }


        public function sendSmsReminder() { // For send message on mobile

        }


        public function sendWhatsappReminder() { // For send message on whatsapp
            
        }


        public function sendNotification() { // For send message on app
            
        }
    // 



    // Hospital/Firm/User creation limit start
        public function creationLimit() {
            $query = DB::select("SELECT COUNT(DISTINCT h.id) AS total_created_hospital, COUNT(DISTINCT u.id) total_created_user,
                                            COUNT(DISTINCT f.id) total_created_firms, c.max_users AS allowed_users, c.max_hospitals AS allowed_hospitals,
                                            c.max_firms AS allowed_firms,c.id AS customer_id, c.customer_name, p.plan_name, h.name AS hospital_name, 
                                            c.id,
                                            CASE 
                                                WHEN COUNT(DISTINCT h.id) >= c.max_hospitals THEN 'Limit Reached'
                                                ELSE 'Allowed'
                                            END AS hospital_creation_status,
                                            CASE 
                                                WHEN COUNT(DISTINCT u.id) >= c.max_users THEN 'Limit Reached'
                                                ELSE 'Allowed'
                                            END AS user_creation_status,
                                            CASE 
                                                WHEN COUNT(DISTINCT f.id) >= c.max_firms THEN 'Limit Reached'
                                                ELSE 'Allowed'
                                            END AS firm_creation_status
                                        FROM customers c
                                        JOIN plans p ON p.id = c.current_plan_id
                                        JOIN hospitals h ON h.customer_id = c.id AND h.status = 1
                                        LEFT JOIN firms f ON f.customer_id = c.id AND f.status = 1
                                        LEFT JOIN users u ON u.customer_id = c.id AND u.status = 1
                                        WHERE c.id=?
                                        GROUP BY c.id, h.id, u.id, f.id;
            ");
        }


        public function activeSubscriptionPlan() {
            $customerId = authUser()->customer_id;
            $activeSubscriptionCustomer = "SELECT cs.id AS subscription_id, cs.invoice_no, cs.transaction_id,
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
                                                END AS status_text,
                                                cs.status AS is_current_plan,
                                                DATEDIFF(cs.end_date, CURDATE()) AS days_left
                                            FROM customer_subscriptions cs
                                            JOIN plans p ON p.id = cs.plan_id
                                            WHERE cs.customer_id=? -- Specific Customer ID
                                            ORDER BY cs.id DESC;
            ";
            $active = DB::select($activeSubscriptionCustomer, [$customerId]);
        }


        public function customerSwitchOrPlanUpgradeTransaction() {
            // Step 1: Purane active subscription ko history me daalein
            $customerId = authUser()->customer_id;
            $query = DB::select("UPDATE customer_subscriptions 
                        SET status = 0 
                        WHERE customer_id = $customerId AND status = 1;

                        -- Step 2: Naya subscription record create karein
                        INSERT INTO customer_subscriptions 
                        (plan_id, invoice_no, transaction_id, amount, start_date, end_date, payment_gateway, payment_status, status)
                        VALUES 
                        (2, 'INV-2026-0099', 'TXN_987654321', 4999.00, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 365 DAY), 1, 1, 1);

                        -- Step 3: Main customers table update karein
                        UPDATE customers 
                        SET current_plan_id = 2,
                            subscription_status = 1,
                            subscription_start_date = CURDATE(),
                            subscription_end_date = DATE_ADD(CURDATE(), INTERVAL 365 DAY),
                            last_payment_date = CURDATE(),
                            next_billing_date = DATE_ADD(CURDATE(), INTERVAL 365 DAY)
                        WHERE id = $customerId;
            ");
        }


        public function currentlyActivePlanAndAllowedFeatures() {
            $query = DB::select("SELECT 
                        m.id AS module_id,
                        m.name AS module_name,
                        m.slug AS module_slug,
                        m.icon AS module_icon,
                        f.id AS feature_id,
                        f.feature_name,
                        f.feature_slug
                    FROM customers c
                    JOIN plans p ON p.id = c.current_plan_id
                    JOIN feature_plans fp ON fp.plan_id = p.id
                    JOIN features f ON f.id = fp.feature_id AND f.status = 1
                    JOIN modules m ON m.id = f.module_id AND m.status = 1
                    WHERE c.id = ? -- Specific Customer ID
                    AND c.status = 1 
                    AND c.subscription_status = 1; -- Active Subscription
            ");
        }
    // Hospital/Firm/User creation limit end
}


