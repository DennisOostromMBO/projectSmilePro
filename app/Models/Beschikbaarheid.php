<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beschikbaarheid extends Model
{
    use HasFactory;

    protected $table = 'beschikbaarheid';

    protected $fillable = [
        'medewerkerId', // Zorg dat deze naam overeenkomt met de databasekolom
        'datumVanaf',
        'datumTotMet',
        'tijdVanaf',
        'tijdTotMet',
        'status',
        'isActief',
        'opmerking',
    ];

    public $timestamps = false;

    // Relatie naar Medewerker
    public function medewerker()
    {
        return $this->belongsTo(Medewerker::class, 'medewerkerId', 'Id'); // Consistente foreign key naam
    }
}
