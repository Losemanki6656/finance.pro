<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnnToConsolidateOborotiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consolidate_oboroti', function (Blueprint $table) {
            $table->string('result_a')->nullable()->default('0');
            $table->string('result_b')->nullable()->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consolidate_oboroti', function (Blueprint $table) {
            $table->dropColumn("result_a");
            $table->dropColumn("result_b");
        });
    }
}
