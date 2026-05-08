<?php

use App\Jobs\SendContactEmail;
use Illuminate\Support\Facades\Queue;

function contactPayload(array $overrides = []): array
{
    return array_merge([
        'nom' => 'Jean Test',
        'email' => 'jean@example.com',
        'sujet' => 'Sujet test',
        'message' => 'Message de contact valide',
    ], $overrides);
}

it('submits contact form and dispatches job', function () {
    Queue::fake();

    $this->post(route('contact.store'), contactPayload())
        ->assertRedirect()
        ->assertSessionHas('success');

    $this->assertDatabaseHas('contacts', [
        'email' => 'jean@example.com',
        'sujet' => 'Sujet test',
    ]);

    Queue::assertPushed(SendContactEmail::class);
});

it('fails validation when email is invalid', function () {
    $this->from(route('contact'))
        ->post(route('contact.store'), contactPayload(['email' => 'email-invalide']))
        ->assertRedirect(route('contact'))
        ->assertSessionHasErrors('email');
});

it('fails validation when required fields are empty', function () {
    $this->from(route('contact'))
        ->post(route('contact.store'), [
            'nom' => '',
            'email' => '',
            'sujet' => '',
            'message' => '',
        ])
        ->assertRedirect(route('contact'))
        ->assertSessionHasErrors(['nom', 'email', 'sujet', 'message']);
});

it('queues SendContactEmail job', function () {
    Queue::fake();

    $this->post(route('contact.store'), contactPayload([
        'email' => 'queue@example.com',
    ]));

    Queue::assertPushed(SendContactEmail::class, function (SendContactEmail $job): bool {
        return is_int($job->contactId) && $job->contactId > 0;
    });
});
