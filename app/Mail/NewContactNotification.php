<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact;

class NewContactNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Contact $contact) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'New Inquiry from ' . $this->contact->name . ' - ' . ($this->contact->service_interested ?? 'General'));
    }

    public function content(): Content
    {
        return new Content(view: 'emails.new-contact');
    }
}
