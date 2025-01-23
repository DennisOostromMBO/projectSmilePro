<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    protected $appends = ['VolledigeNaam'];

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

    public function gebruikers()
    {
        return $this->hasMany(GebruikerModel::class, 'PersoonId','Id');
    }

    public function facturen()
    {
        return $this->hasMany(Factuur::class, 'persoonId', 'Id');
    }
}
