<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persoon extends Model
{
    use HasFactory;

    protected $table = 'personen';

    protected $fillable = [
        'voornaam',
        'tussenvoegsel',
        'achternaam',
        'geboortedatum',
    ];

    public $timestamps = false;

    public function VolledigeNaam()
    {
        return trim("{$this->Voornaam} {$this->Tussenvoegsel} {$this->Achternaam}");
    }

    public function patient()
    {
        return $this->hasOne(Patient::class, 'persoon_Id', 'Id');
    }
}
