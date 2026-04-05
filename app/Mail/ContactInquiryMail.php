<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactInquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $senderName,
        public string $senderPhone,
        public string $projectTypeLabel,
        public ?string $bodyText,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Project inquiry: '.$this->projectTypeLabel.' — '.$this->senderName,
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'emails.contact.inquiry',
            text: 'emails.contact.inquiry-text',
        );
    }
}
