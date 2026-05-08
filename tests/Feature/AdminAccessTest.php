<?php

use App\Models\User;

it('redirects guest to login for admin dashboard', function () {
    $this->get(route('admin.dashboard'))
        ->assertRedirect(route('login'));
});

it('redirects member away from admin dashboard', function () {
    $member = User::factory()->member()->create();

    $this->actingAs($member)
        ->get(route('admin.dashboard'))
        ->assertRedirect(route('dashboard'));
});

it('allows admin to access admin dashboard', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get(route('admin.dashboard'))
        ->assertOk();
});
