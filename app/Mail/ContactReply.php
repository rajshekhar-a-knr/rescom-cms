<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact;

class ContactReply extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Contact $contact, public string $replyMessage) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Re: Your Inquiry - Rescom');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.contact-reply');
    }
}
