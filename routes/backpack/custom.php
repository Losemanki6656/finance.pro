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

    
    Route::get('oborot-import', 'ImportController@getOborotImport')->name('oborot_import');
    Route::post('oborot-import', 'ImportController@oborot_import')->name('oborot_import.post');


    Route::get('tasks', 'ImportController@tasks')->name('tasks');
    Route::get('delete-task/{id}', 'ImportController@delete_task')->name('delete_task');

    
    Route::get('not-info-users', 'DashboardController@not_info_users')->name('not_info_users');
    Route::get('error-info-users', 'DashboardController@error_info_users')->name('error_info_users');

    Route::get('not-info-oborot-users', 'DashboardController@not_info_oborot_users')->name('not_info_oborot_users');
    Route::get('error-info-oborot-users', 'DashboardController@error_info_oborot_users')->name('error_info_oborot_users');

    
    Route::get('export-shaxmatka', 'ExportController@export_shaxmatka')->name('export_shaxmatka');
    Route::get('export-oboroti-shaxmatka', 'ExportController@export_oboroti_shaxmatka')->name('export_oboroti_shaxmatka');

    Route::get('export-shaxmatka-view', 'ExportController@export_shaxmatka_view')->name('export_shaxmatka_view');
    Route::get('export-shaxmatka-oboroti-view', 'ExportController@export_shaxmatka_oborot_view')->name('export_shaxmatka_oborot_view');

    
    Route::get('update-balance', 'ExportController@update_balance')->name('update_balance');
    Route::get('update-oboroti', 'ExportController@update_oboroti')->name('update_oboroti');
    
    Route::get('control', 'ExportController@control')->name('control');
    Route::get('control-org', 'ExportController@control_org')->name('control_org');

    Route::crud('management', 'ManagementCrudController');
    Route::crud('railway', 'RailwayCrudController');
    Route::crud('organization', 'OrganizationCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('consolidated', 'ConsolidatedCrudController');
    Route::crud('consolidateoboroti', 'ConsolidateOborotiCrudController');
    Route::crud('consolyear', 'ConsolYearCrudController');
    Route::crud('consoloborotyear', 'ConsolOborotYearCrudController');
}); // this should be the absolute last line of this file