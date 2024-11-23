<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patient';

    protected $fillable = [
        'PersoonId',
        'Nummer',
        'MedischDossier',
    ];

    public $timestamps = false;

    public function persoon()
    {
        return $this->belongsTo(Persoon::class, 'PersoonId', 'Id');
    }

    public function contact()
    {
        return $this->hasOne(Contact::class, 'PatientId', 'Id'); 
    }
}
