<?php

namespace App\Imports;

use App\Models\Organization;
use App\Models\Task;
use App\Models\Consolidated;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;

class VgoImport implements ToCollection
{

    protected $user_id;
    protected $date_import;

    public function __construct($user_id, $date_import)
    {
        $this->user_id = $user_id;
        $this->date_import = $date_import;
    }

    public function collection(Collection $collection)
    {
        foreach ($collection as $item) {
            $itog = (int)$this->convert($item[5]) +
                (int)$this->convert($item[6]) +
                (int)$this->convert($item[7]) +
                (int)$this->convert($item[8]) +
                (int)$this->convert($item[9]) +
                (int)$this->convert($item[10]) +
                (int)$this->convert($item[11]) +
                (int)$this->convert($item[12]) +
                (int)$this->convert($item[13]) +
                (int)$this->convert($item[14]) +
                (int)$this->convert($item[15]) +
                (int)$this->convert($item[16]) +
                (int)$this->convert($item[17]) +
                (int)$this->convert($item[18]) +
                (int)$this->convert($item[19]) +
                (int)$this->convert($item[20]) +
                (int)$this->convert($item[21]);

            if ($item[1] != '' && $itog != 0) {
                $org = Organization::query()
                    ->where('inn', $item[4])
                    ->where('name', $item[3])->first();

                $con = new Consolidated();
                $con->send_id = $this->user_id;
                $con->send_inn = $item[2];
                $con->send_name = backpack_user()->name;

                if ($org) {
                    $con->rec_inn = $item[4];
                    $con->rec_name = $org->name;
                    $con->rec_id = $org->user_id;
                } else {
                    $con->rec_inn = $item[4];
                    $con->rec_name = $item[3];
                    $con->rec_id = null;
                }

                $con->ex_06 = $this->convert($item[5]);
                $con->ex_09 = $this->convert($item[6]);
                $con->ex_40 = $this->convert($item[7]);
                $con->ex_41 = $this->convert($item[8]);
                $con->ex_43 = $this->convert($item[9]);
                $con->ex_46 = $this->convert($item[10]);
                $con->ex_48 = $this->convert($item[11]);
                $con->ex_58 = $this->convert($item[12]);
                $con->ex_60 = $this->convert($item[13]);
                $con->ex_61 = $this->convert($item[14]);
                $con->ex_63 = $this->convert($item[15]);
                $con->ex_66 = $this->convert($item[16]);
                $con->ex_68 = $this->convert($item[17]);
                $con->ex_69 = $this->convert($item[18]);
                $con->ex_78 = $this->convert($item[19]);
                $con->ex_79 = $this->convert($item[20]);
                $con->ex_83 = $this->convert($item[21]);

                $con->result = $itog;
                $con->ex_year = $this->date_import;
                $con->save();
            }
        }
    }


    public function convert($text)
    {
        $res = str_replace([' ', ','], ['', ''], $text);
        return $res;
    }

}
