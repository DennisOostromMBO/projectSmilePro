<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_afspraakbeheers_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfsprakenbeheerTable extends Migration
{
    public function up()
    {
        Schema::create('afsprakenbeheer', function (Blueprint $table) {
            $table->increments('Id'); // AUTO_INCREMENT primary key
            $table->integer('PatiëntId')->unsigned(); // Verwijst naar de patiënttabel
            $table->integer('MedewerkerId')->unsigned(); // Verwijst naar de medewerkerstabel
            $table->date('Datum'); // Datum van de afspraak
            $table->time('Tijd'); // Tijd van de afspraak
            $table->enum('Status', ['Bevestigd', 'Geannuleerd']); // Status van de afspraak
            $table->boolean('IsActive')->default(1); // Of de afspraak actief is
            $table->text('Comments')->nullable(); // Opmerkingen over de afspraak
            $table->timestamps(); // Automatisch toegevoegd datums voor 'created_at' en 'updated_at'
            
            // Indexes voor de foreign keys
            $table->foreign('PatiëntId')->references('id')->on('patients')->onDelete('cascade'); // Verwijst naar de 'patients' tabel
            $table->foreign('MedewerkerId')->references('id')->on('employees')->onDelete('cascade'); // Verwijst naar de 'employees' tabel
        });
    }

    public function down()
    {
        Schema::dropIfExists('afsprakenbeheer'); // Drop de tabel als de migratie wordt teruggedraaid
    }
}
