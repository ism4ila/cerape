<?php

namespace App\Policies;

use App\Models\Projet;
use App\Models\User;

class ProjetPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['superadmin', 'admin'], true);
    }

    public function view(User $user, Projet $projet): bool
    {
        return in_array($user->role, ['superadmin', 'admin'], true);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['superadmin', 'admin', 'editeur'], true);
    }

    public function update(User $user, Projet $projet): bool
    {
        return in_array($user->role, ['superadmin', 'admin', 'editeur'], true);
    }

    public function delete(User $user, Projet $projet): bool
    {
        return $user->role === 'superadmin';
    }
}
