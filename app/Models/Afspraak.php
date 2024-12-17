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
        'patient_naam',
        'medewerker_naam',
        'datum',
        'tijd',
        'type_afspraak',
    ];
    
    public function gebruiker()
    {
        return $this->belongsTo(User::class, 'gebruiker_id');
    }
}
