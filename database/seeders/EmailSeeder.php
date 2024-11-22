<?php
namespace Database\Seeders;

use App\Models\Email;
use Illuminate\Database\Seeder;

class EmailSeeder extends Seeder
{
    /**
     * Run de database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Genereer 10 test-e-mails
        Email::factory()->count(10)->create();
    }
}