<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


use App\Models\Organization;
use App\Models\ConsolidateOboroti;

class ConsolidateOborotiExport implements FromView
{

    public function view(): View
    {
        set_time_limit(1000);

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

                    $x = (int)$con->postup_os +  (int)$con->postup_os_ot_lizing + (int)$con->postup_tms + (int)$con->postup_zatrat + (int)$con->pered_os_v_lizing + (int)$con->pered_os_cher_shet
                        + (int)$con->poluch_os_cher_shet +  (int)$con->pered_tms + (int)$con->poluch_tms + (int)$con->pered_saldo_nalog + (int)$con->pol_saldo_nalog
                        + (int)$con->pered_prochix + (int)$con->postup_prochix + (int)$con->viruchka_ot_real + (int)$con->doxod_ot_vib_os + (int)$con->doxod_ot_vib_prochix + (int)$con->proch_oper_doxod
                        + (int)$con->rasxodi_perioda + (int)$con->doxodi_vide_divid + (int)$con->divid_obyav + (int)$con->doxodi_vide_prosent + (int)$con->rasxodi_vide_prosent
                        + (int)$con->doxodi_ot_finar + (int)$con->rasxodi_vide_prosent_po_finar + (int)$con->doxodi_po_kurs + (int)$con->rasxodi_po_kurs + (int)$con->prochi_daxodi_ot_fin + (int)$con->prochi_rasxodi_ot_fin
                        + (int)$con->nds_oplate + (int)$con->nds_zashet + (int)$con->aksiz_uplate + (int)$con->poluch_deneg + (int)$con->uplach_deneg + (int)$con->vzaimozashet
                        + (int)$con->rashet_tret_litsam + (int)$con->prochie;
                        
               } else $t = false;
               
               if($conback->count() >= 1)  {
                    $conback = $conback->first();

                    $y = (int)$conback->postup_os +  (int)$conback->postup_os_ot_lizing + (int)$conback->postup_tms + (int)$conback->postup_zatrat + (int)$conback->pered_os_v_lizing + (int)$conback->pered_os_cher_shet
                        + (int)$conback->poluch_os_cher_shet +  (int)$conback->pered_tms + (int)$conback->poluch_tms + (int)$conback->pered_saldo_nalog + (int)$conback->pol_saldo_nalog
                        + (int)$conback->pered_prochix + (int)$conback->postup_prochix + (int)$conback->viruchka_ot_real + (int)$conback->doxod_ot_vib_os + (int)$conback->doxod_ot_vib_prochix + (int)$conback->proch_oper_doxod
                        + (int)$conback->rasxodi_perioda + (int)$conback->doxodi_vide_divid + (int)$conback->divid_obyav + (int)$conback->doxodi_vide_prosent + (int)$conback->rasxodi_vide_prosent
                        + (int)$conback->doxodi_ot_finar + (int)$conback->rasxodi_vide_prosent_po_finar + (int)$conback->doxodi_po_kurs + (int)$conback->rasxodi_po_kurs + (int)$conback->prochi_daxodi_ot_fin + (int)$conback->prochi_rasxodi_ot_fin
                        + (int)$conback->nds_oplate + (int)$conback->nds_zashet + (int)$conback->aksiz_uplate + (int)$conback->poluch_deneg + (int)$conback->uplach_deneg + (int)$conback->vzaimozashet
                        + (int)$conback->rashet_tret_litsam + (int)$conback->prochie;
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
    