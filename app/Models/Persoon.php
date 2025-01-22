<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Persoon extends Model
{
    use HasFactory;

    protected $table = 'persoon';

   protected $primaryKey = 'Id';

    protected $fillable = [
        'Voornaam',
        'Tussenvoegsel',
        'Achternaam',
        'VolledigeNaam',
        'Geboortedatum',
    ];

    public $timestamps = false;

    // Relaties
    public function patient()
    {
        return $this->hasMany(Patient::class, 'PersoonId', 'Id');
    }
    

    public function gebruikers()
    {
        return $this->hasMany(GebruikerModel::class, 'PersoonId', 'Id');
    }
}

