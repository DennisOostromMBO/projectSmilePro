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
        try {
            // Drop the procedure if it exists
            DB::statement('DROP PROCEDURE IF EXISTS create_contacten_table');

            // Load the SQL file for the procedure
            $sql = File::get(database_path('sql/sp_create_contacten_table.sql'));
            DB::unprepared($sql);

            // Call the procedure to create the table
            DB::select('CALL create_contacten_table()');
        } catch (\Exception $e) {
            report($e);
            echo "Error running migration: " . $e->getMessage();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            // Drop the procedure and the table
            DB::statement('DROP PROCEDURE IF EXISTS create_contacten_table');
            DB::statement('DROP TABLE IF EXISTS contact');
        } catch (\Exception $e) {
            report($e);
            echo "Error rolling back migration: " . $e->getMessage();
        }
    }
};
