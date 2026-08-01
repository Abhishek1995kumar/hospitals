<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\SubscriptionExpireAlertMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Symfony\Component\Mime\Email;

class SendMailJob implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $toEmail, $mailData, $subject, $view, $mailableClass;
    public function __construct($toEmail, $mailData, $subject, $view, $mailableClass) {
        $this->toEmail       = $toEmail; 
        $this->mailData      = $mailData; 
        $this->subject       = $subject;
        $this->view          = $view;
        $this->mailableClass = $mailableClass;
    }

    public function handle(): void {
        sendMail(
            $this->toEmail, 
            $this->mailData, 
            $this->subject, 
            $this->view, 
            $this->mailableClass
        );
    }

}
