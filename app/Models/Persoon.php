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

    // callable through $person->Fname
    public function getFnameAttribute()
    {
        return trim("{$this->Voornaam} {$this->Tussenvoegsel} {$this->Achternaam}");
    }

    public function patient()
    {
        return $this->hasOne(Patient::class, 'PersoonId','Id');
    }
}
