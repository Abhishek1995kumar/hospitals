<?php

namespace App\Console\Commands;

use App\Jobs\SendMailJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Mail\CustomerRegisterMail;
use Illuminate\Support\Facades\Mail;
use App\Services\SubscriptionReminderService;


class CustomerInactive extends Command {
    protected $signature = 'customer:inactive';
    protected $description = 'Customer subscription expiried';

    public function handle(SubscriptionReminderService $reminderService) {
        $customers = $reminderService->updateCustomerService();
        return Command::SUCCESS;
    }


}
