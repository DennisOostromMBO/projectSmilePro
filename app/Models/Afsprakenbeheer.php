<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afsprakenbeheer extends Model
{
    use HasFactory;

    protected $table = 'afsprakenbeheer';

    protected $fillable = [
        'PatiëntId',
        'MedewerkerId',
        'Datum',
        'Tijd',
        'Status',
        'IsActive',
        'Comments'
    ];

    // Relaties met andere modellen
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'PatiëntId');
    }
}
