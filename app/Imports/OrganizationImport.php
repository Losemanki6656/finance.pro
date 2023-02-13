<?php

namespace App\Imports;

use App\Models\Organization;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class OrganizationImport implements ToCollection
{
    /**
    * @param Collection $collection
    */

    public function collection(Collection $collection)
    {
        foreach($collection as $item)
        {
            $newItem = new Organization();
            $newItem->management_id = 1;
            $newItem->railway_id = 1;
            $newItem->name = $item[0];
            $newItem->inn = $item[1];
            $newItem->save();
        }

    }

    private function CyrToLat($textcyr)
    {
        $cyr = [
            'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
            'р','с','c','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
            'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
            'Р','С','C','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я', '"'
        ];

        $lat = [
            'a','b','v','g','d','e','yo','j','z','i','y','k','l','m','n','o','p',
            'r','s','s','t','u','f','h','ts','ch','sh','sht','','i','','e','yu','ya',
            'A','B','V','G','D','E','Yo','J','Z','I','Y','K','L','M','N','O','P',
            'R','S','S','T','U','F','H','Ts','Ch','Sh','Sht','','I','','e','Yu','Ya', ''
        ];

        return str_replace($cyr, $lat, $textcyr);
    }
}
