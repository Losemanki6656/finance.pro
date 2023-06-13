<?php

namespace App\Imports;

use App\Models\Organization;
use App\Models\Task;
use App\Models\ConsolidateOboroti;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;

class OborotImport implements ToCollection
{
    /**
    * @param Collection $collection
        
    */

    protected $user_id;
    protected $date_import;

    public function __construct($user_id, $date_import)
    {
        $this->user_id = $user_id;
        $this->date_import = $date_import;
    }

    public function collection(Collection $collection)
    {
        foreach( $collection as $item)
        {
            $itog = (int)$this->convert($item[7]) +  
                    (int)$this->convert($item[8]) + 
                    (int)$this->convert($item[9]) + 
                    (int)$this->convert($item[10]) + 
                    (int)$this->convert($item[11]) + 
                    (int)$this->convert($item[12]) + 
                    (int)$this->convert($item[13]) +  
                    (int)$this->convert($item[17]) + 
                    (int)$this->convert($item[18]) + 
                    (int)$this->convert($item[19]) + 
                    (int)$this->convert($item[20]) + 
                    (int)$this->convert($item[21]) + 
                    (int)$this->convert($item[22]) + 
                    (int)$this->convert($item[23]) + 
                    (int)$this->convert($item[25]) + 
                    (int)$this->convert($item[27]) + 
                    (int)$this->convert($item[29]) + 
                    (int)$this->convert($item[29]) + 
                    (int)$this->convert($item[30]) + 
                    (int)$this->convert($item[31]) + 
                    (int)$this->convert($item[32]) + 
                    (int)$this->convert($item[33]) + 
                    (int)$this->convert($item[34]) + 
                    (int)$this->convert($item[35]) + 
                    (int)$this->convert($item[36]) + 
                    (int)$this->convert($item[37]) + 
                    (int)$this->convert($item[38]) + 
                    (int)$this->convert($item[39]) + 
                    (int)$this->convert($item[40]) + 
                    (int)$this->convert($item[41]) + 
                    (int)$this->convert($item[42]) + 
                    (int)$this->convert($item[43]) + 
                    (int)$this->convert($item[44]) + 
                    (int)$this->convert($item[45]) + 
                    (int)$this->convert($item[46]) + 
                    (int)$this->convert($item[47]) + 
                    (int)$this->convert($item[48]);

            $status = false;
            
            for($i = 7; $i <= 48; $i ++) {
                if($this->convert($item[$i]) != '') {
                    $status = true;
                    break;
                }
            }

            if($item[1] != '' && $status == true) {

                $org = Organization::where('inn', $item[4])->where('name', $item[3])->first();

                $con = new ConsolidateOboroti();
                $con->send_id = $this->user_id;
                $con->send_inn = $item[2];
                $con->send_name = backpack_user()->name;

                if($org) {
                    $con->rec_inn = $item[4];
                    $con->rec_name = $org->name;
                    $con->rec_id = $org->user_id;

                } else {
                    $con->rec_inn = $item[4];
                    $con->rec_name = $item[3];
                    $con->rec_id = null;
                }
               
                $con->saldo_start = $this->convert($item[5]);
                $con->postup_os = $this->convert($item[7]);
                $con->postup_os_ot_lizing = $this->convert($item[8]);
                $con->postup_tms = $this->convert($item[9]);
                $con->postup_zatrat = $this->convert($item[10]);
                $con->pered_os_v_lizing = $this->convert($item[11]);
                $con->pered_os_cher_shet = $this->convert($item[12]);
                $con->poluch_os_cher_shet = $this->convert($item[13]);
                $con->poluch_ustav_kap = $this->convert($item[14]);
                $con->bez_pered = $this->convert($item[15]);
                $con->bez_pol = $this->convert($item[16]);
                $con->pered_tms = $this->convert($item[17]);
                $con->poluch_tms = $this->convert($item[18]);
                $con->pered_saldo_nalog = $this->convert($item[19]);
                $con->pol_saldo_nalog = $this->convert($item[20]);
                $con->pered_prochix = $this->convert($item[21]);
                $con->postup_prochix = $this->convert($item[22]);
                $con->viruchka_ot_real = $this->convert($item[23]);
                $con->vtch_sob_real = $this->convert($item[24]);
                $con->doxod_ot_vib_os = $this->convert($item[25]);
                $con->vtch_ost_stoim = $this->convert($item[26]);
                $con->doxod_ot_vib_prochix = $this->convert($item[27]);
                $con->vtch_sob_proch = $this->convert($item[28]);
                $con->proch_oper_doxod = $this->convert($item[29]);
                $con->rasxodi_perioda = $this->convert($item[30]);              
                $con->doxodi_vide_divid = $this->convert($item[31]);
                $con->divid_obyav = $this->convert($item[32]);
                $con->doxodi_vide_prosent = $this->convert($item[33]);
                $con->rasxodi_vide_prosent = $this->convert($item[34]);                
                $con->doxodi_ot_finar = $this->convert($item[35]);
                $con->rasxodi_vide_prosent_po_finar = $this->convert($item[36]);
                $con->doxodi_po_kurs = $this->convert($item[37]);
                $con->rasxodi_po_kurs = $this->convert($item[38]);
                $con->prochi_daxodi_ot_fin = $this->convert($item[39]);
                $con->prochi_rasxodi_ot_fin = $this->convert($item[40]);         
                $con->nds_oplate = $this->convert($item[41]);
                $con->nds_zashet = $this->convert($item[42]);
                $con->aksiz_uplate = $this->convert($item[43]);
                $con->poluch_deneg = $this->convert($item[44]);
                $con->uplach_deneg = $this->convert($item[45]);
                $con->vzaimozashet = $this->convert($item[46]);
                $con->rashet_tret_litsam = $this->convert($item[47]);
                $con->prochie = $this->convert($item[48]);
                $con->saldo = $this->convert($item[50]);

                $con->result = $itog;
                $con->ex_year = $this->date_import;
                $con->save();

            }
        }
    }


    public function convert($text)
    {
        $res = str_replace([' ',','], ['',''], $text);
        return $res;
    }

}
