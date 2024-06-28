<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\FrequencyController;
use App\Http\Controllers\CompanyController;
Route::get('/', function () {
    return view('layouts.main');
});


// TYPES ROUTES
Route::resource('types', TypesController::class,['names'=>[
    'index'=>'types.index',
    'store'=>'types.store',
],'only' => ['index', 'store']]);
Route::post('/update_type',[TypesController::class, 'update_type'])->name('update_type');
// END TYPES ROUTES

// FREQUENCY ROUTES
Route::resource('frequency', FrequencyController::class,['names'=>[
    'index'=>'frequency.index',
    'store'=>'frequency.store',
],'only' => ['index', 'store']]);
Route::post('/update_frequency',[FrequencyController::class, 'update_frequency'])->name('update_frequency');
// END FREQUENCY ROUTES

// COMPANIES ROUTES
Route::resource('companies', CompanyController::class,['names'=>[
    'index'=>'companies.index',
    'store'=>'companies.store',
],'only' => ['index', 'store']]);
Route::post('/update_company',[CompanyController::class, 'update_company'])->name('update_company');
// END COMPANIES ROUTES