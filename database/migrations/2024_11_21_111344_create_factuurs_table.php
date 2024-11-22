<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (Schema::hasTable('factuur')) {
            Schema::drop('factuur');
        }

        Schema::create('factuur', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('klant_id');
            $table->string('beschrijving');
            $table->date('vervaldatum');
            $table->decimal('btw', 5, 2);
            $table->decimal('totaal_bedrag', 10, 2);
            $table->timestamps(); // This adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factuurs');
    }
};
