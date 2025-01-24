<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medewerker extends Model
{
    use HasFactory;

    protected $table = 'medewerkers';

    protected $primaryKey = 'Id';

    protected $fillable = [
        "PersoonId",
        'Nummer',
        'Medewerkertype',
        'Specialisatie',
        'Beschikbaarheid',
    ];

    public $timestamps = false;

    // const CREATED_AT = 'CreatedAt';
    // const UPDATED_AT = 'UpdatedAt';

    public function persoon()
    {
        return $this->belongsTo(Persoon::class, 'PersoonId', 'Id');
    }

    public function beschikbaarheden()
    {
        return $this->hasMany(Beschikbaarheid::class, 'medewerkerId', 'Id');
    }
}