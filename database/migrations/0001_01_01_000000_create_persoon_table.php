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
        Schema::create('persoon', function (Blueprint $table) {
            $table->id();
            $table->string('voornaam', 100);
            $table->string('tussenvoegsel', 50)->nullable();
            $table->string('achternaam', 100);
            $table->string('VolledigeNaam', 150)->virtualAs("CONCAT(voornaam, ' ', IFNULL(tussenvoegsel, ''), ' ', achternaam)")->stored();
            $table->date('Geboortedatum')->nullable(false);
            $table->boolean('IsActive')->default(true);
            $table->string('Comments', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persoon');
    }
};