<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GebruikerModel extends Model
{
    use HasFactory;

    // Specificeer de tabelnaam
    protected $table = 'users'; // Zorg ervoor dat de tabelnaam correct is

    // Specificeer de velden die massaal toewijsbaar zijn
    protected $fillable = [
        'persoon_id',
        'rol_id',
        'voornaam',
        'tussenvoegsel',
        'achternaam',
        'email',
        'password',
        'Isingelogd',
        'Ingelogd',
        'Uitgelogd',
        'IsActive',
        'comments',
    ];

    public function persoon()
    {
        return $this->belongsTo(Persoon::class, 'persoon_id', 'id');
    }

    public function rol()
    {
        return $this->belongsTo(RolModel::class, 'rol_id', 'id');
    }

    public function getVolledigeNaamAttribute()
    {
        return "{$this->voornaam} {$this->tussenvoegsel} {$this->achternaam}";
    }
}