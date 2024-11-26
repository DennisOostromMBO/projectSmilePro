<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GebruikerModel extends Model
{
    use HasFactory;

    protected $table = 'gebruiker'; // Zorg ervoor dat de tabelnaam correct is

    protected $fillable = [
        'Id',
        'PersoonId',
        'Gebruikersnaam',
        'Wachtwoord',
        'Isingelogd',
        'Ingelogd',
        'Uitgelogd',
        'IsActive',
        'Comments',
    ];

    public function persoon()
    {
        return $this->belongsTo(Persoon::class, 'PersoonId', 'Id');
    }
}