<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class SlugService
{
    public function makeUnique(string $model, string $titre, ?int $exceptId = null): string
    {
        /** @var Model $instance */
        $instance = new $model();
        $baseSlug = Str::slug($titre);
        $slug = $baseSlug;
        $counter = 1;

        $query = $model::query();

        while ($this->slugExists(clone $query, $slug, $instance->getKeyName(), $exceptId)) {
            $slug = $baseSlug.'-'.$counter++;
        }

        return $slug;
    }

    private function slugExists(Builder $query, string $slug, string $keyName, ?int $exceptId): bool
    {
        $query->where('slug', $slug);

        if ($exceptId !== null) {
            $query->where($keyName, '!=', $exceptId);
        }

        return $query->exists();
    }
}
