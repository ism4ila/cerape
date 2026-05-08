<?php

it('throttles contact endpoint after five attempts', function () {
    $payload = [
        'nom' => 'Throttle Contact',
        'email' => 'throttle-contact@example.com',
        'sujet' => 'Sujet',
        'message' => 'Message de test',
    ];

    for ($i = 0; $i < 5; $i++) {
        $this->post(route('contact.store'), $payload)->assertRedirect();
    }

    $this->post(route('contact.store'), $payload)
        ->assertRedirect()
        ->assertSessionHas('error');
});

it('throttles don endpoint after five attempts', function () {
    $payload = [
        'montant' => 1000,
        'donateur' => 'Throttle Don',
        'email' => 'throttle-don@example.com',
        'cause' => 'Éducation',
        'moyen' => 'mtn',
    ];

    for ($i = 0; $i < 5; $i++) {
        $this->post(route('don.store'), $payload)->assertRedirect();
    }

    $this->post(route('don.store'), $payload)
        ->assertRedirect()
        ->assertSessionHas('error');
});

it('shows a readable throttle message', function () {
    $payload = [
        'nom' => 'Throttle Message',
        'email' => 'throttle-message@example.com',
        'sujet' => 'Sujet',
        'message' => 'Message de test',
    ];

    for ($i = 0; $i < 5; $i++) {
        $this->post(route('contact.store'), $payload);
    }

    $this->followingRedirects()
        ->post(route('contact.store'), $payload)
        ->assertSee('Trop de tentatives');
});
