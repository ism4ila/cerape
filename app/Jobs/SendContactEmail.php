<?php

namespace App\Jobs;

use App\Models\Contact;
use App\Models\SiteConfig;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendContactEmail implements ShouldQueue
{
    use Queueable;

    public function __construct(public int $contactId)
    {
    }

    public function handle(): void
    {
        $contact = Contact::find($this->contactId);

        if (! $contact) {
            return;
        }

        $recipient = SiteConfig::query()->where('key', 'contact_email')->value('value')
            ?? config('mail.from.address');

        if (! $recipient) {
            return;
        }

        $subject = 'Nouveau message de contact: '.$contact->sujet;
        $body = "Nom: {$contact->nom}\n"
            ."Email: {$contact->email}\n\n"
            ."Message:\n{$contact->message}\n";

        Mail::raw($body, function ($message) use ($recipient, $subject, $contact): void {
            $message
                ->to($recipient)
                ->replyTo($contact->email, $contact->nom)
                ->subject($subject);
        });
    }
}
