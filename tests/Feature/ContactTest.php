<?php

use Illuminate\Support\Facades\Queue;

it('submits contact form successfully', function () {
    Queue::fake();

    $payload = [
        'nom' => 'Jean Test',
        'email' => 'jean@example.com',
        'sujet' => 'Demande info',
        'message' => 'Bonjour, je souhaite avoir plus d informations.',
    ];

    $this->post(route('contact.store'), $payload)
        ->assertRedirect()
        ->assertSessionHas('success');

    $this->assertDatabaseHas('contacts', [
        'email' => 'jean@example.com',
        'sujet' => 'Demande info',
    ]);
});

it('blocks contact form after five requests per minute', function () {
    Queue::fake();

    $payload = [
        'nom' => 'Jean Throttle',
        'email' => 'throttle@example.com',
        'sujet' => 'Test throttle',
        'message' => 'Message de test pour la limite.',
    ];

    for ($i = 0; $i < 5; $i++) {
        $this->post(route('contact.store'), $payload)->assertRedirect();
    }

    $this->post(route('contact.store'), $payload)
        ->assertRedirect()
        ->assertSessionHas('error');
});
