<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Persoon;

class PersoonSeeder extends Seeder
{
    public function run()
    {
        Persoon::factory(10)->create();;
    }
}