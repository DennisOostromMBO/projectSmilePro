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
        Schema::create('beschikbaarheids', function (Blueprint $table) {
            $table->id();
            $table->date('datum');
            $table->time('tijd');
            $table->boolean('beschikbaar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beschikbaarheids');
    }
};
