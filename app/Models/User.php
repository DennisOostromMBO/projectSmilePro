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
        'password',
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
        'password',
        'remember_token',
    ];
}