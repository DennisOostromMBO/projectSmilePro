<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persoon extends Model
{
    use HasFactory;

    protected $table = 'personen';

    protected $fillable = [
        'Voornaam',
        'Tussenvoegsel',
        'Achternaam',
        'Geboortedatum',
    ];

    public $timestamps = false;

     public function patient()
     {
         return $this->belongsTo(Patient::class, 'PersoonId', 'Id');
     }

    // public function medewerkers()
    // {
    //     return $this->belongsTo(Medewerker::class, 'PersoonId', 'Id');
    // }
}