<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersoonModel extends Model
{
    use HasFactory;

    protected $table = 'persoon';

    protected $fillable = [
        'voornaam',
        'tussenVoegsel',
        'achternaam',
        'Geboortedatum',
        'IsActive',
        'Comments',
        'CreatedAt',
        'UpdatedAt',
    ];

    public $timestamps = false; // Since we are using custom timestamp columns
}
