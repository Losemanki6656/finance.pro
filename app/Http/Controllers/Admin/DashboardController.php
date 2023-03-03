<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Consolidated;
use App\Models\ConsolidateOboroti;
use App\Models\Organization;
use DB;

class DashboardController
{
    public function dashboard()
    {

        $users = Consolidated::select('send_inn')->groupBy('send_inn')->pluck('send_inn')->toArray();
        $oborots = ConsolidateOboroti::select('send_inn')->groupBy('send_inn')->pluck('send_inn')->toArray();

        $organizations = Organization::whereNotIn('inn', $users)->count();
        $organizationsOborot = Organization::whereNotIn('inn', $oborots)->count();

        $trueCount = 0; 
        $falseCount = 0; 
        $summCount = 0;

        $trueCountOborot = 0; 
        $falseCountOborot = 0; 
        $summCountOborot = 0;
        

        $users = DB::table('consolidated as con1')
            ->join('consolidated as con2', function ($join) {
                $join->on('con1.send_id', '=', 'con2.rec_id')
                     ->on('con1.rec_id', '=', 'con2.send_id')
                     ->whereRaw('con1.ex_06 + con1.ex_09 + con1.ex_40 + con1.ex_41 + con1.ex_43 + con1.ex_46 + 
                                con1.ex_48 + con1.ex_58 + con1.ex_60 + con1.ex_61 + con1.ex_63 + con1.ex_66 + con1.ex_68 + con1.ex_69 + con1.ex_78
                                + con1.ex_79 + ifnull(con1.ex_83, 0) <> -1*(con2.ex_06 + con2.ex_09 + con2.ex_40 + con2.ex_41 + con2.ex_43 + con2.ex_46 
                                + con2.ex_48 + con2.ex_58 + con2.ex_60 + con2.ex_61 + con2.ex_63 + con2.ex_66 + con2.ex_68 + con2.ex_69  + con2.ex_78 + con2.ex_79 + ifnull(con2.ex_83, 0))');
            })
            ->select([
                'con1.*',
                DB::raw('(con1.ex_06 + con1.ex_09 + con1.ex_40 + con1.ex_41 + con1.ex_43 + con1.ex_46 
                + con1.ex_48 + con1.ex_58 + con1.ex_60 + con1.ex_61 + con1.ex_63 + con1.ex_66 + con1.ex_68 + con1.ex_69 + con1.ex_78 + con1.ex_79 + ifnull(con1.ex_83, 0)
                + con2.ex_06 + con2.ex_09 + con2.ex_40 + con2.ex_41 + con2.ex_43 + con2.ex_46 
                + con2.ex_48 + con2.ex_58 + con2.ex_60 + con2.ex_61 + con2.ex_63 + con2.ex_66 + con2.ex_68 + con2.ex_69 + con2.ex_78 + con2.ex_79 + ifnull(con2.ex_83, 0)) as result1')
            ])
            ->get();

        $oborots = DB::table('consolidate_oboroti as con3')
            ->join('consolidate_oboroti as con4', function ($join) {
                $join->on('con3.send_id', '=', 'con4.rec_id')
                     ->on('con3.rec_id', '=', 'con4.send_id')
                     ->whereRaw('con3.postup_os + con3.postup_os_ot_lizing + con3.postup_tms + con3.postup_zatrat + con3.pered_os_v_lizing + con3.pered_os_cher_shet
                     + con3.poluch_os_cher_shet + con3.pered_tms + con3.poluch_tms + con3.pered_saldo_nalog + con3.pol_saldo_nalog
                     + con3.pered_prochix + con3.postup_prochix + con3.viruchka_ot_real + con3.doxod_ot_vib_os + con3.doxod_ot_vib_prochix + con3.proch_oper_doxod
                     + con3.rasxodi_perioda + con3.doxodi_vide_divid + con3.divid_obyav + con3.doxodi_vide_prosent + con3.rasxodi_vide_prosent
                     + con3.doxodi_ot_finar + con3.rasxodi_vide_prosent_po_finar + con3.doxodi_po_kurs + con3.rasxodi_po_kurs + con3.prochi_daxodi_ot_fin + con3.prochi_rasxodi_ot_fin
                     + con3.nds_oplate + con3.nds_zashet + con3.aksiz_uplate + con3.poluch_deneg + con3.uplach_deneg + con3.vzaimozashet
                     + con3.rashet_tret_litsam + con3.prochie <> -1*(con4.postup_os + con4.postup_os_ot_lizing + con4.postup_tms + con4.postup_zatrat + con4.pered_os_v_lizing + con4.pered_os_cher_shet
                     + con4.poluch_os_cher_shet + con4.pered_tms + con4.poluch_tms + con4.pered_saldo_nalog + con4.pol_saldo_nalog
                     + con4.pered_prochix + con4.postup_prochix + con4.viruchka_ot_real + con4.doxod_ot_vib_os + con4.doxod_ot_vib_prochix + con4.proch_oper_doxod
                     + con4.rasxodi_perioda + con4.doxodi_vide_divid + con4.divid_obyav + con4.doxodi_vide_prosent + con4.rasxodi_vide_prosent
                     + con4.doxodi_ot_finar + con4.rasxodi_vide_prosent_po_finar + con4.doxodi_po_kurs + con4.rasxodi_po_kurs + con4.prochi_daxodi_ot_fin + con4.prochi_rasxodi_ot_fin
                     + con4.nds_oplate + con4.nds_zashet + con4.aksiz_uplate + con4.poluch_deneg + con4.uplach_deneg + con4.vzaimozashet
                     + con4.rashet_tret_litsam + con4.prochie)');
            })
            ->select([
                'con3.*',
                DB::raw('(con3.postup_os + con3.postup_os_ot_lizing + con3.postup_tms + con3.postup_zatrat + con3.pered_os_v_lizing + con3.pered_os_cher_shet
                + con3.poluch_os_cher_shet + con3.pered_tms + con3.poluch_tms + con3.pered_saldo_nalog + con3.pol_saldo_nalog
                + con3.pered_prochix + con3.postup_prochix + con3.viruchka_ot_real + con3.doxod_ot_vib_os + con3.doxod_ot_vib_prochix + con3.proch_oper_doxod
                + con3.rasxodi_perioda + con3.doxodi_vide_divid + con3.divid_obyav + con3.doxodi_vide_prosent + con3.rasxodi_vide_prosent
                + con3.doxodi_ot_finar + con3.rasxodi_vide_prosent_po_finar + con3.doxodi_po_kurs + con3.rasxodi_po_kurs + con3.prochi_daxodi_ot_fin + con3.prochi_rasxodi_ot_fin
                + con3.nds_oplate + con3.nds_zashet + con3.aksiz_uplate + con3.poluch_deneg + con3.uplach_deneg + con3.vzaimozashet
                + con3.rashet_tret_litsam + con3.prochie
                + con4.postup_os + con4.postup_os_ot_lizing + con4.postup_tms + con4.postup_zatrat + con4.pered_os_v_lizing + con4.pered_os_cher_shet
                + con4.poluch_os_cher_shet + con4.pered_tms + con4.poluch_tms + con4.pered_saldo_nalog + con4.pol_saldo_nalog
                + con4.pered_prochix + con4.postup_prochix + con4.viruchka_ot_real + con4.doxod_ot_vib_os + con4.doxod_ot_vib_prochix + con4.proch_oper_doxod
                + con4.rasxodi_perioda + con4.doxodi_vide_divid + con4.divid_obyav + con4.doxodi_vide_prosent + con4.rasxodi_vide_prosent
                + con4.doxodi_ot_finar + con4.rasxodi_vide_prosent_po_finar + con4.doxodi_po_kurs + con4.rasxodi_po_kurs + con4.prochi_daxodi_ot_fin + con4.prochi_rasxodi_ot_fin
                + con4.nds_oplate + con4.nds_zashet + con4.aksiz_uplate + con4.poluch_deneg + con4.uplach_deneg + con4.vzaimozashet
                + con4.rashet_tret_litsam + con4.prochie) as result2')
            ])
        ->get();


        $falseCount = $users->count();
        $x = $users->where('result1','>',0)->sum('result1');
        $y = $users->where('result1','<',0)->sum('result1');
        $summCount = $x - $y;

        $falseCountOborot = $oborots->count();
        $x1 = $oborots->where('result2','>',0)->sum('result2');
        $y1 = $oborots->where('result2','<',0)->sum('result2');
        $summCountOborot = $x1 - $y1;

        return view('backpack::dashboard', [
            'organizations' => $organizations,
            'organizationsOborot' => $organizationsOborot,
            'falseCount' => $falseCount,
            'falseCountOborot' => $falseCountOborot,
            'summCount' => number_format($summCount, 4 , '.',' '),
            'summCountOborot' => number_format($summCountOborot, 4 , '.',' '),
        ]);
    }

    public function not_info_users()
    {
        $users = Consolidated::select('send_inn')->groupBy('send_inn')->pluck('send_inn')->toArray();
        $organizations = Organization::whereNotIn('inn', $users)->get();

        return view('backpack::not_info_users', [
            'organizations' => $organizations
        ]);
    }

    public function not_info_oborot_users()
    {
        $users = ConsolidateOboroti::select('send_inn')->groupBy('send_inn')->pluck('send_inn')->toArray();
        $organizations = Organization::whereNotIn('inn', $users)->get();

        return view('backpack::not_info_oborot_users', [
            'organizations' => $organizations
        ]);
    }

    public function error_info_users()
    {
        $users = DB::table('consolidated as con1')
            ->join('consolidated as con2', function ($join) {
                $join->on('con1.send_id', '=', 'con2.rec_id')
                    ->on('con1.rec_id', '=', 'con2.send_id')
                    ->whereRaw('con1.ex_06 + con1.ex_09 + con1.ex_40 + con1.ex_41 + con1.ex_43 + con1.ex_46 + 
                                con1.ex_48 + con1.ex_58 + con1.ex_60 + con1.ex_61 + con1.ex_63 + con1.ex_66 + con1.ex_68 + con1.ex_69 + con1.ex_78
                                + con1.ex_79 + ifnull(con1.ex_83, 0) <> -1*(con2.ex_06 + con2.ex_09 + con2.ex_40 + con2.ex_41 + con2.ex_43 + con2.ex_46 
                                + con2.ex_48 + con2.ex_58 + con2.ex_60 + con2.ex_61 + con2.ex_63 + con2.ex_66 + con2.ex_68 + con2.ex_69 + con2.ex_78 + con2.ex_79 + ifnull(con2.ex_83, 0))');
            })
            ->select([
                'con1.*',
                DB::raw('(con1.ex_06 + con1.ex_09 + con1.ex_40 + con1.ex_41 + con1.ex_43 + con1.ex_46 
                + con1.ex_48 + con1.ex_58 + con1.ex_60 + con1.ex_61 + con1.ex_63 + con1.ex_66 + con1.ex_68 + con1.ex_69 + con1.ex_78 + con1.ex_79 + ifnull(con1.ex_83, 0)) as result2'),
                DB::raw('(con2.ex_06 + con2.ex_09 + con2.ex_40 + con2.ex_41 + con2.ex_43 + con2.ex_46 
                + con2.ex_48 + con2.ex_58 + con2.ex_60 + con2.ex_61 + con2.ex_63 + con2.ex_66 + con2.ex_68 + con2.ex_69 + con2.ex_78 + con2.ex_79 + ifnull(con2.ex_83, 0)) as result1'),
                DB::raw('(con1.ex_06 + con1.ex_09 + con1.ex_40 + con1.ex_41 + con1.ex_43 + con1.ex_46 
                + con1.ex_48 + con1.ex_58 + con1.ex_60 + con1.ex_61 + con1.ex_63 + con1.ex_66 + con1.ex_68 + con1.ex_69 + con1.ex_78 + con1.ex_79 + ifnull(con1.ex_83, 0)
                + con2.ex_06 + con2.ex_09 + con2.ex_40 + con2.ex_41 + con2.ex_43 + con2.ex_46 
                + con2.ex_48 + con2.ex_58 + con2.ex_60 + con2.ex_61 + con2.ex_63 + con2.ex_66 + con2.ex_68 + con2.ex_69 + con2.ex_78 + con2.ex_79 + ifnull(con2.ex_83, 0)) as result3')
            ])
            ->get();


        return view('backpack::error_info_users', [
            'users' => $users
        ]);
    }

    public function error_info_oborot_users()
    {
        $users = DB::table('consolidate_oboroti as con3')
            ->join('consolidate_oboroti as con4', function ($join) {
                $join->on('con3.send_id', '=', 'con4.rec_id')
                     ->on('con3.rec_id', '=', 'con4.send_id')
                     ->whereRaw('con3.postup_os + con3.postup_os_ot_lizing + con3.postup_tms + con3.postup_zatrat + con3.pered_os_v_lizing + con3.pered_os_cher_shet
                     + con3.poluch_os_cher_shet + con3.pered_tms + con3.poluch_tms + con3.pered_saldo_nalog + con3.pol_saldo_nalog
                     + con3.pered_prochix + con3.postup_prochix + con3.viruchka_ot_real + con3.doxod_ot_vib_os + con3.doxod_ot_vib_prochix + con3.proch_oper_doxod
                     + con3.rasxodi_perioda + con3.doxodi_vide_divid + con3.divid_obyav + con3.doxodi_vide_prosent + con3.rasxodi_vide_prosent
                     + con3.doxodi_ot_finar + con3.rasxodi_vide_prosent_po_finar + con3.doxodi_po_kurs + con3.rasxodi_po_kurs + con3.prochi_daxodi_ot_fin + con3.prochi_rasxodi_ot_fin
                     + con3.nds_oplate + con3.nds_zashet + con3.aksiz_uplate + con3.poluch_deneg + con3.uplach_deneg + con3.vzaimozashet
                     + con3.rashet_tret_litsam + con3.prochie <> -1*(con4.postup_os + con4.postup_os_ot_lizing + con4.postup_tms + con4.postup_zatrat + con4.pered_os_v_lizing + con4.pered_os_cher_shet
                     + con4.poluch_os_cher_shet + con4.pered_tms + con4.poluch_tms + con4.pered_saldo_nalog + con4.pol_saldo_nalog
                     + con4.pered_prochix + con4.postup_prochix + con4.viruchka_ot_real + con4.doxod_ot_vib_os + con4.doxod_ot_vib_prochix + con4.proch_oper_doxod
                     + con4.rasxodi_perioda + con4.doxodi_vide_divid + con4.divid_obyav + con4.doxodi_vide_prosent + con4.rasxodi_vide_prosent
                     + con4.doxodi_ot_finar + con4.rasxodi_vide_prosent_po_finar + con4.doxodi_po_kurs + con4.rasxodi_po_kurs + con4.prochi_daxodi_ot_fin + con4.prochi_rasxodi_ot_fin
                     + con4.nds_oplate + con4.nds_zashet + con4.aksiz_uplate + con4.poluch_deneg + con4.uplach_deneg + con4.vzaimozashet
                     + con4.rashet_tret_litsam + con4.prochie)');
            })
            ->select([
                'con3.*',
                DB::raw('(con3.postup_os + con3.postup_os_ot_lizing + con3.postup_tms + con3.postup_zatrat + con3.pered_os_v_lizing + con3.pered_os_cher_shet
                + con3.poluch_os_cher_shet + con3.pered_tms + con3.poluch_tms + con3.pered_saldo_nalog + con3.pol_saldo_nalog
                + con3.pered_prochix + con3.postup_prochix + con3.viruchka_ot_real + con3.doxod_ot_vib_os + con3.doxod_ot_vib_prochix + con3.proch_oper_doxod
                + con3.rasxodi_perioda + con3.doxodi_vide_divid + con3.divid_obyav + con3.doxodi_vide_prosent + con3.rasxodi_vide_prosent
                + con3.doxodi_ot_finar + con3.rasxodi_vide_prosent_po_finar + con3.doxodi_po_kurs + con3.rasxodi_po_kurs + con3.prochi_daxodi_ot_fin + con3.prochi_rasxodi_ot_fin
                + con3.nds_oplate + con3.nds_zashet + con3.aksiz_uplate + con3.poluch_deneg + con3.uplach_deneg + con3.vzaimozashet
                + con3.rashet_tret_litsam + con3.prochie) as result2'),
                DB::raw('(con4.postup_os + con4.postup_os_ot_lizing + con4.postup_tms + con4.postup_zatrat + con4.pered_os_v_lizing + con4.pered_os_cher_shet
                + con4.poluch_os_cher_shet + con4.pered_tms + con4.poluch_tms + con4.pered_saldo_nalog + con4.pol_saldo_nalog
                + con4.pered_prochix + con4.postup_prochix + con4.viruchka_ot_real + con4.doxod_ot_vib_os + con4.doxod_ot_vib_prochix + con4.proch_oper_doxod
                + con4.rasxodi_perioda + con4.doxodi_vide_divid + con4.divid_obyav + con4.doxodi_vide_prosent + con4.rasxodi_vide_prosent
                + con4.doxodi_ot_finar + con4.rasxodi_vide_prosent_po_finar + con4.doxodi_po_kurs + con4.rasxodi_po_kurs + con4.prochi_daxodi_ot_fin + con4.prochi_rasxodi_ot_fin
                + con4.nds_oplate + con4.nds_zashet + con4.aksiz_uplate + con4.poluch_deneg + con4.uplach_deneg + con4.vzaimozashet
                + con4.rashet_tret_litsam + con4.prochie) as result1'),
                DB::raw('(con3.postup_os + con3.postup_os_ot_lizing + con3.postup_tms + con3.postup_zatrat + con3.pered_os_v_lizing + con3.pered_os_cher_shet
                + con3.poluch_os_cher_shet + con3.pered_tms + con3.poluch_tms + con3.pered_saldo_nalog + con3.pol_saldo_nalog
                + con3.pered_prochix + con3.postup_prochix + con3.viruchka_ot_real + con3.doxod_ot_vib_os + con3.doxod_ot_vib_prochix + con3.proch_oper_doxod
                + con3.rasxodi_perioda + con3.doxodi_vide_divid + con3.divid_obyav + con3.doxodi_vide_prosent + con3.rasxodi_vide_prosent
                + con3.doxodi_ot_finar + con3.rasxodi_vide_prosent_po_finar + con3.doxodi_po_kurs + con3.rasxodi_po_kurs + con3.prochi_daxodi_ot_fin + con3.prochi_rasxodi_ot_fin
                + con3.nds_oplate + con3.nds_zashet + con3.aksiz_uplate + con3.poluch_deneg + con3.uplach_deneg + con3.vzaimozashet
                + con3.rashet_tret_litsam + con3.prochie
                + con4.postup_os + con4.postup_os_ot_lizing + con4.postup_tms + con4.postup_zatrat + con4.pered_os_v_lizing + con4.pered_os_cher_shet
                + con4.poluch_os_cher_shet + con4.pered_tms + con4.poluch_tms + con4.pered_saldo_nalog + con4.pol_saldo_nalog
                + con4.pered_prochix + con4.postup_prochix + con4.viruchka_ot_real + con4.doxod_ot_vib_os + con4.doxod_ot_vib_prochix + con4.proch_oper_doxod
                + con4.rasxodi_perioda + con4.doxodi_vide_divid + con4.divid_obyav + con4.doxodi_vide_prosent + con4.rasxodi_vide_prosent
                + con4.doxodi_ot_finar + con4.rasxodi_vide_prosent_po_finar + con4.doxodi_po_kurs + con4.rasxodi_po_kurs + con4.prochi_daxodi_ot_fin + con4.prochi_rasxodi_ot_fin
                + con4.nds_oplate + con4.nds_zashet + con4.aksiz_uplate + con4.poluch_deneg + con4.uplach_deneg + con4.vzaimozashet
                + con4.rashet_tret_litsam + con4.prochie) as result2')
            ])
            ->get();


        return view('backpack::error_info_oborot_users', [
            'users' => $users
        ]);
    }
}
