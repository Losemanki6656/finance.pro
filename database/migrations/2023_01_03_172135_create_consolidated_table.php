<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsolidatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consolidated', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('send_id')->unsigned()->index()->nullable();
            $table->bigInteger('rec_id')->unsigned()->index()->nullable();
            $table->string('send_name')->nullable();
            $table->string('rec_name')->nullable();
            $table->string('send_inn')->nullable();
            $table->string('rec_inn')->nullable();
            $table->string('ex_06')->nullable();
            $table->string('ex_09')->nullable();
            $table->string('ex_40')->nullable();
            $table->string('ex_41')->nullable();
            $table->string('ex_43')->nullable();
            $table->string('ex_46')->nullable();
            $table->string('ex_48')->nullable();
            $table->string('ex_58')->nullable();
            $table->string('ex_60')->nullable();
            $table->string('ex_61')->nullable();
            $table->string('ex_63')->nullable();
            $table->string('ex_66')->nullable();
            $table->string('ex_69')->nullable();
            $table->string('ex_78')->nullable();
            $table->string('ex_79')->nullable();
            $table->string('result')->nullable();
            $table->string('ex_year')->nullable();
            $table->integer('status')->default(1);
            $table->foreign('send_id')->references('id')->on('users');
            $table->foreign('rec_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consolidated');
    }
}
