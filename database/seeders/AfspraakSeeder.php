<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Afspraak;

class AfspraakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Afspraak::create([
            'gebruiker_id' => 1, // Verwijzing naar bestaande gebruiker
            'volledige_naam' => 'Jan Jansen',
            'leeftijdsgroep' => 'volwassen',
            'datum' => '2024-12-05',
            'tijd' => '10:00',
            'berichten' => 'Controle afspraak',
        ]);

        Afspraak::create([
            'gebruiker_id' => 2,
            'volledige_naam' => 'Piet Pietersen',
            'leeftijdsgroep' => 'volwassen',
            'datum' => '2024-12-06',
            'tijd' => '14:00',
            'berichten' => 'Follow-up na operatie',
        ]);

        Afspraak::create([
            'gebruiker_id' => 1,
            'volledige_naam' => 'Jan Jansen',
            'leeftijdsgroep' => 'volwassen',
            'datum' => '2024-12-07',
            'tijd' => '09:30',
            'berichten' => 'Bloedonderzoek voor allergieën',
        ]);

        Afspraak::create([
            'gebruiker_id' => 3,
            'volledige_naam' => 'Marie Jacobs',
            'leeftijdsgroep' => 'jongeren',
            'datum' => '2024-12-10',
            'tijd' => '11:00',
            'berichten' => 'Informatie sessie voor nieuwe behandelingen',
        ]);
    }
}
