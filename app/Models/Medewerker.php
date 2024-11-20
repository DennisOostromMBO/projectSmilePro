<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medewerker extends Model
{
    use HasFactory;

    protected $fillable = [
        "PersoonId",
        "Nummer",
        "Medewerkertype",
        "Specialisatie",
        "Beschikbaarheid",
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, "PersoonId");
    }
}
