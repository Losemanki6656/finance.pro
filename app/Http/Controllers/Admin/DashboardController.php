<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Consolidated;
use App\Models\Organization;
use DB;

class DashboardController
{
    public function dashboard()
    {

        $users = Consolidated::select('send_inn')->groupBy('send_inn')->pluck('send_inn')->toArray();
        $organizations = Organization::whereNotIn('inn', $users)->count();

        // $sendorganizations = Organization::with('send_orgs')->get();
        // $allorganizations = Organization::with('send_orgs')->get();

        $trueCount = 0; 
        $falseCount = 0; 
        $summCount = 0; 
        $summ = 0;
        
        // foreach($sendorganizations as $item)
        // {  
        //     foreach($allorganizations as $org) 
        //     {
        //        $con = $item->send_orgs->whereNotNull('rec_id')->where('rec_id', $org->user_id);
               
        //        $conback = $org->send_orgs->whereNotNull('rec_id')->where('rec_id', $item->user_id);

        //        $t = true; $z = true; $x = 0; $y = 0;
        //        if($con->count() >= 1)  {
        //             $con = $con->first();
        //             $x = (int)$con->ex_06 + (int)$con->ex_09 + (int)$con->ex_40 + (int)$con->ex_41 + 
        //             (int)$con->ex_43 + (int)$con->ex_46 + (int)$con->ex_48 + (int)$con->ex_58 + 
        //             (int)$con->ex_60 + (int)$con->ex_61 + (int)$con->ex_63 + (int)$con->ex_66 + (int)$con->ex_68 + (int)$con->ex_69 + (int)$con->ex_79 + (int)$con->ex_83;
        //        } else $t = false;
               
        //        if($conback->count() >= 1)  {
        //             $conback = $conback->first();
        //             $y = (int)$conback->ex_06 + (int)$conback->ex_09 + (int)$conback->ex_40 + (int)$conback->ex_41 + 
        //             (int)$conback->ex_43 + (int)$conback->ex_46 + (int)$conback->ex_48 + (int)$conback->ex_58 + 
        //             (int)$conback->ex_60 + (int)$conback->ex_61 + (int)$conback->ex_63 + (int)$conback->ex_66 + (int)$conback->ex_68 + (int)$conback->ex_69 + (int)$conback->ex_79 + (int)$conback->ex_83;
        //         } else $z = false;

        //         if($t == true && $z == true)
        //         {
        //             if($x + $y == 0)  {
        //                 $trueCount ++;
        //             } else {
        //                 $falseCount ++;
        //                 $summ = $x + $y;
        //                 if($summ > 0)
        //                     $summCount = $summCount + $summ; else $summCount = $summCount + (-1) * $summ; 
        //             }
        //         }
                    
        //     }
        // }

        $users = DB::table('consolidated as con1')
            ->join('consolidated as con2', function ($join) {
                $join->on('con1.send_id', '=', 'con2.rec_id')
                     ->on('con1.rec_id', '=', 'con2.send_id')
                     ->whereRaw('con1.ex_06 + con1.ex_09 + con1.ex_40 + con1.ex_41 + con1.ex_43 + con1.ex_46 + 
                                con1.ex_48 + con1.ex_58 + con1.ex_60 + con1.ex_61 + con1.ex_63 + con1.ex_66 + con1.ex_68 + con1.ex_69 +  con1.ex_78
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

        $falseCount = $users->count();
        $x = $users->where('result1','>',0)->sum('result1');
        $y = $users->where('result1','<',0)->sum('result1');
        $summCount = $x - $y;

        return view('backpack::dashboard', [
            'organizations' => $organizations,
            'falseCount' => $falseCount,
            'summCount' => number_format($summCount, 4 , '.',' ')
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

    public function error_info_users()
    {
        // $sendorganizations = Organization::with('send_orgs')->get();
        // $allorganizations = Organization::with('send_orgs')->get();

        // $d = [];
        // foreach($sendorganizations as $item)
        // {  
        //     foreach($allorganizations as $org) 
        //     {
        //        $con = $item->send_orgs->where('rec_id','!=',null)->where('rec_id', $org->user_id);
               
        //        $conback = $org->send_orgs->where('rec_id','!=',null)->where('rec_id', $item->user_id);

        //        $t = true; $z = true; $x = 0; $y = 0;
        //        if($con->count() >= 1)  {
        //             $con = $con->first();
        //             $x = (int)$con->ex_06 + (int)$con->ex_09 + (int)$con->ex_40 + (int)$con->ex_41 + 
        //             (int)$con->ex_43 + (int)$con->ex_46 + (int)$con->ex_48 + (int)$con->ex_58 + 
        //             (int)$con->ex_60 + (int)$con->ex_61 + (int)$con->ex_6 + (int)$con->ex_66 + (int)$con->ex_68 + (int)$con->ex_69 + (int)$con->ex_79 + (int)$con->ex_83;
        //        } else $t = false;
               
        //        if($conback->count() >= 1)  {
        //             $conback = $conback->first();
        //             $y = (int)$conback->ex_06 + (int)$conback->ex_09 + (int)$conback->ex_40 + (int)$conback->ex_41 + 
        //             (int)$conback->ex_43 + (int)$conback->ex_46 + (int)$conback->ex_48 + (int)$conback->ex_58 + 
        //             (int)$conback->ex_60 + (int)$conback->ex_61 + (int)$conback->ex_63 + (int)$conback->ex_66 + (int)$conback->ex_68 + (int)$conback->ex_69 + (int)$conback->ex_79 + (int)$conback->ex_83;
        //         } else $z = false;

        //         if($t == true && $z == true)
        //         {
        //             if($x + $y <> 0) 
        //             {
        //                 $d[] = [
        //                     'send' => $item->name,
        //                     'rec' => $org->name,
        //                     'x' => $x,
        //                     'y' => $y,
        //                     'result' => $x + $y
        //                 ];
        //             }
        //         }
                    
        //     }
        // }

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
                + con1.ex_48 + con1.ex_58 + con1.ex_60 + con1.ex_61 + con1.ex_63 + con1.ex_66 + con1.ex_68 + con1.ex_69 + con1.ex_78 +con1.ex_79 + ifnull(con1.ex_83, 0)
                + con2.ex_06 + con2.ex_09 + con2.ex_40 + con2.ex_41 + con2.ex_43 + con2.ex_46 
                + con2.ex_48 + con2.ex_58 + con2.ex_60 + con2.ex_61 + con2.ex_63 + con2.ex_66 + con2.ex_68 + con2.ex_69 + con2.ex_78 +con2.ex_79 + ifnull(con2.ex_83, 0)) as result3')
            ])
            ->get();


        return view('backpack::error_info_users', [
            'users' => $users
        ]);
    }
}
