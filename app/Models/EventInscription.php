<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventInscription extends Model
{
    protected $fillable = [
        'event_id',
        'nom',
        'email',
        'telephone',
    ];
}
