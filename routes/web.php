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
    'edit'=>'pallet.edit',
],'only' => ['index', 'store','edit']]);