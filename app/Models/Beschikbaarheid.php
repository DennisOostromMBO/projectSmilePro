<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beschikbaarheid extends Model
{
    use HasFactory;

    protected $table = 'beschikbaarheid';

    protected $fillable = [
        'MedewerkerId', // Ensure this matches the database column name
        'DatumVanaf',
        'DatumTotMet',
        'TijdVanaf',
        'TijdTotMet',
        'Status',
        'IsActief',
        'Opmerking',
    ];

    public $timestamps = false;

    // Relationship to Medewerker
    public function medewerker()
    {
        return $this->belongsTo(Medewerker::class, 'MedewerkerId', 'Id'); 
    }

    // Destroy function to delete a record
    public static function destroy($Id)
    {
        $beschikbaarheid = self::find($Id);
        if ($beschikbaarheid) {
            $beschikbaarheid->forceDelete();
            return true;
        }
        return false;
    }
}
