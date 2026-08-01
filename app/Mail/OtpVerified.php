<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class OtpVerified extends Mailable {
    use Queueable, SerializesModels;
    public $data;
    public function __construct($data) {
        $this->data = $data;
    }

    public function envelope(): Envelope {
        return new Envelope(
            subject: 'Otp Verified'
        );
    }

    public function content(): Content {
        return new Content(
            view: 'backend.emails.otp',
            with: [
                'data' => $this->data
            ]
        );
    }

    public function attachments(): array {
        return [];
    }

}
