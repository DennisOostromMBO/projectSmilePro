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
        'datum',
        'tijd',
        'notities',
    ];

    // Voeg relaties toe als nodig
    public function gebruiker()
    {
        return $this->belongsTo(User::class, 'gebruiker_id');
    }
}
