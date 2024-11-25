<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beschikbaarheid extends Model
{
    use HasFactory;

    protected $fillable = ['datum', 'tijd', 'beschikbaar'];
}