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
            $table->string('patient_naam', 255);
            $table->string('medewerker_naam', 250);
            $table->date('datum');
            $table->time('tijd');
            $table->text('type_afspraak')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('afspraken');
    }
}
