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
        Schema::table('factuur', function (Blueprint $table) {
            $table->unsignedBigInteger('persoon_id')->nullable()->after('id');
            $table->foreign('persoon_id')->references('id')->on('persoon')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('factuur', function (Blueprint $table) {
            $table->dropForeign(['persoon_id']);
            $table->dropColumn('persoon_id');
        });
    }
};
