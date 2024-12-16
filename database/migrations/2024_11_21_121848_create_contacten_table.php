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
        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->string('straatnaam', 255);
            $table->smallInteger('huisnummer');
            $table->string('toevoeging', 10)->nullable();
            $table->string('postcode', 10);
            $table->string('plaats', 100);
            $table->string('volledig_adres')->virtualAs("CONCAT(straatnaam, ' ', huisnummer, IF(toevoeging IS NOT NULL AND toevoeging != '', CONCAT('-', toevoeging), ''), ', ', postcode, ' ', plaats)")->stored();
            $table->string('mobiel', 20);
            $table->string('email', 255);
            $table->boolean('is_actief')->default(true);
            $table->string('opmerking', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact');
    }
};