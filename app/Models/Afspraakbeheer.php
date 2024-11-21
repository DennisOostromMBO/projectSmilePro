<?php
// app/Models/Afspraakbeheer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afspraakbeheer extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'employee_id',
        'date',
        'time',
        'status',
        'is_active',
        'comments',
    ];

    // Je kunt hier eventuele andere relaties of methodes toevoegen
}
