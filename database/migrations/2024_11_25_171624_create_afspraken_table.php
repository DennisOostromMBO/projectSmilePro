<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('afspraken', function (Blueprint $table) {
            $table->id(); // Primaire sleutel
            $table->unsignedBigInteger('gebruiker_id'); // Relatie met gebruiker
            $table->date('datum'); // Datum van de afspraak
            $table->time('tijd'); // Tijd van de afspraak
            $table->text('notities')->nullable(); // Eventuele opmerkingen
            $table->timestamps(); // Aanmaak- en wijzigingsdatum
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('afspraken');
    }
};
