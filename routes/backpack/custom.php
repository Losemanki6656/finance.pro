<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes

    Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');

    Route::get('info', 'InfoController@info')->name('info');

    Route::get('import', 'ImportController@getImport')->name('import');
    Route::post('import', 'ImportController@import')->name('import.post');

    Route::get('vgo-import', 'ImportController@getVgoImport')->name('vgo_import');
    Route::post('vgo-import', 'ImportController@vgo_import')->name('vgo_import.post');

    Route::get('tasks', 'ImportController@tasks')->name('tasks');
    Route::get('delete-task/{id}', 'ImportController@delete_task')->name('delete_task');

    
    Route::get('export-shaxmatka', 'ExportController@export_shaxmatka')->name('export_shaxmatka');
    Route::get('export-shaxmatka-view', 'ExportController@export_shaxmatka_view')->name('export_shaxmatka_view');

    
    Route::get('update-balance', 'ExportController@update_balance')->name('update_balance');
    Route::get('control', 'ExportController@control')->name('control');
    Route::get('control-org', 'ExportController@control_org')->name('control_org');

    Route::crud('management', 'ManagementCrudController');
    Route::crud('railway', 'RailwayCrudController');
    Route::crud('organization', 'OrganizationCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('consolidated', 'ConsolidatedCrudController');
    Route::crud('consolidateoboroti', 'ConsolidateOborotiCrudController');
    Route::crud('consolyear', 'ConsolYearCrudController');
}); // this should be the absolute last line of this file