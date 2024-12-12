<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfsprakenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('afspraken', function (Blueprint $table) {
            // Voeg het veld voor volledige naam toe
            $table->string('volledige_naam')->after('gebruiker_id');

            // Verwijder geboortedatum (indien aanwezig)
            if (Schema::hasColumn('afspraken', 'geboortedatum')) {
                $table->dropColumn('geboortedatum');
            }

            // Voeg leeftijdsgroep toe
            $table->enum('leeftijdsgroep', ['volwassen', 'jongeren'])->after('volledige_naam');

            // Wijzig notities naar berichten
            $table->renameColumn('notities', 'berichten');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('afspraken', function (Blueprint $table) {
            $table->dropColumn('volledige_naam');
            $table->dropColumn('leeftijdsgroep');
            $table->renameColumn('berichten', 'notities');
        });
    }
}
