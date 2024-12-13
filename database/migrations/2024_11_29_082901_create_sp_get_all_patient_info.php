<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateSpGetAllPatientInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Laad het SQL-bestand uit de map SP
        $path = database_path('sp/spGetAllPatientInfo.sql');
        DB::unprepared(file_get_contents($path));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Verwijder de stored procedure als de migratie wordt teruggedraaid
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllPatientInfo');
    }
}
