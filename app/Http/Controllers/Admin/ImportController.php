<?php

namespace App\Http\Controllers\Admin;


use App\Models\Task;
use App\Models\Consolidated;
use App\Models\ConsolidateOboroti;

use App\Http\Controllers\Controller;
use App\Imports\OrganizationImport;
use App\Imports\VgoImport;
use App\Imports\OborotImport;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Prologue\Alerts\Facades\Alert;


class ImportController extends Controller
{
    public function getImport()
    {
        return view('backpack::organization_import');
    }

    public function getVgoImport()
    {
        $year = now()->year;
        return view('backpack::vgo_import', compact('year'));
    }

    public function getOborotImport()
    {
        $year = now()->year;
        return view('backpack::oborot_import', compact('year'));
    }

    public function tasks()
    {

        $tasks = Task::where('user_id', backpack_user()->id)->get();

        return view('backpack::tasks', [
            'tasks' => $tasks
        ]);
    }

    public function import(Request $request)
    {
        $validator = Validator::make(
            [
                'file' => $request->file,
                'error' => strtolower($request->file->getClientOriginalExtension()),
            ],
            [
                'file' => 'required',
                'error' => 'required|in:xlsx,xls',
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
                'file' => $request->file,
                'error' => strtolower($request->file->getClientOriginalExtension()),
            ],
            [
                'file' => 'required',
                'error' => 'required|in:xlsx,xls,csv',
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
        $year = $request->year;

        Consolidated::query()->where('send_id', backpack_user()->id)->where('ex_year', $year)->delete();

        try {

            Excel::Import(new VgoImport(backpack_user()->id, $year), $request->file('file'));
        } catch (\Exception $e) {

            Alert::error($e->getMessage())->flash();
            return redirect()->back();

        }



        return view('backpack::vgo_import', [
            'status' => 'success',
            'message' => __('You have successfully upload file')
        ]);
    }

    public function oborot_import(Request $request)
    {
        $validator = Validator::make(
            [
                'file' => $request->file,
                'error' => strtolower($request->file->getClientOriginalExtension()),
            ],
            [
                'file' => 'required',
                'error' => 'required|in:xlsx,xls,csv',
            ]
        );

        if ($validator->fails()) {

            $error = $validator->errors()->first();

            return view('backpack::oborot_import', [
                'status' => 'error',
                'message' => $error
            ]);
        }
        $year = $request->year;

        ConsolidateOboroti::query()
            ->where('send_id', backpack_user()->id)
            ->where('ex_year', $year)->delete();

        try {

            Excel::Import(new OborotImport(backpack_user()->id, $year), $request->file('file'));
        } catch (\Exception $e) {

            Alert::error($e->getMessage())->flash();
            return redirect()->back();

        }

        return view('backpack::oborot_import', [
            'status' => 'success',
            'message' => __('You have successfully upload file')
        ]);
    }

    public function delete_task(Task $id)
    {
        $id->delete();

        return redirect()->back()->with('msg', 1);
    }

    public function control()
    {
        Consolidated::query()->update([
            'ex_year' => 2019
        ]);

        ConsolidateOboroti::query()->update([
            'ex_year' => 2020
        ]);

        return 'success';
    }
}
