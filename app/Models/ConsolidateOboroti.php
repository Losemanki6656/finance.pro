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
        'postup_os' => 'double',
            'postup_os_ot_lizing' => 'double',
            'postup_tms' => 'double',
            'postup_zatrat' => 'double',
            'pered_os_v_lizing' => 'double',
            'pered_os_cher_shet' => 'double',
            'poluch_os_cher_shet' => 'double',
            'poluch_ustav_kap' => 'double',
            'bez_pered' => 'double',
            'bez_pol' => 'double',
            'pered_tms' => 'double',
            'poluch_tms' => 'double',
            'pered_saldo_nalog' => 'double',
            'pol_saldo_nalog' => 'double',
            'pered_prochix' => 'double',
            'postup_prochix' => 'double',
            'viruchka_ot_real' => 'double',
            'vtch_sob_real' => 'double',
            'doxod_ot_vib_os' => 'double',
            'vtch_ost_stoim' => 'double',
            'doxod_ot_vib_prochix' => 'double',

            'vtch_sob_proch' => 'double',
            'proch_oper_doxod' => 'double',
            'rasxodi_perioda' => 'double',
            
            'doxodi_vide_divid' => 'double',
            'divid_obyav' => 'double',
            'doxodi_vide_prosent' => 'double',
            'rasxodi_vide_prosent' => 'double',
            
            'doxodi_ot_finar' => 'double',
            'rasxodi_vide_prosent_po_finar' => 'double',
            'doxodi_po_kurs' => 'double',
            'rasxodi_po_kurs' => 'double',
            'prochi_daxodi_ot_fin' => 'double',
            'prochi_rasxodi_ot_fin' => 'double',
            
            'nds_oplate' => 'double',
            'nds_zashet' => 'double',
            'aksiz_uplate' => 'double',
            'poluch_deneg' => 'double',
            'uplach_deneg' => 'double',
            'vzaimozashet' => 'double',
            'rashet_tret_litsam' => 'double',
            'prochie' => 'double',
            'saldo' => 'double'
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
        return $this->belongsTo(User::class,'rec_id');
    }

    public function send()
    {
        return $this->belongsTo(User::class,'send_id');
    }

    public function result_all()
    {
        $summ = (double)$this->postup_os +  (double)$this->postup_os_ot_lizing + (double)$this->postup_tms + (double)$this->postup_zatrat + (double)$this->pered_os_v_lizing + (double)$this->pered_os_cher_shet
        + (double)$this->poluch_os_cher_shet +  (double)$this->pered_tms + (double)$this->poluch_tms + (double)$this->pered_saldo_nalog + (double)$this->pol_saldo_nalog
        + (double)$this->pered_prochix + (double)$this->postup_prochix + (double)$this->viruchka_ot_real + (double)$this->doxod_ot_vib_os + (double)$this->doxod_ot_vib_prochix + (double)$this->proch_oper_doxod
        + (double)$this->rasxodi_perioda + (double)$this->doxodi_vide_divid + (double)$this->divid_obyav + (double)$this->doxodi_vide_prosent + (double)$this->rasxodi_vide_prosent
        + (double)$this->doxodi_ot_finar + (double)$this->rasxodi_vide_prosent_po_finar + (double)$this->doxodi_po_kurs + (double)$this->rasxodi_po_kurs + (double)$this->prochi_daxodi_ot_fin + (double)$this->prochi_rasxodi_ot_fin
        + (double)$this->nds_oplate + (double)$this->nds_zashet + (double)$this->aksiz_uplate + (double)$this->poluch_deneg + (double)$this->uplach_deneg + (double)$this->vzaimozashet
        + (double)$this->rashet_tret_litsam + (double)$this->prochie;

        return number_format($summ , 2, '.', ' ');
    }

    public function saldo_balans()
    {
        $con = Consolidated::where('send_id', $this->send_id)->where('rec_id', $this->rec_id)->first();

        if($con)
             return $con->result_double();
        else 
             return 0;
    }


    public function result_all_int()
    {
        $summ =  (double)$this->postup_os +  (double)$this->postup_os_ot_lizing + (double)$this->postup_tms + (double)$this->postup_zatrat + (double)$this->pered_os_v_lizing + (double)$this->pered_os_cher_shet
        + (double)$this->poluch_os_cher_shet +  (double)$this->pered_tms + (double)$this->poluch_tms + (double)$this->pered_saldo_nalog + (double)$this->pol_saldo_nalog
        + (double)$this->pered_prochix + (double)$this->postup_prochix + (double)$this->viruchka_ot_real + (double)$this->doxod_ot_vib_os + (double)$this->doxod_ot_vib_prochix + (double)$this->proch_oper_doxod
        + (double)$this->rasxodi_perioda + (double)$this->doxodi_vide_divid + (double)$this->divid_obyav + (double)$this->doxodi_vide_prosent + (double)$this->rasxodi_vide_prosent
        + (double)$this->doxodi_ot_finar + (double)$this->rasxodi_vide_prosent_po_finar + (double)$this->doxodi_po_kurs + (double)$this->rasxodi_po_kurs + (double)$this->prochi_daxodi_ot_fin + (double)$this->prochi_rasxodi_ot_fin
        + (double)$this->nds_oplate + (double)$this->nds_zashet + (double)$this->aksiz_uplate + (double)$this->poluch_deneg + (double)$this->uplach_deneg + (double)$this->vzaimozashet
        + (double)$this->rashet_tret_litsam + (double)$this->prochie;

        return (int)$summ;
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
