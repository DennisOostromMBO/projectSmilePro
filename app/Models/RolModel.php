<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolModel extends Model
{
    use HasFactory;

    protected $table = 'rol'; // Zorg ervoor dat de tabelnaam correct is

    protected $fillable = [
        'Naam',
    ];
}