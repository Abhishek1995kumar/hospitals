<?php 


namespace App\Services;

use App\Models\User;
use App\Notifications\CompanyNotification;

use Illuminate\Support\Facades\DB;

class SubscriptionReminderService {
    public function alert() {
        $expiryAlertQuerys = DB::select("SELECT 
                        c.id AS customer_id,
                        c.customer_name,
                        c.email,
                        c.subscription_end_date,
                        DATEDIFF(c.subscription_end_date, CURDATE()) AS days_left,
                        p.plan_name
                    FROM customers c
                    JOIN plans p ON p.id = c.current_plan_id
                    WHERE c.subscription_status = 1 
                    AND c.subscription_end_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY);
        ");
        return $expiryAlertQuerys;
    }
}

