<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factuur extends Model
{
    use HasFactory;

    protected $table = 'factuur';

    protected $fillable = [
        'persoon_id',
        'klant_id',
        'beschrijving',
        'vervaldatum',
        'btw',
        'totaal_bedrag',
    ];

    public function persoon()
    {
        return $this->belongsTo(Persoon::class, 'persoon_id', 'id');
    }
}