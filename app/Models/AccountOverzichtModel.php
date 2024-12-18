<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountOverzichtModel extends Model
{
    
}

class Gebruiker extends Model
{
    use HasFactory;

    protected $table = 'users'; 

    protected $fillable = [
        'Gebruikersnaam',
        'Wachtwoord',
        'Isingelogd',
        'Ingelogd',
        'Uitgelogd',
        'IsActive',
        'Comments',
    ];
}