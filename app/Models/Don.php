<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Don extends Model
{
    use HasFactory;

    protected $fillable = [
        'montant',
        'devise',
        'donateur',
        'email',
        'telephone',
        'cause',
        'moyen',
        'statut',
        'date_don',
    ];

    protected $casts = [
        'date_don' => 'datetime',
        'montant' => 'decimal:2',
    ];
}
