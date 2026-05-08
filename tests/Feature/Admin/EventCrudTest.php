<?php

use App\Models\Event;
use App\Models\User;

function eventPayload(array $overrides = []): array
{
    return array_merge([
        'titre' => 'Événement test',
        'type' => 'formation',
        'description' => 'Description événement',
        'date_heure' => now()->addWeek()->format('Y-m-d H:i:s'),
        'lieu' => 'Dakar',
        'capacite_max' => 50,
        'inscriptions_ouvertes' => '1',
    ], $overrides);
}

it('creates event with valid future date', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->post(route('admin.events.store'), eventPayload())
        ->assertRedirect(route('admin.events.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('events', [
        'titre' => 'Événement test',
        'type' => 'formation',
    ]);
});

it('accepts past date when no business rule blocks it', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->post(route('admin.events.store'), eventPayload([
            'titre' => 'Événement passé',
            'date_heure' => now()->subDay()->format('Y-m-d H:i:s'),
        ]))
        ->assertRedirect(route('admin.events.index'));

    $this->assertDatabaseHas('events', ['titre' => 'Événement passé']);
});

it('paginates events on admin list', function () {
    $admin = User::factory()->admin()->create();

    Event::query()->insert(collect(range(1, 15))->map(fn (int $i) => [
        'titre' => "Événement {$i}",
        'type' => 'formation',
        'description' => 'Description',
        'date_heure' => now()->addDays($i),
        'lieu' => 'Dakar',
        'capacite_max' => 20,
        'inscriptions_ouvertes' => true,
        'created_at' => now(),
        'updated_at' => now(),
    ])->all());

    $this->actingAs($admin)
        ->get(route('admin.events.index'))
        ->assertOk()
        ->assertSee('?page=2', false);
});
