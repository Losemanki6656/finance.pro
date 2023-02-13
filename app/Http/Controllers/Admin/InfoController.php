<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class InfoController
{
    
    public function info()
    {
        
        return view('backpack::info', [
        ]);
    }

}
