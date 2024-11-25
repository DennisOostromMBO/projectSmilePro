<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beschikbaarheid extends Model
{
    use HasFactory;

    protected $table = 'beschikbaarheid';

    protected $fillable = [
        'medewerkerId',
        'datumVanaf',
        'datumTotMet',
        'tijdVanaf',
        'tijdTotMet',
        'status',
        'isActief',
        'opmerking'
    ];

    public $timestamps = false;

    public function medewerker()
    {
        return $this->belongsTo(Medewerker::class, 'medewerkerId', 'Id');
    }
}