<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::create([
            'PatientId' => 1,
            'Straatnaam' => 'Hoofdstraat',
            'Huisnummer' => '123',
            'Toevoeging' => 'A',
            'Postcode' => '1234AB',
            'Plaats' => 'Amsterdam',
            'Mobiel' => '0612345678',
            'Email' => 'persoon1@example.com',
        ]);

       // Contact::create([
           // 'PatientId' => 2,
           // 'Straatnaam' => 'Kerkstraat',
           // 'Huisnummer' => '456',
           // 'Toevoeging' => null,
           // 'Postcode' => '5678CD',
          //  'Plaats' => 'Rotterdam',
          //  'Mobiel' => '0687654321',
          //  'Email' => 'persoon2@example.com',
       // ]);  
        
        
    }
}


