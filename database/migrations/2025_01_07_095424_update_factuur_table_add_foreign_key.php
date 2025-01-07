<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateFactuurTableAddForeignKey extends Migration
{
    public function up()
    {
        // Step 1: Clean up invalid persoon_id references
        DB::table('factuur')
            ->whereNotNull('persoon_id')
            ->whereNotIn('persoon_id', function ($query) {
                $query->select('id')->from('persoon');
            })
            ->update(['persoon_id' => null]);

        // Step 2: Add the foreign key constraint
        Schema::table('factuur', function (Blueprint $table) {
            $table->unsignedBigInteger('persoon_id')->nullable()->change(); // Ensure correct column type
            $table->foreign('persoon_id')
                  ->references('id')
                  ->on('persoon')
                  ->onDelete('cascade'); // Handle cascading deletions
        });
    }

    public function down()
    {
        Schema::table('factuur', function (Blueprint $table) {
            $table->dropForeign(['persoon_id']); // Drop the foreign key constraint
        });
    }
}
