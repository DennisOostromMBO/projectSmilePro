<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factuur extends Model
{
    use HasFactory;

    protected $table = 'factuur';
    protected $fillable = ['klant_id', 'beschrijving', 'vervaldatum', 'btw', 'totaal_bedrag'];
}
