<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Lees de SQL uit het bestand en voer het uit om de tabel te maken
        $sql = File::get(database_path('sql/persoon.sql'));
        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Verwijder de tabel als onderdeel van het rollback-proces
        DB::statement('DROP TABLE IF EXISTS persoon');
    }
};
