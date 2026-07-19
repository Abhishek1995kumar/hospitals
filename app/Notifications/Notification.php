<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Notification extends Notification implements ShouldQueue {
    use Queueable;

    public function __construct(public string $title, public string $message) {
        
    }

    public function via(object $notifiable): array {
        return [
            'database',
            'broadcast'
        ];
    }

    public function toDatabase($notifiable) {
        try {
            return [
                'title' => $this->title,
                'message' => $this->message,
                'time' => now(),
            ];

        } catch(Throwable $th) {
            Log::info(['message' => $th->getMessage()]);
        }
    }

    public function toBroadcast($notifiable) {
        try {
            return [
                'title' => $this->title,
                'message' => $this->message
            ];

        } catch(Throwable $th) {
            Log::info(['message' => $th->getMessage()]);
        }
    }



    
    // public function toMail(object $notifiable): MailMessage {
    //     return (new MailMessage)
    //         ->line('The introduction to the notification.')
    //         ->action('Notification Action', url('/'))
    //         ->line('Thank you for using our application!');
    // }


    // public function toArray(object $notifiable): array {
    //     return [
            
    //     ];
    // }
}
