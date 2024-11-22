<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('DROP PROCEDURE IF EXISTS create_gebruiker_table');
        $sql = File::get(database_path('sql/sp_create_gebruiker_table.sql'));
        DB::unprepared($sql);
        DB::select('CALL create_gebruiker_table()');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP PROCEDURE IF EXISTS create_gebruiker_table');
    }
};
