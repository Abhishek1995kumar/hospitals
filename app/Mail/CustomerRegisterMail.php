<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerRegisterMail extends Mailable {
   use Queueable, SerializesModels;
    public $data;
    public $customSubject;
    public $customView;

    public function __construct(array $data, string $subject, string $view) {
        $this->data = $data;
        $this->customSubject = $subject;
        $this->customView = $view;
    }

    public function envelope(): Envelope {
        return new Envelope(
            subject: $this->customSubject // Dynamic Subject
        );
    }

    public function content(): Content {
        return new Content(
            view: $this->customView, // Dynamic View
            with: [
                'data' => $this->data
            ]
        );
    }

    public function attachments(): array {
        return [];
    }
}
