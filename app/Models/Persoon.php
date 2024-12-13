<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persoon extends Model
{
    use HasFactory;

    protected $table = 'persoon';

    protected $fillable = [
        'voornaam',
        'tussenvoegsel',
        'achternaam',
        'geboortedatum',
    ];

    public $timestamps = false;

    public function getVolledigeNaamAttribute()
    {
        return trim("{$this->voornaam} {$this->tussenvoegsel} {$this->achternaam}");
    }

    public function patient()
    {
        return $this->hasOne(Patient::class, 'persoon_id', 'id');
    }
}
