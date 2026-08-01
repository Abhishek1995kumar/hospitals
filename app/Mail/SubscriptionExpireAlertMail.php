<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;

class SubscriptionExpireAlertMail extends Mailable {
    use Queueable, SerializesModels;
    public $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function build(){
        Log::info('SubscriptionExpireAlertMail build() called');
        return $this->subject('Subscription Reminder Email')->view('backend.emails.reminder-alert')->with(['data' => $this->data,]);
    }

}
