<?php

namespace App\Http\Controllers\Admin;


use App\Models\Task;
use App\Models\Consolidated;
use App\Models\ConsolidateOboroti;
use App\Models\ConsolYear;
use App\Models\ConsolOborotYear;

use App\Jobs\ImportVgo;

use App\Http\Controllers\Controller;
use App\Imports\OrganizationImport;
use App\Imports\VgoImport;
use App\Imports\OborotImport;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class ImportController extends Controller
{
    public function getImport()
    {
        return view('backpack::organization_import');
    }

    public function getVgoImport()
    {
        return view('backpack::vgo_import');
    }

    public function getOborotImport()
    {
        return view('backpack::oborot_import');
    }

    public function tasks()
    {

        $tasks = Task::where('user_id', backpack_user()->id)->get();

        return view('backpack::tasks',[
            'tasks' => $tasks
        ]);
    }

    public function import(Request $request)
    {
        $validator = Validator::make(
            [
                'file'      => $request->file,
                'error'     => strtolower($request->file->getClientOriginalExtension()),
            ],
            [
                'file'          => 'required',
                'error'          => 'required|in:xlsx,xls',
            ]
        );

        if ($validator->fails()) {

            $error = $validator->errors()->first();

            return view('backpack::organization_import', [
                'status' => 'error',
                'message' => $error
            ]);
        }

        Excel::import(new OrganizationImport(), $request->file('file'));

        return view('backpack::organization_import', [
            'status' => 'success',
            'message' => __('You have successfully upload file')
        ]);
    }

    public function vgo_import(Request $request)
    {
        $validator = Validator::make(
            [
                'file'      => $request->file,
                'error'     => strtolower($request->file->getClientOriginalExtension()),
            ],
            [
                'file'      => 'required',
                'error'     => 'required|in:xlsx,xls,csv',
            ]
        );

        if ($validator->fails()) {

            $error = $validator->errors()->first();

            return view('backpack::vgo_import', [
                'status' => 'error',
                'message' => $error
            ]);
        }
        
        $fileName = $request->file->getClientOriginalName();

        Consolidated::where('send_id', backpack_user()->id)->delete();

        $year = ConsolYear::where('status', false)->first();

        Excel::Import(new VgoImport(backpack_user()->id, $year->year_consol), $request->file('file'));

        return view('backpack::vgo_import', [
            'status' => 'success',
            'message' => __('You have successfully upload file')
        ]);
    }

    public function oborot_import(Request $request)
    {
        $validator = Validator::make(
            [
                'file'      => $request->file,
                'error'     => strtolower($request->file->getClientOriginalExtension()),
            ],
            [
                'file'      => 'required',
                'error'     => 'required|in:xlsx,xls,csv',
            ]
        );

        if ($validator->fails()) {

            $error = $validator->errors()->first();

            return view('backpack::oborot_import', [
                'status' => 'error',
                'message' => $error
            ]);
        }
        
        $fileName = $request->file->getClientOriginalName();

        ConsolidateOboroti::where('send_id', backpack_user()->id)->delete();

        $year = ConsolOborotYear::where('status', false)->first();

        Excel::Import(new OborotImport(backpack_user()->id, $year->year_consol), $request->file('file'));

        return view('backpack::oborot_import', [
            'status' => 'success',
            'message' => __('You have successfully upload file')
        ]);
    }

    public function delete_task(Task $id)
    {
        $id->delete();

        return redirect()->back()->with('msg' , 1);
    }
}
