<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persoon extends Model
{
    use HasFactory;

    protected $table = 'persoon';

    protected $primaryKey = 'Id'; // Ensure primary key is correctly defined

    protected $fillable = [
        'Voornaam',
        'Tussenvoegsel',
        'Achternaam',
        'VolledigeNaam',
        'Geboortedatum',
    ];

    //protected $appends = ['VolledigeNaam'];

    public $timestamps = false;

    public function getFnameAttribute()
    {
        return trim("{$this->Voornaam} {$this->Tussenvoegsel} {$this->Achternaam}");
    }

    public function patient()
    {
        return $this->hasOne(Patient::class, 'PersoonId', 'Id');
    }

    public function gebruikers()
    {
        return $this->hasMany(GebruikerModel::class, 'PersoonId', 'Id');
    }

    public function facturen()
    {
        return $this->hasMany(Factuur::class, 'persoon_id', 'Id'); // Ensure correct foreign key reference
    }
}
