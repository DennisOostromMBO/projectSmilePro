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
        DB::statement('DROP PROCEDURE IF EXISTS create_gebruiker_table');
        $sql = File::get(database_path('sql/create_gebruiker_table.sql'));
        DB::unprepared($sql);
        DB::select('CALL create_gebruiker_table()');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gebruiker');
        DB::statement('DROP PROCEDURE IF EXISTS create_gebruiker_table');
    }
};