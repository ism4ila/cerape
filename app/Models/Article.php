<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'slug',
        'contenu',
        'auteur',
        'categorie',
        'image_url',
        'tags',
        'statut',
        'date_publication',
        'meta_description',
    ];

    protected $casts = [
        'tags' => 'json',
        'date_publication' => 'datetime',
    ];
}
