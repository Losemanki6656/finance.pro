<?php

namespace App\Http\Controllers\Admin;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ConsolidatedExport;

use Illuminate\Http\Request;

use App\Models\Organization;
use App\Models\User;

use App\Models\Consolidated;

class ExportController
{
    public function export_shaxmatka()
    {
        // $organizations = Organization::get();
        return Excel::download(new ConsolidatedExport, 'shaxmatka.xlsx');
    }

    public function export_shaxmatka_view()
    {
        $organizations = Organization::with('send_orgs')->get();
        $allorganizations = Organization::with('send_orgs')->get();

       
        foreach($organizations as $item)
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
                    (int)$con->ex_60 + (int)$con->ex_61 + (int)$con->ex_63 + (int)$con->ex_66 +  + (int)$con->ex_68 + (int)$con->ex_69 + (int)$con->ex_79;
               } else $t = false;
               
               if($conback->count() >= 1)  {
                    $conback = $conback->first();
                    $y = (int)$conback->ex_06 + (int)$conback->ex_09 + (int)$conback->ex_40 + (int)$conback->ex_41 + 
                    (int)$conback->ex_43 + (int)$conback->ex_46 + (int)$conback->ex_48 + (int)$conback->ex_58 + 
                    (int)$conback->ex_60 + (int)$conback->ex_61 + (int)$conback->ex_63 + (int)$conback->ex_66 + (int)$conback->ex_68 + (int)$conback->ex_69 + (int)$conback->ex_79;
                } else $z = false;

                if($t == true && $z = true)
                {
                    if($x + $y == 0)  $a[$item->id][$org->id] = '0'; else $a[$item->id][$org->id] = $x + $y;
                } else $a[$item->id][$org->id] = '-';
                    
            }
        }
        
        return view('backpack::shaxmatka',[
            'organizations' => $organizations,
            'a' => $a
        ]);
    }

    public function update_balance()
    {
        $cons = Consolidated::where('send_id', backpack_user()->id)->get();

        foreach($cons as $item) 
        { 
            if(!$item->rec_id) {
                $org = Organization::where('inn', $item->rec_inn)->where('name', $item->rec_name)->first();
                if($org) {
                    if($org->user_id) {
                        $item->rec_id = $org->user_id;
                        $rec_con = Consolidated::where('send_id', $item->rec_id)->where('rec_id', backpack_user()->id)->first();
                        if($rec_con)
                            {
                                dd(1);
                                if($item->result_all_int() == (-1)*$rec_con->result_all_int()) $item->status = 3; 
                                else $item->status = 4;
                            } else $item->status = 4;
                         } else $item->status = 2;
                   
                } else
                    $item->status = 2;
            } else {
                $rec_con = Consolidated::where('send_id', $item->rec_id)->where('rec_id', backpack_user()->id)->first();
                if($rec_con) {
                    if($item->result_all_int() == (-1)*$rec_con->result_all_int()) $item->status = 3; 
                    else $item->status = 4;
                } else $item->status = 5;
                
            }

            $item->save();
        }

        return back();
    }

    public function control()
    {
       $organizations = Organization::get();
        
       foreach($organizations as $item) 
       {    
            $user = new User();
            $user->name = $item->name;
            $user->email = 'user'.$item->id.'@gmail.com';
            $user->password = bcrypt('123');
            $user->save();

            $item->user_id = $user->id;
            $item->save();
       }

        return back();
    }

    public function control_org()
    {
       $organizations = Organization::get();
        
       foreach($organizations as $item) 
       {    
            $item->user_id = null;
            $item->save();
       }

        return back();
    }

}
