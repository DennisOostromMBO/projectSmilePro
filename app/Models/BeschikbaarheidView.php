<?php
// app/Models/BeschikbaarheidView.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeschikbaarheidView extends Model
{
    protected $table = 'beschikbaarheid_view';
    protected $primaryKey = 'Id';
    public $timestamps = false; // Since the view does not have created_at and updated_at columns
}