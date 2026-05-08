<?php

use App\Jobs\SendContactEmail;
use App\Models\Contact;
use App\Models\SiteConfig;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

it('dispatches SendContactEmail to queue', function () {
    Queue::fake();

    $this->post(route('contact.store'), [
        'nom' => 'Queue Test',
        'email' => 'queue-test@example.com',
        'sujet' => 'Sujet queue',
        'message' => 'Message queue',
    ])->assertRedirect();

    Queue::assertPushed(SendContactEmail::class);
});

it('queued job contains created contact id', function () {
    Queue::fake();

    $this->post(route('contact.store'), [
        'nom' => 'Queue Data',
        'email' => 'queue-data@example.com',
        'sujet' => 'Sujet data',
        'message' => 'Message data',
    ]);

    $contact = Contact::query()->where('email', 'queue-data@example.com')->firstOrFail();

    Queue::assertPushed(SendContactEmail::class, function (SendContactEmail $job) use ($contact): bool {
        return $job->contactId === $contact->id;
    });
});

it('handles SendContactEmail job manually without error', function () {
    Mail::fake();

    SiteConfig::updateOrCreate(
        ['key' => 'contact_email'],
        ['value' => 'admin@example.com']
    );

    $contact = Contact::create([
        'nom' => 'Manual Job',
        'email' => 'manual@example.com',
        'sujet' => 'Sujet manuel',
        'message' => 'Message manuel',
        'lu' => false,
        'repondu' => false,
    ]);

    $job = new SendContactEmail($contact->id);

    expect(fn () => $job->handle())->not->toThrow(Exception::class);
});
