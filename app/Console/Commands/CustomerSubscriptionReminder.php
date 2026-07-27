<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendWelcomeEmailJob;
use App\Mail\CustomerRegisterMail;
use App\Services\SubscriptionReminderService;



class CustomerSubscriptionReminder extends Command {
    protected $signature = 'customer:reminder';
    protected $description = 'Send subscription expiry reminder emails';


    public function handle(SubscriptionReminderService $reminderService) {
        $expiryAlert = $reminderService->alert();
        foreach($expiryAlert as $alert) {
            SendWelcomeEmailJob::dispatch(
                secure($alert->email, 'D'),
                [
                    'name'        => $alert->customer_name,
                    'email'       => secure($alert->email, 'D'),
                    'plan_name'   => $alert->plan_name,
                    'days_left'   => $alert->days_left,
                    'expiry_date' => date('d M Y', strtotime($alert->subscription_end_date)),
                ],
                "Dear $alert->customer_name, your $alert->plan_name subscription will expire in $alert->days_left day(s).",
                'backend.emails.reminder-alert',
                CustomerRegisterMail::class
            );

            $this->info("Mail Sent : " . $alert->customer_name);
        }
        return Command::SUCCESS;

    }
}
