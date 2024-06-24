<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypesController;

Route::get('/', function () {
    return view('layouts.main');
});


// TYPES ROUTES
Route::resource('types', TypesController::class,['names'=>[
    'index'=>'types.index',
    'store'=>'types.store',
],'only' => ['index', 'store']]);
Route::post('/update_type',[TypesController::class, 'update_type'])->name('update_type');
