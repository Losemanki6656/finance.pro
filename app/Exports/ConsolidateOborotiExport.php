<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


use App\Models\Organization;
use App\Models\ConsolidateOboroti;

class ConsolidateOborotidExport implements FromView
{

    public function view(): View
    {
        $organizations = Organization::with('send_oborot_orgs')->get();
        $allorganizations = Organization::with('send_oborot_orgs')->get();

        foreach($organizations as $item)
        {  
            foreach($allorganizations as $org) 
            {
               $con = $item->send_oborot_orgs->whereNotNull('rec_id')->where('rec_id', $org->user_id);
               $conback = $org->send_oborot_orgs->whereNotNull('rec_id')->where('rec_id', $item->user_id);

               $t = true; $z = true; $x = 0; $y = 0;

               if($con->count() >= 1)  {
                    $con = $con->first();

                    $x = (double)$con->postup_os +  (double)$con->postup_os_ot_lizing + (double)$con->postup_tms + (double)$con->postup_zatrat + (double)$con->pered_os_v_lizing + (double)$con->pered_os_cher_shet
                        + (double)$con->poluch_os_cher_shet +  (double)$con->pered_tms + (double)$con->poluch_tms + (double)$con->pered_saldo_nalog + (double)$con->pol_saldo_nalog
                        + (double)$con->pered_prochix + (double)$con->postup_prochix + (double)$con->viruchka_ot_real + (double)$con->doxod_ot_vib_os + (double)$con->doxod_ot_vib_prochix + (double)$con->proch_oper_doxod
                        + (double)$con->rasxodi_perioda + (double)$con->doxodi_vide_divid + (double)$con->divid_obyav + (double)$con->doxodi_vide_prosent + (double)$con->rasxodi_vide_prosent
                        + (double)$con->doxodi_ot_finar + (double)$con->rasxodi_vide_prosent_po_finar + (double)$con->doxodi_po_kurs + (double)$con->rasxodi_po_kurs + (double)$con->prochi_daxodi_ot_fin + (double)$con->prochi_rasxodi_ot_fin
                        + (double)$con->nds_oplate + (double)$con->nds_zashet + (double)$con->aksiz_uplate + (double)$con->poluch_deneg + (double)$con->uplach_deneg + (double)$con->vzaimozashet
                        + (double)$con->rashet_tret_litsam + (double)$con->prochie;
                        
               } else $t = false;
               
               if($conback->count() >= 1)  {
                    $conback = $conback->first();

                    $y = (double)$conback->postup_os +  (double)$conback->postup_os_ot_lizing + (double)$conback->postup_tms + (double)$conback->postup_zatrat + (double)$conback->pered_os_v_lizing + (double)$conback->pered_os_cher_shet
                        + (double)$conback->poluch_os_cher_shet +  (double)$conback->pered_tms + (double)$conback->poluch_tms + (double)$conback->pered_saldo_nalog + (double)$conback->pol_saldo_nalog
                        + (double)$conback->pered_prochix + (double)$conback->postup_prochix + (double)$conback->viruchka_ot_real + (double)$conback->doxod_ot_vib_os + (double)$conback->doxod_ot_vib_prochix + (double)$conback->proch_oper_doxod
                        + (double)$conback->rasxodi_perioda + (double)$conback->doxodi_vide_divid + (double)$conback->divid_obyav + (double)$conback->doxodi_vide_prosent + (double)$conback->rasxodi_vide_prosent
                        + (double)$conback->doxodi_ot_finar + (double)$conback->rasxodi_vide_prosent_po_finar + (double)$conback->doxodi_po_kurs + (double)$conback->rasxodi_po_kurs + (double)$conback->prochi_daxodi_ot_fin + (double)$conback->prochi_rasxodi_ot_fin
                        + (double)$conback->nds_oplate + (double)$conback->nds_zashet + (double)$conback->aksiz_uplate + (double)$conback->poluch_deneg + (double)$conback->uplach_deneg + (double)$conback->vzaimozashet
                        + (double)$conback->rashet_tret_litsam + (double)$conback->prochie;
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
}
    