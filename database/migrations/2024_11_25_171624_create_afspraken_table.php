<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfsprakenTable extends Migration
{
    public function up()
    {
        Schema::create('afspraken', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gebruiker_id');
            $table->date('datum');
            $table->time('tijd');
            $table->text('notities')->nullable();
            $table->timestamps();

            // Verhouding naar de gebruikers tabel
            $table->foreign('gebruiker_id')->references('id')->on('gebruikers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('afspraken');
    }
}
