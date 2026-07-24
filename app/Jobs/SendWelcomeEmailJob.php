<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\CustomerRegisterMail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendWelcomeEmailJob implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public function __construct(public string $toEmail, public array $mailData, public string $subject, public string $view, public string $mailableClass) {
        
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
