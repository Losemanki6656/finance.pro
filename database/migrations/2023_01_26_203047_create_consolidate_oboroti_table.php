<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsolidateOborotiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consolidate_oboroti', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('send_id')->unsigned()->index()->nullable();
            $table->bigInteger('rec_id')->unsigned()->index()->nullable();
            $table->string('send_name')->nullable();
            $table->string('rec_name')->nullable();
            $table->string('send_inn')->nullable();
            $table->string('rec_inn')->nullable();

            $table->string('postup_os')->nullable();
            $table->string('postup_os_ot_lizing')->nullable();
            $table->string('postup_tms')->nullable();
            $table->string('postup_zatrat')->nullable();
            $table->string('pered_os_v_lizing')->nullable();
            $table->string('pered_os_cher_shet')->nullable();
            $table->string('poluch_os_cher_shet')->nullable();
            $table->string('poluch_ustav_kap')->nullable();
            $table->string('bez_pered')->nullable();
            $table->string('bez_pol')->nullable();
            $table->string('pered_tms')->nullable();
            $table->string('poluch_tms')->nullable();
            $table->string('pered_saldo_nalog')->nullable();
            $table->string('pol_saldo_nalog')->nullable();
            $table->string('pered_prochix')->nullable();
            $table->string('postup_prochix')->nullable();
            $table->string('viruchka_ot_real')->nullable();
            $table->string('vtch_sob_real')->nullable();
            $table->string('doxod_ot_vib_os')->nullable();
            $table->string('vtch_ost_stoim')->nullable();
            $table->string('doxod_ot_vib_prochix')->nullable();

            $table->string('vtch_sob_proch')->nullable();
            $table->string('proch_oper_doxod')->nullable();
            $table->string('rasxodi_perioda')->nullable();
            
            $table->string('doxodi_vide_divid')->nullable();
            $table->string('divid_obyav')->nullable();
            $table->string('doxodi_vide_prosent')->nullable();
            $table->string('rasxodi_vide_prosent')->nullable();
            
            $table->string('doxodi_ot_finar')->nullable();
            $table->string('rasxodi_vide_prosent_po_finar')->nullable();
            $table->string('doxodi_po_kurs')->nullable();
            $table->string('rasxodi_po_kurs')->nullable();
            $table->string('prochi_daxodi_ot_fin')->nullable();
            $table->string('prochi_rasxodi_ot_fin')->nullable();
            
            $table->string('nds_oplate')->nullable();
            $table->string('nds_zashet')->nullable();
            $table->string('aksiz_uplate')->nullable();
            $table->string('poluch_deneg')->nullable();
            $table->string('uplach_deneg')->nullable();
            $table->string('vzaimozashet')->nullable();
            $table->string('rashet_tret_litsam')->nullable();
            $table->string('prochie')->nullable();
            $table->string('saldo')->nullable();
            $table->integer('ex_year')->nullable();

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
        Schema::dropIfExists('consolidate_oboroti');
    }
}
