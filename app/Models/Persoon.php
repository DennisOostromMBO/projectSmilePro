<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Persoon extends Model
{
    use HasFactory;

    protected $table = 'persoon';

    protected $fillable = [
        'Voornaam',
        'Tussenvoegsel',
        'Achternaam',
        'Geboortedatum',
    ];

    public $timestamps = false;

    // Relaties
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'PersoonId', 'Id');
    }

    public function gebruikers()
    {
        return $this->hasMany(GebruikerModel::class, 'PersoonId', 'Id');
    }

    // Accessor voor de leeftijdscategorie
    public function getLeeftijdCategorieAttribute()
    {
        $leeftijd = Carbon::parse($this->Geboortedatum)->age;

        if ($leeftijd <= 1) {
            return 'Baby';
        } elseif ($leeftijd >= 2 && $leeftijd <= 3) {
            return 'Peuter';
        } elseif ($leeftijd >= 4 && $leeftijd <= 6) {
            return 'Kleuter';
        } elseif ($leeftijd >= 7 && $leeftijd <= 12) {
            return 'Kind';
        } elseif ($leeftijd >= 13 && $leeftijd <= 18) {
            return 'Tiener';
        } elseif ($leeftijd >= 19 && $leeftijd <= 64) {
            return 'Volwassene';
        } else {
            return 'Oudere';
        }
    }
}
