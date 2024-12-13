<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medewerker extends Model
{
    use HasFactory;

    protected $table = 'medewerkers';

    protected $fillable = [
        "PersoonId",
        "Nummer",
        "Medewerkertype",
        "Specialisatie",
        "Beschikbaarheid",
    ];

    public $timestamps = false;

    public function persoon()
    {
        return $this->belongsTo(Persoon::class, 'PersoonId', 'Id');
    }

    public function beschikbaarheden()
    {
        return $this->hasMany(Beschikbaarheid::class, 'medewerker_id', 'Id');
    }
}