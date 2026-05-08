<?php

function donPayload(array $overrides = []): array
{
    return array_merge([
        'montant' => 1500,
        'donateur' => 'Donateur test',
        'email' => 'donateur@example.com',
        'telephone' => '770000000',
        'cause' => 'Soutien scolaire',
        'moyen' => 'mtn',
    ], $overrides);
}

it('stores donation with valid data', function () {
    $this->post(route('don.store'), donPayload())
        ->assertRedirect()
        ->assertSessionHas('success');

    $this->assertDatabaseHas('dons', [
        'donateur' => 'Donateur test',
        'email' => 'donateur@example.com',
        'montant' => 1500,
    ]);
});

it('rejects zero or negative amount', function () {
    $this->from(route('don'))
        ->post(route('don.store'), donPayload(['montant' => 0]))
        ->assertRedirect(route('don'))
        ->assertSessionHasErrors('montant');

    $this->from(route('don'))
        ->post(route('don.store'), donPayload(['montant' => -100]))
        ->assertRedirect(route('don'))
        ->assertSessionHasErrors('montant');
});

it('throttles donation endpoint after five submissions', function () {
    for ($i = 0; $i < 5; $i++) {
        $this->post(route('don.store'), donPayload([
            'email' => "don{$i}@example.com",
        ]))->assertRedirect();
    }

    $this->post(route('don.store'), donPayload(['email' => 'blocked@example.com']))
        ->assertRedirect()
        ->assertSessionHas('error');
});
