<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'event_date',
        'event_time',
    ];

    protected $casts = [
        'event_date' => 'date',
        'event_time' => 'datetime:H:i', // Cambia esto para asegurar que se maneje correctamente
    ];
}
