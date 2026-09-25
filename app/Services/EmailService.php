<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Throwable;

class EmailService
{
    public function send($mailable, $to, ?array $cc = null, ?array $bcc = null): bool
    {
        try {
            $mailer = Mail::to($to);
            if ($cc) $mailer->cc($cc);
            if ($bcc) $mailer->bcc($bcc);
            $mailer->send($mailable);
            log::info('Email sent successfully', [
                'to' => $to,
                'subject' => method_exists($mailable, 'subject') ? $mailable->subject : null,
            ]);
            return true;
        } catch (Throwable $e) {
            log::error('Email send failed', [
                'to' => $to,
                'subject' => method_exists($mailable, 'subject') ? $mailable->subject : null,
                'error' => $e->getMessage(),
            ]);
            Log::error('Email send failed', [
                'to' => $to,
                'subject' => method_exists($mailable, 'subject') ? $mailable->subject : null,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    public function sendRawHtml(string $to, string $subject, string $html, ?array $cc = null, ?array $bcc = null): bool
    {
        try {
            Mail::html($html, function ($message) use ($to, $subject, $cc, $bcc) {
                $message->to($to)->subject($subject);
                if ($cc) $message->cc($cc);
                if ($bcc) $message->bcc($bcc);
            });
            log::info('Raw HTML email sent successfully', [
                'to' => $to,
                'subject' => $subject,
            ]);
            return true;
        } catch (Throwable $e) {
            log::error('Raw HTML email send failed', [
                'to' => $to,
                'subject' => $subject,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }
}
