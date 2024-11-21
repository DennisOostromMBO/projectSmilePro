<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;


    class CreateAfsprakenbeheerTable extends Migration
{
    public function up()
    {
        DB::statement('DROP PROCEDURE IF EXISTS create_afsprakenbeheer_table');
        $sql = File::get(database_path('sql/sp_create_afsprakenbeheer_table.sql'));
        DB::unprepared($sql);
        DB::select('CALL create_afsprakenbeheer_table()');
    }

    public function down()
    {
        DB::statement('DROP PROCEDURE IF EXISTS create_afsprakenbeheer_table');
    }
}
