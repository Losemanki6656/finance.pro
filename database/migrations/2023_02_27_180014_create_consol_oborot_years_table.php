<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsolOborotYearsTable extends Migration
{

    public function up()
    {
        Schema::create('consol_oborot_years', function (Blueprint $table) {
            $table->id();
            $table->integer('year_consol')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('consol_oborot_years');
    }
}
