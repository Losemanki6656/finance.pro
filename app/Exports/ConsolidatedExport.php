<?php

namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromArray;
// use Maatwebsite\Excel\Concerns\WithProperties;
// use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


use App\Models\Organization;
use App\Models\Consolidated;

class ConsolidatedExport implements FromView
{

    public function view(): View
    {
        set_time_limit(1000);

        $organizations = Organization::with('send_orgs')->get();
        $allorganizations = Organization::with('send_orgs')->get();
       
        foreach($organizations as $item)
        {  
            foreach($allorganizations as $org) 
            {
               $con = $item->send_orgs->where('rec_id', $org->user_id);
               $conback = $org->send_orgs->where('rec_id', $item->user_id);

               $t = true; $z = true; 
               $x = 0; 
               $y = 0;

                
               $u = $con->count();
               $d = $conback->count();

               if($u >= 1)  {
                    $con = $con->first();
                    $x = (int)$con->ex_06 + (int)$con->ex_09 + (int)$con->ex_40 + (int)$con->ex_41 + 
                         (int)$con->ex_43 + (int)$con->ex_46 + (int)$con->ex_48 + (int)$con->ex_58 + 
                         (int)$con->ex_60 + (int)$con->ex_61 + (int)$con->ex_63 + (int)$con->ex_66 + 
                         (int)$con->ex_68 + (int)$con->ex_69 + (int)$con->ex_78 +  (int)$con->ex_79 + (int)$con->ex_83;

               } else $t = false;
               
               if($d >= 1)  {

                    $conback = $conback->first();
                    $y = (int)$conback->ex_06 + (int)$conback->ex_09 + (int)$conback->ex_40 + (int)$conback->ex_41 + 
                        (int)$conback->ex_43 + (int)$conback->ex_46 + (int)$conback->ex_48 + (int)$conback->ex_58 + 
                        (int)$conback->ex_60 + (int)$conback->ex_61 + (int)$conback->ex_63 + (int)$conback->ex_66 + 
                        (int)$conback->ex_68 + (int)$conback->ex_69 + (int)$conback->ex_78 +  (int)$conback->ex_79 + (int)$conback->ex_83;
                        
                } else $z = false;

                if($t == false && $z == false)
                {
                    $a[$item->id][$org->id] = '-';

                } else $a[$item->id][$org->id] = $x + $y;
               
            }
        }

        

        return view('backpack::shaxmatka',[
            'organizations' => $organizations,
            'a' => $a
        ]);
    }

    // public function array(): array
    // {
    //     $organizations = Organization::get();
    //     $allorganizations = Organization::get();
    //     $a = [];
        
    //     foreach($allorganizations as $org) {
    //         $i ++;
    //         foreach($organizations as $item) {
    //             $j ++ ;

    //             $a[$i][$j] = [
    //                 $i => $item->inn
    //             ];
    //         }
    //     }
        
    //     $a = [];
        

    //     return $a;
    // }


    // public function headings(): array
    // {
    //     $a = []; $b = [];
    //     $a[] = '';
    //     $a[] = '';
    //     $b[] = '';
    //     $b[] = '';
    //     $organizations = Organization::get();
    //     foreach($organizations as $item) {
    //         $a[] =  $item->name;
    //         $b[] =  $item->inn;
    //     }

    //     return  [
    //         $a,
    //         $b,
    //      ];
    // }

    // public function properties(): array
    // {
    //     return [
    //         'creator'        => 'Patrick Brouwers',
    //         'lastModifiedBy' => 'Patrick Brouwers',
    //         'title'          => 'Invoices Export',
    //         'description'    => 'Latest Invoices',
    //         'subject'        => 'Invoices',
    //         'keywords'       => 'invoices,export,spreadsheet',
    //         'category'       => 'Invoices',
    //         'manager'        => 'Patrick Brouwers',
    //         'company'        => 'Maatwebsite',
    //     ];
    // }
}
