<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persoon extends Model
{
    use HasFactory;

    protected $table = 'persoon';

    protected $primaryKey = 'id';

    protected $fillable = [
        'voornaam',
        'tussenvoegsel',
        'achternaam',
        'geboortedatum',
        'is_active',
        'comments',
    ];

    protected $appends = ['VolledigeNaam'];

    public $timestamps = false;

    public function getVolledigeNaamAttribute()
    {
        return trim("{$this->voornaam} {$this->tussenvoegsel} {$this->achternaam}");
    }

    public function patients()
    {
        return $this->hasMany(Patient::class, 'persoon_id', 'id');
    }

    public function medewerker()
    {
        return $this->belongsTo(Medewerker::class, 'PersoonId', 'Id');
    }

    public function getAge()
    {
        return Carbon::parse($this->Geboortedatum)->age;
    }
}
