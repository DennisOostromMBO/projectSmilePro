<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolModel extends Model
{
    use HasFactory;

    // Specificeer de tabelnaam
    protected $table = 'rol';

    // Specificeer de velden die massaal toewijsbaar zijn
    protected $fillable = [
        'Naam',
        'Comments',
    ];

    // Geef aan dat de tabel geen timestamps heeft
    public $timestamps = false;
}