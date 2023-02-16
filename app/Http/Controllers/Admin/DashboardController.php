<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Consolidated;
use App\Models\Organization;

class DashboardController
{
    public function dashboard()
    {
        $users = Consolidated::select('send_inn')->groupBy('send_inn')->pluck('send_inn')->toArray();

        $organizations = Organization::whereNotIn('inn', $users)->count();

        $sendorganizations = Organization::with('send_orgs')->get();
        $allorganizations = Organization::with('send_orgs')->get();

        $trueCount = 0; $falseCount = 0; $summCount = 0; $summ = 0;
        foreach($sendorganizations as $item)
        {  
            foreach($allorganizations as $org) 
            {
               $con = $item->send_orgs->where('rec_id','!=',null)->where('rec_id', $org->user_id);
               $conback = $org->send_orgs->where('rec_id','!=',null)->where('rec_id', $item->user_id);

               $t = true; $z = true; $x = 0; $y = 0;
               if($con->count() >= 1)  {
                    $con = $con->first();
                    $x = (int)$con->ex_06 + (int)$con->ex_09 + (int)$con->ex_40 + (int)$con->ex_41 + 
                    (int)$con->ex_43 + (int)$con->ex_46 + (int)$con->ex_48 + (int)$con->ex_58 + 
                    (int)$con->ex_60 + (int)$con->ex_61 + (int)$con->ex_63 + (int)$con->ex_66 + (int)$con->ex_68 + (int)$con->ex_69 + (int)$con->ex_69 + (int)$con->ex_79;
               } else $t = false;
               
               if($conback->count() >= 1)  {
                    $conback = $conback->first();
                    $y = (int)$conback->ex_06 + (int)$conback->ex_09 + (int)$conback->ex_40 + (int)$conback->ex_41 + 
                    (int)$conback->ex_43 + (int)$conback->ex_46 + (int)$conback->ex_48 + (int)$conback->ex_58 + 
                    (int)$conback->ex_60 + (int)$conback->ex_61 + (int)$conback->ex_63 + (int)$conback->ex_66 + (int)$conback->ex_68 + (int)$conback->ex_69 + (int)$conback->ex_69 + (int)$conback->ex_79;
                } else $z = false;

                if($t == true && $z == true)
                {
                    if($x + $y == 0)  {
                        $trueCount ++;
                    } else {
                        $falseCount ++;
                        $summ = $x + $y;
                        if($summ > 0)
                        $summCount = $summCount + $summ; else $summCount = $summCount + (-1) * $summ; 
                    }
                }
                    
            }
        }

        return view('backpack::dashboard', [
            'organizations' => $organizations,
            'trueCount' => $trueCount,
            'falseCount' => $falseCount,
            'summCount' => number_format((int)$summCount,2,'.',' ')
        ]);
    }
}
