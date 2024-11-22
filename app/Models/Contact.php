<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact';
    protected $fillable = [
        "Straatnaam",
        "Huisnummer",
        "Toevoeging",
        "Postcode",
        "Plaats",
        "Mobiel",
        "Email",
    ];

    public $timestamps = false;

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'PatientId',  'Id'); 
    }
}
