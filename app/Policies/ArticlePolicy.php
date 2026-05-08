<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['superadmin', 'admin'], true);
    }

    public function view(User $user, Article $article): bool
    {
        return in_array($user->role, ['superadmin', 'admin'], true);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['superadmin', 'admin', 'editeur'], true);
    }

    public function update(User $user, Article $article): bool
    {
        return in_array($user->role, ['superadmin', 'admin', 'editeur'], true);
    }

    public function delete(User $user, Article $article): bool
    {
        return $user->role === 'superadmin';
    }
}
