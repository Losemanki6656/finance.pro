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

        // dd(Consolidated::whereNotIn('send_id', Organization::pluck('user_id')->toArray())->get());

        $trueCount = 0; 
        $falseCount = 0; 
        $summCount = 0;

        $trueCountOborot = 0; 
        $falseCountOborot = 0; 
        $summCountOborot = 0;
        
        // $users = DB::table('consolidated as con1')
        //     ->join('consolidated as con2', function ($join) {
        //         $join->on('con1.send_id', '=', 'con2.rec_id')
        //              ->on('con1.rec_id', '=', 'con2.send_id')
        //              ->whereRaw('cast(con1.ex_06 as signed) + cast(con1.ex_09 as signed) + cast(con1.ex_40 as signed) + cast(con1.ex_41 as signed) + cast(con1.ex_43 as signed) + cast(con1.ex_46 as signed) + 
        //                         cast(con1.ex_48 as signed) + cast(con1.ex_58 as signed) + cast(con1.ex_60 as signed) + cast(con1.ex_61 as signed) + cast(con1.ex_63 as signed) + cast(con1.ex_66 as signed) + cast(con1.ex_68 as signed) + cast(con1.ex_69 as signed) + cast(con1.ex_78 as signed)
        //                         + cast(con1.ex_79 as signed) + ifnull(cast(con1.ex_83 as signed), 0) <> -1*(cast(con2.ex_06 as signed) + cast(con2.ex_09 as signed) + cast(con2.ex_40 as signed) + cast(con2.ex_41 as signed) + cast(con2.ex_43 as signed) + cast(con2.ex_46 as signed) 
        //                         + cast(con2.ex_48 as signed) + cast(con2.ex_58 as signed) + cast(con2.ex_60 as signed) + cast(con2.ex_61 as signed) + cast(con2.ex_63 as signed) + cast(con2.ex_66 as signed) + cast(con2.ex_68 as signed) + cast(con2.ex_69 as signed)  + cast(con2.ex_78 as signed) + cast(con2.ex_79 as signed) + ifnull(cast(con2.ex_83 as signed), 0))');
        //         })
        //     ->select([
        //         'con1.*',
        //         DB::raw('(cast(con1.ex_06 as signed) + cast(con1.ex_09 as signed) + cast(con1.ex_40 as signed) + cast(con1.ex_41 as signed) + cast(con1.ex_43 as signed) + cast(con1.ex_46 as signed) 
        //         + cast(con1.ex_48 as signed) + cast(con1.ex_58 as signed) + cast(con1.ex_60 as signed) + cast(con1.ex_61 as signed) + cast(con1.ex_63 as signed) + cast(con1.ex_66 as signed) + cast(con1.ex_68 as signed) + cast(con1.ex_69 as signed) + cast(con1.ex_78 as signed) + cast(con1.ex_79 as signed) + ifnull(cast(con1.ex_83 as signed), 0)
        //         + cast(con2.ex_06 as signed) + cast(con2.ex_09 as signed) + cast(con2.ex_40 as signed) + cast(con2.ex_41 as signed) + cast(con2.ex_43 as signed) + cast(con2.ex_46 as signed) 
        //         + cast(con2.ex_48 as signed) + cast(con2.ex_58 as signed) + cast(con2.ex_60 as signed) + cast(con2.ex_61 as signed) + cast(con2.ex_63 as signed) + cast(con2.ex_66 as signed) + cast(con2.ex_68 as signed) + cast(con2.ex_69 as signed) + cast(con2.ex_78 as signed) + cast(con2.ex_79 as signed) + ifnull(cast(con2.ex_83 as signed), 0)) as result1')
        //     ])
        //     ->get();
        
        // $users = DB::table('consolidated as con1')
        //     ->join('consolidated as con2', function ($join) {
        //         $join->on('con1.rec_id', '=', 'con2.send_id')
        //             ->select(['con2.*', 
        //                 'SUM(if(con2.rec_id = con1.send_id, 1, 0)) AS countq'
        //             ])
        //             ->where('countq',0);
        //         })
        //     ->select([
        //         'con2.*'
        //      ])
        //     ->paginate(2);

        // dd($users);

        $users = DB::table('consolidated as con1')
        ->whereNotNull('con1.rec_id')
        ->whereIn('con1.status', [ 4, 5 ]);
        $falseCount = $users->count();
            $users = $users->select( DB::raw('SUM(con1.result_a + ifnull(con1.result_b,0) ) as result1'))
            ->get();

        //  dd($users);

        // $oborots = DB::table('consolidate_oboroti as con3')
        //     ->join('consolidate_oboroti as con4', function ($join) {
        //         $join->on('con3.send_id', '=', 'con4.rec_id')
        //              ->on('con3.rec_id', '=', 'con4.send_id')
        //              ->whereRaw('(cast(con3.postup_os as signed) + cast(con3.postup_os_ot_lizing as signed) + cast(con3.postup_tms as signed) + cast(con3.postup_zatrat as signed) + cast(con3.pered_os_v_lizing as signed) + cast(con3.pered_os_cher_shet as signed)
        //              + cast(con3.poluch_os_cher_shet as signed) + cast(con3.pered_tms as signed) + cast(con3.poluch_tms as signed) + cast(con3.pered_saldo_nalog as signed) + cast(con3.pol_saldo_nalog as signed)
        //              + cast(con3.pered_prochix as signed) + cast(con3.postup_prochix as signed) + cast(con3.viruchka_ot_real as signed) + cast(con3.doxod_ot_vib_os as signed) + cast(con3.doxod_ot_vib_prochix as signed) + cast(con3.proch_oper_doxod as signed)
        //              + cast(con3.rasxodi_perioda as signed) + cast(con3.doxodi_vide_divid as signed) + cast(con3.divid_obyav as signed) + cast(con3.doxodi_vide_prosent as signed) + cast(con3.rasxodi_vide_prosent as signed)
        //              + cast(con3.doxodi_ot_finar as signed) + cast(con3.rasxodi_vide_prosent_po_finar as signed) + cast(con3.doxodi_po_kurs as signed) + cast(con3.rasxodi_po_kurs as signed) + cast(con3.prochi_daxodi_ot_fin as signed) + cast(con3.prochi_rasxodi_ot_fin as signed)
        //              + cast(con3.nds_oplate as signed) + cast(con3.nds_zashet as signed) + cast(con3.aksiz_uplate as signed) + cast(con3.poluch_deneg as signed) + cast(con3.uplach_deneg as signed) + cast(con3.vzaimozashet as signed)
        //              + cast(con3.rashet_tret_litsam as signed) + cast(con3.prochie as signed)) <> -1*(cast(con4.postup_os as signed) + cast(con4.postup_os_ot_lizing as signed) + cast(con4.postup_tms as signed) + cast(con4.postup_zatrat as signed) + cast(con4.pered_os_v_lizing as signed) + cast(con4.pered_os_cher_shet as signed)
        //              + cast(con4.poluch_os_cher_shet as signed) + cast(con4.pered_tms as signed) + cast(con4.poluch_tms as signed) + cast(con4.pered_saldo_nalog as signed) + cast(con4.pol_saldo_nalog as signed)
        //              + cast(con4.pered_prochix as signed) + cast(con4.postup_prochix as signed) + cast(con4.viruchka_ot_real as signed) + cast(con4.doxod_ot_vib_os as signed) + cast(con4.doxod_ot_vib_prochix as signed) + cast(con4.proch_oper_doxod as signed)
        //              + cast(con4.rasxodi_perioda as signed) + cast(con4.doxodi_vide_divid as signed) + cast(con4.divid_obyav as signed) + cast(con4.doxodi_vide_prosent as signed) + cast(con4.rasxodi_vide_prosent as signed)
        //              + cast(con4.doxodi_ot_finar as signed) + cast(con4.rasxodi_vide_prosent_po_finar as signed) + cast(con4.doxodi_po_kurs as signed) + cast(con4.rasxodi_po_kurs as signed) + cast(con4.prochi_daxodi_ot_fin as signed) + cast(con4.prochi_rasxodi_ot_fin as signed)
        //              + cast(con4.nds_oplate as signed) + cast(con4.nds_zashet as signed) + cast(con4.aksiz_uplate as signed) + cast(con4.poluch_deneg as signed) + cast(con4.uplach_deneg as signed) + cast(con4.vzaimozashet as signed)
        //              + cast(con4.rashet_tret_litsam as signed) + cast(con4.prochie as signed))');
        //     })
        //     ->select([
        //         'con3.*',
        //         DB::raw('(cast(con3.postup_os as signed) + cast(con3.postup_os_ot_lizing as signed) + cast(con3.postup_tms as signed) + cast(con3.postup_zatrat as signed) + cast(con3.pered_os_v_lizing as signed) + cast(con3.pered_os_cher_shet as signed)
        //         + cast(con3.poluch_os_cher_shet as signed) + cast(con3.pered_tms as signed) + cast(con3.poluch_tms as signed) + cast(con3.pered_saldo_nalog as signed) + cast(con3.pol_saldo_nalog as signed)
        //         + cast(con3.pered_prochix as signed) + cast(con3.postup_prochix as signed) + cast(con3.viruchka_ot_real as signed) + cast(con3.doxod_ot_vib_os as signed) + cast(con3.doxod_ot_vib_prochix as signed) + cast(con3.proch_oper_doxod as signed)
        //         + cast(con3.rasxodi_perioda as signed) + cast(con3.doxodi_vide_divid as signed) + cast(con3.divid_obyav as signed) + cast(con3.doxodi_vide_prosent as signed) + cast(con3.rasxodi_vide_prosent as signed)
        //         + cast(con3.doxodi_ot_finar as signed) + cast(con3.rasxodi_vide_prosent_po_finar as signed) + cast(con3.doxodi_po_kurs as signed) + cast(con3.rasxodi_po_kurs as signed) + cast(con3.prochi_daxodi_ot_fin as signed) + cast(con3.prochi_rasxodi_ot_fin as signed)
        //         + cast(con3.nds_oplate as signed) + cast(con3.nds_zashet as signed) + cast(con3.aksiz_uplate as signed) + cast(con3.poluch_deneg as signed) + cast(con3.uplach_deneg as signed) + cast(con3.vzaimozashet as signed)
        //         + cast(con3.rashet_tret_litsam as signed) + cast(con3.prochie as signed)
        //         + cast(con4.postup_os as signed) + cast(con4.postup_os_ot_lizing as signed) + cast(con4.postup_tms as signed) + cast(con4.postup_zatrat as signed) + cast(con4.pered_os_v_lizing as signed) + cast(con4.pered_os_cher_shet as signed)
        //         + cast(con4.poluch_os_cher_shet as signed) + cast(con4.pered_tms as signed) + cast(con4.poluch_tms as signed) + cast(con4.pered_saldo_nalog as signed) + cast(con4.pol_saldo_nalog as signed)
        //         + cast(con4.pered_prochix as signed) + cast(con4.postup_prochix as signed) + cast(con4.viruchka_ot_real as signed) + cast(con4.doxod_ot_vib_os as signed) + cast(con4.doxod_ot_vib_prochix as signed) + cast(con4.proch_oper_doxod as signed)
        //         + cast(con4.rasxodi_perioda as signed) + cast(con4.doxodi_vide_divid as signed) + cast(con4.divid_obyav as signed) + cast(con4.doxodi_vide_prosent as signed) + cast(con4.rasxodi_vide_prosent as signed)
        //         + cast(con4.doxodi_ot_finar as signed) + cast(con4.rasxodi_vide_prosent_po_finar as signed) + cast(con4.doxodi_po_kurs as signed) + cast(con4.rasxodi_po_kurs as signed) + cast(con4.prochi_daxodi_ot_fin as signed) + cast(con4.prochi_rasxodi_ot_fin as signed)
        //         + cast(con4.nds_oplate as signed) + cast(con4.nds_zashet as signed) + cast(con4.aksiz_uplate as signed) + cast(con4.poluch_deneg as signed) + cast(con4.uplach_deneg as signed) + cast(con4.vzaimozashet as signed)
        //         + cast(con4.rashet_tret_litsam as signed) + cast(con4.prochie as signed)) as result2')
        //     ])
        // ->get();

        $oborots = DB::table('consolidate_oboroti as con3')
            ->whereNotNull('con3.rec_id')
            ->whereIn('con3.status', [ 4, 5 ]);

        $falseCountOborot = $oborots->count();
        $oborots = $oborots->select( DB::raw('SUM(result_a + ifnull(result_b,0)) as result2'))->get();


        // $falseCount = $users->count();
        $summCount = 2 * $users->where('result1')->sum('result1');
        $summCountOborot = 2 * $oborots->where('result2')->sum('result2');

        return view('backpack::dashboard', [
            'organizations' => $organizations,
            'organizationsOborot' => $organizationsOborot,
            'falseCount' => $falseCount,
            'falseCountOborot' => $falseCountOborot,
            'summCount' => number_format($summCount, 0 , '',' '),
            'summCountOborot' => number_format($summCountOborot, 0 , '',' '),
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
            // $users = DB::table('consolidated as con1')
            // ->join('consolidated as con2', function ($join) {
            //     $join->on('con1.send_id', '=', 'con2.rec_id')
            //         ->on('con1.rec_id', '=', 'con2.send_id')
            //         ->whereRaw('cast(con1.ex_06 as signed) + cast(con1.ex_09 as signed) + cast(con1.ex_40 as signed) + cast(con1.ex_41 as signed) + cast(con1.ex_43 as signed) + cast(con1.ex_46 as signed) + 
            //                     cast(con1.ex_48 as signed) + cast(con1.ex_58 as signed) + cast(con1.ex_60 as signed) + cast(con1.ex_61 as signed) + cast(con1.ex_63 as signed) + cast(con1.ex_66 as signed) + cast(con1.ex_68 as signed) + cast(con1.ex_69 as signed) + cast(con1.ex_78 as signed)
            //                     + cast(con1.ex_79 as signed) + ifnull(cast(con1.ex_83 as signed), 0) <> -1*(cast(con2.ex_06 as signed) + cast(con2.ex_09 as signed) + cast(con2.ex_40 as signed) + cast(con2.ex_41 as signed) + cast(con2.ex_43 as signed) + cast(con2.ex_46 as signed) 
            //                     + cast(con2.ex_48 as signed) + cast(con2.ex_58 as signed) + cast(con2.ex_60 as signed) + cast(con2.ex_61 as signed) + cast(con2.ex_63 as signed) + cast(con2.ex_66 as signed) + cast(con2.ex_68 as signed) + cast(con2.ex_69 as signed) + cast(con2.ex_78 as signed) + cast(con2.ex_79 as signed) + ifnull(cast(con2.ex_83 as signed), 0))');
            // })
            // ->select([
            //     'con1.*',
            //     DB::raw('(cast(con1.ex_06 as signed) + cast(con1.ex_09 as signed) + cast(con1.ex_40 as signed) + cast(con1.ex_41 as signed) + cast(con1.ex_43 as signed) + cast(con1.ex_46 as signed) 
            //     + cast(con1.ex_48 as signed) + cast(con1.ex_58 as signed) + cast(con1.ex_60 as signed) + cast(con1.ex_61 as signed) + cast(con1.ex_63 as signed) + cast(con1.ex_66 as signed) + cast(con1.ex_68 as signed) + cast(con1.ex_69 as signed) + cast(con1.ex_78 as signed) + cast(con1.ex_79 as signed) + ifnull(cast(con1.ex_83 as signed), 0)) as result2'),
            //     DB::raw('(cast(con2.ex_06 as signed) + cast(con2.ex_09 as signed) + cast(con2.ex_40 as signed) + cast(con2.ex_41 as signed) + cast(con2.ex_43 as signed) + cast(con2.ex_46 as signed) 
            //     + cast(con2.ex_48 as signed) + cast(con2.ex_58 as signed) + cast(con2.ex_60 as signed) + cast(con2.ex_61 as signed) + cast(con2.ex_63 as signed) + cast(con2.ex_66 as signed) + cast(con2.ex_68 as signed) + cast(con2.ex_69 as signed) + cast(con2.ex_78 as signed) + cast(con2.ex_79 as signed) + ifnull(cast(con2.ex_83 as signed), 0)) as result1'),
            //     DB::raw('(cast(con1.ex_06 as signed) + cast(con1.ex_09 as signed) + cast(con1.ex_40 as signed) + cast(con1.ex_41 as signed) + cast(con1.ex_43 as signed) + cast(con1.ex_46 as signed) 
            //     + cast(con1.ex_48 as signed) + cast(con1.ex_58 as signed) + cast(con1.ex_60 as signed) + cast(con1.ex_61 as signed) + cast(con1.ex_63 as signed) + cast(con1.ex_66 as signed) + cast(con1.ex_68 as signed) + cast(con1.ex_69 as signed) + cast(con1.ex_78 as signed) + cast(con1.ex_79 as signed) + ifnull(cast(con1.ex_83 as signed), 0)
            //     + cast(con2.ex_06 as signed) + cast(con2.ex_09 as signed) + cast(con2.ex_40 as signed) + cast(con2.ex_41 as signed) + cast(con2.ex_43 as signed) + cast(con2.ex_46 as signed) 
            //     + cast(con2.ex_48 as signed) + cast(con2.ex_58 as signed) + cast(con2.ex_60 as signed) + cast(con2.ex_61 as signed) + cast(con2.ex_63 as signed) + cast(con2.ex_66 as signed) + cast(con2.ex_68 as signed) + cast(con2.ex_69 as signed) + cast(con2.ex_78 as signed) + cast(con2.ex_79 as signed) + ifnull(cast(con2.ex_83 as signed), 0)) as result3')
            // ])
            // ->get();

        $users = DB::table('consolidated as con1')
            ->whereNotNull('con1.rec_id')
            ->whereIn('con1.status', [ 4, 5 ])->get();

        return view('backpack::error_info_users', [
            'users' => $users
        ]);
    }

    public function error_info_oborot_users()
    {
            // $users = DB::table('consolidate_oboroti as con3')
            // ->join('consolidate_oboroti as con4', function ($join) {
            //     $join->on('con3.send_id', '=', 'con4.rec_id')
            //          ->on('con3.rec_id', '=', 'con4.send_id')
            //          ->whereRaw('cast(con3.postup_os as signed) + cast(con3.postup_os_ot_lizing as signed) + cast(con3.postup_tms as signed) + cast(con3.postup_zatrat as signed) + cast(con3.pered_os_v_lizing as signed) + cast(con3.pered_os_cher_shet as signed)
            //          + cast(con3.poluch_os_cher_shet as signed) + cast(con3.pered_tms as signed) + cast(con3.poluch_tms as signed) + cast(con3.pered_saldo_nalog as signed) + cast(con3.pol_saldo_nalog as signed)
            //          + cast(con3.pered_prochix as signed) + cast(con3.postup_prochix as signed) + cast(con3.viruchka_ot_real as signed) + cast(con3.doxod_ot_vib_os as signed) + cast(con3.doxod_ot_vib_prochix as signed) + cast(con3.proch_oper_doxod as signed)
            //          + cast(con3.rasxodi_perioda as signed) + cast(con3.doxodi_vide_divid as signed) + cast(con3.divid_obyav as signed) + cast(con3.doxodi_vide_prosent as signed) + cast(con3.rasxodi_vide_prosent as signed)
            //          + cast(con3.doxodi_ot_finar as signed) + cast(con3.rasxodi_vide_prosent_po_finar as signed) + cast(con3.doxodi_po_kurs as signed) + cast(con3.rasxodi_po_kurs as signed) + cast(con3.prochi_daxodi_ot_fin as signed) + cast(con3.prochi_rasxodi_ot_fin as signed)
            //          + cast(con3.nds_oplate as signed) + cast(con3.nds_zashet as signed) + cast(con3.aksiz_uplate as signed) + cast(con3.poluch_deneg as signed) + cast(con3.uplach_deneg as signed) + cast(con3.vzaimozashet as signed)
            //          + cast(con3.rashet_tret_litsam as signed) + cast(con3.prochie as signed) <> -1*(cast(con4.postup_os as signed) + cast(con4.postup_os_ot_lizing as signed) + cast(con4.postup_tms as signed) + cast(con4.postup_zatrat as signed) + cast(con4.pered_os_v_lizing as signed) + cast(con4.pered_os_cher_shet as signed)
            //          + cast(con4.poluch_os_cher_shet as signed) + cast(con4.pered_tms as signed) + cast(con4.poluch_tms as signed) + cast(con4.pered_saldo_nalog as signed) + cast(con4.pol_saldo_nalog as signed)
            //          + cast(con4.pered_prochix as signed) + cast(con4.postup_prochix as signed) + cast(con4.viruchka_ot_real as signed) + cast(con4.doxod_ot_vib_os as signed) + cast(con4.doxod_ot_vib_prochix as signed) + cast(con4.proch_oper_doxod as signed)
            //          + cast(con4.rasxodi_perioda as signed) + cast(con4.doxodi_vide_divid as signed) + cast(con4.divid_obyav as signed) + cast(con4.doxodi_vide_prosent as signed) + cast(con4.rasxodi_vide_prosent as signed)
            //          + cast(con4.doxodi_ot_finar as signed) + cast(con4.rasxodi_vide_prosent_po_finar as signed) + cast(con4.doxodi_po_kurs as signed) + cast(con4.rasxodi_po_kurs as signed) + cast(con4.prochi_daxodi_ot_fin as signed) + cast(con4.prochi_rasxodi_ot_fin as signed)
            //          + cast(con4.nds_oplate as signed) + cast(con4.nds_zashet as signed) + cast(con4.aksiz_uplate as signed) + cast(con4.poluch_deneg as signed) + cast(con4.uplach_deneg as signed) + cast(con4.vzaimozashet as signed)
            //          + cast(con4.rashet_tret_litsam as signed) + cast(con4.prochie as signed))');
            // })
            // ->select([
            //     'con3.*',
            //     DB::raw('(cast(con3.postup_os as signed) + cast(con3.postup_os_ot_lizing as signed) + cast(con3.postup_tms as signed) + cast(con3.postup_zatrat as signed) + cast(con3.pered_os_v_lizing as signed) + cast(con3.pered_os_cher_shet as signed)
            //     + cast(con3.poluch_os_cher_shet as signed) + cast(con3.pered_tms as signed) + cast(con3.poluch_tms as signed) + cast(con3.pered_saldo_nalog as signed) + cast(con3.pol_saldo_nalog as signed)
            //     + cast(con3.pered_prochix as signed) + cast(con3.postup_prochix as signed) + cast(con3.viruchka_ot_real as signed) + cast(con3.doxod_ot_vib_os as signed) + cast(con3.doxod_ot_vib_prochix as signed) + cast(con3.proch_oper_doxod as signed)
            //     + cast(con3.rasxodi_perioda as signed) + cast(con3.doxodi_vide_divid as signed) + cast(con3.divid_obyav as signed) + cast(con3.doxodi_vide_prosent as signed) + cast(con3.rasxodi_vide_prosent as signed)
            //     + cast(con3.doxodi_ot_finar as signed) + cast(con3.rasxodi_vide_prosent_po_finar as signed) + cast(con3.doxodi_po_kurs as signed) + cast(con3.rasxodi_po_kurs as signed) + cast(con3.prochi_daxodi_ot_fin as signed) + cast(con3.prochi_rasxodi_ot_fin as signed)
            //     + cast(con3.nds_oplate as signed) + cast(con3.nds_zashet as signed) + cast(con3.aksiz_uplate as signed) + cast(con3.poluch_deneg as signed) + cast(con3.uplach_deneg as signed) + cast(con3.vzaimozashet as signed)
            //     + cast(con3.rashet_tret_litsam as signed) + cast(con3.prochie as signed)) as result2'),
            //     DB::raw('(cast(con4.postup_os as signed) + cast(con4.postup_os_ot_lizing as signed) + cast(con4.postup_tms as signed) + cast(con4.postup_zatrat as signed) + cast(con4.pered_os_v_lizing as signed) + cast(con4.pered_os_cher_shet as signed)
            //     + cast(con4.poluch_os_cher_shet as signed) + cast(con4.pered_tms as signed) + cast(con4.poluch_tms as signed) + cast(con4.pered_saldo_nalog as signed) + cast(con4.pol_saldo_nalog as signed)
            //     + cast(con4.pered_prochix as signed) + cast(con4.postup_prochix as signed) + cast(con4.viruchka_ot_real as signed) + cast(con4.doxod_ot_vib_os as signed) + cast(con4.doxod_ot_vib_prochix as signed) + cast(con4.proch_oper_doxod as signed)
            //     + cast(con4.rasxodi_perioda as signed) + cast(con4.doxodi_vide_divid as signed) + cast(con4.divid_obyav as signed) + cast(con4.doxodi_vide_prosent as signed) + cast(con4.rasxodi_vide_prosent as signed)
            //     + cast(con4.doxodi_ot_finar as signed) + cast(con4.rasxodi_vide_prosent_po_finar as signed) + cast(con4.doxodi_po_kurs as signed) + cast(con4.rasxodi_po_kurs as signed) + cast(con4.prochi_daxodi_ot_fin as signed) + cast(con4.prochi_rasxodi_ot_fin as signed)
            //     + cast(con4.nds_oplate as signed) + cast(con4.nds_zashet as signed) + cast(con4.aksiz_uplate as signed) + cast(con4.poluch_deneg as signed) + cast(con4.uplach_deneg as signed) + cast(con4.vzaimozashet as signed)
            //     + cast(con4.rashet_tret_litsam as signed) + cast(con4.prochie as signed)) as result1'),
            //     DB::raw('(cast(con3.postup_os as signed) + cast(con3.postup_os_ot_lizing as signed) + cast(con3.postup_tms as signed) + cast(con3.postup_zatrat as signed) + cast(con3.pered_os_v_lizing as signed) + cast(con3.pered_os_cher_shet as signed)
            //     + cast(con3.poluch_os_cher_shet as signed) + cast(con3.pered_tms as signed) + cast(con3.poluch_tms as signed) + cast(con3.pered_saldo_nalog as signed) + cast(con3.pol_saldo_nalog as signed)
            //     + cast(con3.pered_prochix as signed) + cast(con3.postup_prochix as signed) + cast(con3.viruchka_ot_real as signed) + cast(con3.doxod_ot_vib_os as signed) + cast(con3.doxod_ot_vib_prochix as signed) + cast(con3.proch_oper_doxod as signed)
            //     + cast(con3.rasxodi_perioda as signed) + cast(con3.doxodi_vide_divid as signed) + cast(con3.divid_obyav as signed) + cast(con3.doxodi_vide_prosent as signed) + cast(con3.rasxodi_vide_prosent as signed)
            //     + cast(con3.doxodi_ot_finar as signed) + cast(con3.rasxodi_vide_prosent_po_finar as signed) + cast(con3.doxodi_po_kurs as signed) + cast(con3.rasxodi_po_kurs as signed) + cast(con3.prochi_daxodi_ot_fin as signed) + cast(con3.prochi_rasxodi_ot_fin as signed)
            //     + cast(con3.nds_oplate as signed) + cast(con3.nds_zashet as signed) + cast(con3.aksiz_uplate as signed) + cast(con3.poluch_deneg as signed) + cast(con3.uplach_deneg as signed) + cast(con3.vzaimozashet as signed)
            //     + cast(con3.rashet_tret_litsam as signed) + cast(con3.prochie as signed)
            //     + cast(con4.postup_os as signed) + cast(con4.postup_os_ot_lizing as signed) + cast(con4.postup_tms as signed) + cast(con4.postup_zatrat as signed) + cast(con4.pered_os_v_lizing as signed) + cast(con4.pered_os_cher_shet as signed)
            //     + cast(con4.poluch_os_cher_shet as signed) + cast(con4.pered_tms as signed) + cast(con4.poluch_tms as signed) + cast(con4.pered_saldo_nalog as signed) + cast(con4.pol_saldo_nalog as signed)
            //     + cast(con4.pered_prochix as signed) + cast(con4.postup_prochix as signed) + cast(con4.viruchka_ot_real as signed) + cast(con4.doxod_ot_vib_os as signed) + cast(con4.doxod_ot_vib_prochix as signed) + cast(con4.proch_oper_doxod as signed)
            //     + cast(con4.rasxodi_perioda as signed) + cast(con4.doxodi_vide_divid as signed) + cast(con4.divid_obyav as signed) + cast(con4.doxodi_vide_prosent as signed) + cast(con4.rasxodi_vide_prosent as signed)
            //     + cast(con4.doxodi_ot_finar as signed) + cast(con4.rasxodi_vide_prosent_po_finar as signed) + cast(con4.doxodi_po_kurs as signed) + cast(con4.rasxodi_po_kurs as signed) + cast(con4.prochi_daxodi_ot_fin as signed) + cast(con4.prochi_rasxodi_ot_fin as signed)
            //     + cast(con4.nds_oplate as signed) + cast(con4.nds_zashet as signed) + cast(con4.aksiz_uplate as signed) + cast(con4.poluch_deneg as signed) + cast(con4.uplach_deneg as signed) + cast(con4.vzaimozashet as signed)
            //     + cast(con4.rashet_tret_litsam as signed) + cast(con4.prochie as signed)) as result3')
            // ])
            // ->get();

            
        $users = DB::table('consolidate_oboroti as con3')
            // ->where('con3.result_a','!=', 0)
            // ->whereNotNull('con3.result_b')
            ->whereNotNull('con3.rec_id')
            ->whereIn('con3.status', [ 4, 5 ])->get();

       
        return view('backpack::error_info_oborot_users', [
            'users' => $users
        ]);
    }
}
