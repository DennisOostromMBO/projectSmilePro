<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class LoadStoredProcedures extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $spPath = database_path('sp'); // Path naar jouw `sp` map

        // Lees alle .sql-bestanden in de map
        $files = File::files($spPath);

        foreach ($files as $file) {
            // Voer de inhoud van elk SQL-bestand uit
            $sql = File::get($file->getPathname());
            DB::unprepared($sql);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hier kun je specifieke DROP PROCEDURE statements toevoegen als je exact wilt controleren welke procedures worden verwijderd
        DB::unprepared('DROP PROCEDURE IF EXISTS spDeletePatient;');
        // Voeg meer DROP statements toe als nodig voor andere procedures.
    }
}
