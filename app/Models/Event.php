<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'type',
        'description',
        'date_heure',
        'lieu',
        'capacite_max',
        'inscriptions_ouvertes',
        'image_url',
    ];

    protected $casts = [
        'date_heure' => 'datetime',
        'inscriptions_ouvertes' => 'boolean',
    ];
}
