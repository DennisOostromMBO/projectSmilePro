<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patienten';

    protected $fillable = [
        'Nummer',
        'MedischDossier',
    ];

    public $timestamps = false;
}
