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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persoon_id')->nullable()->constrained('persoon')->onDelete('cascade');
            $table->foreignId('rol_id')->constrained('rol')->onDelete('cascade');
            $table->string('voornaam'); // Voeg de kolom voornaam toe
            $table->string('tussenvoegsel')->nullable(); // Voeg de kolom tussenvoegsel toe
            $table->string('achternaam'); // Voeg de kolom achternaam toe
            $table->string('email', 191)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('Isingelogd')->default(false);
            $table->timestamp('Ingelogd')->nullable();
            $table->timestamp('Uitgelogd')->useCurrent();
            $table->boolean('IsActive')->default(true);
            $table->rememberToken();
            $table->timestamps();
            $table->string('comments')->nullable();
            $table->string('VolledigeNaam')->virtualAs("CONCAT(voornaam, ' ', IFNULL(tussenvoegsel, ''), ' ', achternaam)"); // Voeg de berekende kolom VolledigeNaam toe
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email', 191)->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id', 191)->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};