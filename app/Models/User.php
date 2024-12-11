<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Specificeer de tabelnaam
    protected $table = 'gebruiker';

    // Specificeer de velden die massaal toewijsbaar zijn
    protected $fillable = [
        'PersoonId',
        'Gebruikersnaam',
        'Email',
        'Wachtwoord',
        'remember_token',
        'Isingelogd',
        'Ingelogd',
        'Uitgelogd',
        'IsActive',
        'Comments',
    ];

    // Geef aan dat de tabel timestamps heeft
    public $timestamps = true;

    // Specificeer de kolom die als wachtwoord wordt gebruikt
    protected $hidden = [
        'Wachtwoord',
        'remember_token',
    ];

    // Specificeer de kolom die als wachtwoord wordt gebruikt
    public function getAuthPassword()
    {
        return $this->Wachtwoord;
    }

    // Definieer de relatie met de Persoon model
    public function persoon()
    {
        return $this->belongsTo(Persoon::class, 'PersoonId', 'Id');
    }
}