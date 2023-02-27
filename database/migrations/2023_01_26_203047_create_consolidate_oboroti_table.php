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

            $table->string('postup_os')->default(0);
            $table->string('postup_os_ot_lizing')->default(0);
            $table->string('postup_tms')->default(0);
            $table->string('postup_zatrat')->default(0);
            $table->string('pered_os_v_lizing')->default(0);
            $table->string('pered_os_cher_shet')->default(0);
            $table->string('poluch_os_cher_shet')->default(0);
            $table->string('poluch_ustav_kap')->default(0);
            $table->string('bez_pered')->default(0);
            $table->string('bez_pol')->default(0);
            $table->string('pered_tms')->default(0);
            $table->string('poluch_tms')->default(0);
            $table->string('pered_saldo_nalog')->default(0);
            $table->string('pol_saldo_nalog')->default(0);
            $table->string('pered_prochix')->default(0);
            $table->string('postup_prochix')->default(0);
            $table->string('viruchka_ot_real')->default(0);
            $table->string('vtch_sob_real')->default(0);
            $table->string('doxod_ot_vib_os')->default(0);
            $table->string('vtch_ost_stoim')->default(0);
            $table->string('doxod_ot_vib_prochix')->default(0);

            $table->string('vtch_sob_proch')->default(0);
            $table->string('proch_oper_doxod')->default(0);
            $table->string('rasxodi_perioda')->default(0);
            
            $table->string('doxodi_vide_divid')->default(0);
            $table->string('divid_obyav')->default(0);
            $table->string('doxodi_vide_prosent')->default(0);
            $table->string('rasxodi_vide_prosent')->default(0);
            
            $table->string('doxodi_ot_finar')->default(0);
            $table->string('rasxodi_vide_prosent_po_finar')->default(0);
            $table->string('doxodi_po_kurs')->default(0);
            $table->string('rasxodi_po_kurs')->default(0);
            $table->string('prochi_daxodi_ot_fin')->default(0);
            $table->string('prochi_rasxodi_ot_fin')->default(0);
            
            $table->string('nds_oplate')->default(0);
            $table->string('nds_zashet')->default(0);
            $table->string('aksiz_uplate')->default(0);
            $table->string('poluch_deneg')->default(0);
            $table->string('uplach_deneg')->default(0);
            $table->string('vzaimozashet')->default(0);
            $table->string('rashet_tret_litsam')->default(0);
            $table->string('prochie')->default(0);
            $table->string('saldo')->default(0);
            $table->string('result')->default(0);
            $table->integer('ex_year')->nullable();
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
        Schema::dropIfExists('consolidate_oboroti');
    }
}
