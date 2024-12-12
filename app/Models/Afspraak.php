<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afspraak extends Model
{
    use HasFactory;

    protected $table = 'afspraken';

    protected $fillable = [
        'gebruiker_id',
        'volledige_naam',
        'leeftijdsgroep',
        'datum',
        'tijd',
        'berichten',
    ];

    // Relatie met de gebruiker
    public function gebruiker()
    {
        return $this->belongsTo(User::class, 'gebruiker_id');
    }
}
