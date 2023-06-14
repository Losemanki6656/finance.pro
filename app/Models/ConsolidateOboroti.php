<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class ConsolidateOboroti extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'saldo_start' => 'integer',
        'postup_os' => 'integer',
        'postup_os_ot_lizing' => 'integer',
        'postup_tms' => 'integer',
        'postup_zatrat' => 'integer',
        'pered_os_v_lizing' => 'integer',
        'pered_os_cher_shet' => 'integer',
        'poluch_os_cher_shet' => 'integer',
        'poluch_ustav_kap' => 'integer',
        'bez_pered' => 'integer',
        'bez_pol' => 'integer',
        'pered_tms' => 'integer',
        'poluch_tms' => 'integer',
        'pered_saldo_nalog' => 'integer',
        'pol_saldo_nalog' => 'integer',
        'pered_prochix' => 'integer',
        'postup_prochix' => 'integer',
        'viruchka_ot_real' => 'integer',
        'vtch_sob_real' => 'integer',
        'doxod_ot_vib_os' => 'integer',
        'vtch_ost_stoim' => 'integer',
        'doxod_ot_vib_prochix' => 'integer',
        'vtch_sob_proch' => 'integer',
        'proch_oper_doxod' => 'integer',
        'rasxodi_perioda' => 'integer',
        'doxodi_vide_divid' => 'integer',
        'divid_obyav' => 'integer',
        'doxodi_vide_prosent' => 'integer',
        'rasxodi_vide_prosent' => 'integer',
        'doxodi_ot_finar' => 'integer',
        'rasxodi_vide_prosent_po_finar' => 'integer',
        'doxodi_po_kurs' => 'integer',
        'rasxodi_po_kurs' => 'integer',
        'prochi_daxodi_ot_fin' => 'integer',
        'prochi_rasxodi_ot_fin' => 'integer',
        'nds_oplate' => 'integer',
        'nds_zashet' => 'integer',
        'aksiz_uplate' => 'integer',
        'poluch_deneg' => 'integer',
        'uplach_deneg' => 'integer',
        'vzaimozashet' => 'integer',
        'rashet_tret_litsam' => 'integer',
        'prochie' => 'integer',
        'saldo' => 'integer'
    ];

    protected $table = 'consolidate_oboroti';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function rec()
    {
        return $this->belongsTo(User::class, 'rec_id');
    }

    public function send()
    {
        return $this->belongsTo(User::class, 'send_id');
    }

    public function result_all()
    {
        $summ = (int) $this->postup_os +
            (int) $this->postup_os_ot_lizing +
            (int) $this->postup_tms +
            (int) $this->postup_zatrat +
            (int) $this->pered_os_v_lizing +
            (int) $this->pered_os_cher_shet +
            (int) $this->poluch_os_cher_shet +
            (int) $this->pered_tms +
            (int) $this->poluch_tms +
            (int) $this->pered_saldo_nalog +
            (int) $this->pol_saldo_nalog +
            (int) $this->pered_prochix +
            (int) $this->postup_prochix +
            (int) $this->viruchka_ot_real +
            (int) $this->doxod_ot_vib_os +
            (int) $this->doxod_ot_vib_prochix +
            (int) $this->proch_oper_doxod +
            (int) $this->rasxodi_perioda +
            (int) $this->doxodi_vide_divid +
            (int) $this->divid_obyav +
            (int) $this->doxodi_vide_prosent +
            (int) $this->rasxodi_vide_prosent +
            (int) $this->doxodi_ot_finar +
            (int) $this->rasxodi_vide_prosent_po_finar +
            (int) $this->doxodi_po_kurs +
            (int) $this->rasxodi_po_kurs +
            (int) $this->prochi_daxodi_ot_fin +
            (int) $this->prochi_rasxodi_ot_fin +
            (int) $this->nds_oplate +
            (int) $this->nds_zashet +
            (int) $this->aksiz_uplate +
            (int) $this->poluch_deneg +
            (int) $this->uplach_deneg +
            (int) $this->vzaimozashet +
            (int) $this->rashet_tret_litsam +
            (int) $this->prochie;

        return number_format($summ, 0, '.', ' ');
    }

    public function saldo_balans()
    {
        $con = Consolidated::where('send_id', $this->send_id)->where('rec_id', $this->rec_id)->first();

        if ($con)
            return number_format($con->allResult(), 0, '.', ' ');
        else
            return 0;
    }

    public function saldo_start()
    {
        return number_format($this->saldo_start, 0, '.', ' ');
    }

    public function saldo_kones()
    {
        return number_format($this->saldo, 0, '.', ' ');
    }


    public function allResult()
    {
        $summ = (int) $this->postup_os + (int) $this->postup_os_ot_lizing + (int) $this->postup_tms + (int) $this->postup_zatrat + (int) $this->pered_os_v_lizing + (int) $this->pered_os_cher_shet
            + (int) $this->poluch_os_cher_shet + (int) $this->pered_tms + (int) $this->poluch_tms + (int) $this->pered_saldo_nalog + (int) $this->pol_saldo_nalog
            + (int) $this->pered_prochix + (int) $this->postup_prochix + (int) $this->viruchka_ot_real + (int) $this->doxod_ot_vib_os + (int) $this->doxod_ot_vib_prochix + (int) $this->proch_oper_doxod
            + (int) $this->rasxodi_perioda + (int) $this->doxodi_vide_divid + (int) $this->divid_obyav + (int) $this->doxodi_vide_prosent + (int) $this->rasxodi_vide_prosent
            + (int) $this->doxodi_ot_finar + (int) $this->rasxodi_vide_prosent_po_finar + (int) $this->doxodi_po_kurs + (int) $this->rasxodi_po_kurs + (int) $this->prochi_daxodi_ot_fin + (int) $this->prochi_rasxodi_ot_fin
            + (int) $this->nds_oplate + (int) $this->nds_zashet + (int) $this->aksiz_uplate + (int) $this->poluch_deneg + (int) $this->uplach_deneg + (int) $this->vzaimozashet
            + (int) $this->rashet_tret_litsam + (int) $this->prochie;

        return $summ;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}