<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Afspraak extends Model
{
    use HasFactory;

    protected $table = 'afspraken';

    protected $fillable = [
        'gebruiker_id',
        'patient_naam',
        'medewerker_naam',
        'datum',
        'tijd',
        'type_afspraak',
    ];

    public function isBinnen24Uur()
    {
        $huidigeTijd = Carbon::now(); // Huidige tijd
        $afspraakTijd = Carbon::parse($this->datum . ' ' . $this->tijd); // Afspraaktijd
    
        // Controleer of de afspraak binnen 24 uur van nu ligt
        return $huidigeTijd->diffInHours($afspraakTijd, false) < 24 && $huidigeTijd->lessThan($afspraakTijd);

        
    }
    

    public function gebruiker()
    {
        return $this->belongsTo(User::class, 'gebruiker_id');
    }
}
