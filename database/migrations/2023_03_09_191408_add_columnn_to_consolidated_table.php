<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnnToConsolidatedTable extends Migration
{

    public function up()
    {
        Schema::table('consolidated', static function (Blueprint $table) {
            $table->string('result_a')->nullable()->default('0');
            $table->string('result_b')->nullable()->default('0');
        });
    }


    public function down()
    {
        Schema::table('consolidated', static function (Blueprint $table) {
            $table->dropColumn("result_a");
            $table->dropColumn("result_b");
        });
    }
}
