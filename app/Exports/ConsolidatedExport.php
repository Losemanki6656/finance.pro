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
        $organizations = Organization::with('send_orgs')->get();
        $allorganizations = Organization::with('send_orgs')->get();

       
        foreach($organizations as $item)
        {  
            foreach($allorganizations as $org) 
            {
               $con = $item->send_orgs->where('rec_id','!=',null)->where('rec_id', $org->user_id);
               $conback = $org->send_orgs->where('rec_id','!=',null)->where('rec_id', $item->user_id);

            // if($org->id == 2) dd($con);
               $t = true; $z = true; $x = 0; $y = 0;
               if($con->count() >= 1)  {
                    $con = $con->first();
                    $x = $con->result;
               } else $t = false;
               
               if($conback->count() >= 1)  {
                    $conback = $conback->first();
                    $y = $conback->result;
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
