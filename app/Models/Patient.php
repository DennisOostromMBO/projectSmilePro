<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    // Geef de naam van de database-tabel aan
    protected $table = 'patient';

    protected $primaryKey = 'Id';

    // Velden die massaal toegewezen mogen worden
    protected $fillable = [
        'persoon_id',
        'nummer',
        'medisch_dossier',
        'straatnaam',
        'huisnummer',
        'toevoeging',
        'postcode',
        'plaats',
        'mobiel',
        'email',
        'is_active',
        'comments',
    ];

    // Geen timestamps gebruikt in deze tabel
    public $timestamps = false;

    /**
     * Relatie: Een patiënt behoort tot één persoon
     */
    public function persoon()
    {
        return $this->belongsTo(Persoon::class, 'persoon_id', 'Id');
    }
}