<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GebruikerModel extends Model
{
    use HasFactory;

    // Specificeer de tabelnaam
    protected $table = 'gebruiker';

    // Specificeer de velden die massaal toewijsbaar zijn
    protected $fillable = [
        'Id',
        'PersoonId',
        'Gebruikersnaam',
        'Wachtwoord',
        'Isingelogd',
        'Ingelogd',
        'Uitgelogd',
        'IsActive',
        'Comments',
    ];

    /**
     * Definieer de relatie met de Persoon model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function persoon()
    {
        return $this->belongsTo(Persoon::class, 'PersoonId', 'Id');
    }
}