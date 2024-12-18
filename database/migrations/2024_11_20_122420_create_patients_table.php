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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persoon_id')->unique()->constrained('persoon')->onDelete('cascade');
            $table->string('nummer', 255);
            $table->text('medisch_dossier')->nullable();
            $table->string('straatnaam', 255);
            $table->smallInteger('huisnummer');
            $table->string('toevoeging', 10)->nullable();
            $table->string('postcode', 10);
            $table->string('plaats', 100);
            $table->string('mobiel', 20);
            $table->string('email', 255);
            $table->boolean('is_active')->default(true);
            $table->string('comments', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};