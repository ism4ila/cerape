<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'slug',
        'domaine_id',
        'description',
        'lieu',
        'date_debut',
        'date_fin',
        'beneficiaires',
        'images',
        'documents',
        'statut',
        'partenaires',
        'visible_public',
    ];

    protected $casts = [
        'images' => 'json',
        'documents' => 'json',
        'partenaires' => 'json',
        'visible_public' => 'boolean',
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    public function domaineRelation(): BelongsTo
    {
        return $this->belongsTo(Domaine::class);
    }

    public function getDomaineAttribute(): ?string
    {
        if (array_key_exists('domaine', $this->attributes)) {
            return $this->attributes['domaine'];
        }

        return $this->domaineRelation?->nom;
    }
}
