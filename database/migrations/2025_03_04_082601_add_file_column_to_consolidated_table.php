<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileColumnToConsolidatedTable extends Migration
{

    public function up()
    {
        Schema::table('consolidated', static function (Blueprint $table) {
            $table->text('file')->nullable();
        });
    }


    public function down(): void
    {
        Schema::table('consolidated', function (Blueprint $table) {
            //
        });
    }
}
