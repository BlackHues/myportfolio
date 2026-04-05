<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $senderName,
        public string $projectTypeLabel,
        public string $packageLine,
        public string $bodyText,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Received — '.$this->packageLine.' · Arjun Kumar H',
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'emails.contact.confirmation',
            text: 'emails.contact.confirmation-text',
        );
    }
}
