<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\FrequencyController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HeaderController;

Route::get('/', ['middleware' => 'guest', function()
{
    return redirect('/inventories')->with('danger','YOUR ARE ALREADY LOG IN');
}]);

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
    'confirm'=>false, // Password Confirm
]);

Route::group(['middleware' => 'auth'], function () {
    // USERS ROUTES
    Route::resource('users', UserController::class,['names'=>[
        'index'=>'users.index',
        'store'=>'users.store',
    ],'only' => ['index', 'store']]);
    Route::post('/update_user',[UserController::class, 'update_user'])->name('update_user');
    Route::get('/get_user/{user_id}',[UserController::class, 'get_user'])->name('get_user');
    Route::get('/get_user_company/{user_id}',[UserController::class, 'get_user_company'])->name('get_user_company');
    Route::get('/all_company',[UserController::class, 'all_company'])->name('all_company');

    Route::get('/test',[UserController::class, 'test'])->name('test');

    // END USERS ROUTES

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

    // LOCATION ROUTES
    Route::resource('locations', LocationController::class,['names'=>[
        'index'=>'locations.index',
        'store'=>'locations.store',
    ],'only' => ['index', 'store']]);
    Route::post('/update_location',[LocationController::class, 'update_location'])->name('update_location');
   
    // END LOCATION ROUTES

    // DEPARTMENTS ROUTES
    Route::resource('departments', DepartmentController::class,['names'=>[
        'index'=>'departments.index',
        'store'=>'departments.store',
    ],'only' => ['index', 'store']]);
    Route::post('/update_department',[DepartmentController::class, 'update_department'])->name('update_department');
    // END DEPARTMENTS ROUTES

    // INVENTORIES ROUTES
    Route::resource('inventories', InventoryController::class,['names'=>[
        'index'=>'inventories.index',
        'store'=>'inventories.store',
    ],'only' => ['index', 'store']]);
    Route::post('/update_inventory',[InventoryController::class, 'update_inventory'])->name('update_inventory');
    // END DEPARTMENTS ROUTES

    // HEADER ROUTES
    Route::resource('header', HeaderController::class,['names'=>[
        'index'=>'header.index',
        'store'=>'header.store',
    ],'only' => ['index', 'store']]);
    // END HEADER ROUTES

    // AJAX RESOURCE
    Route::post('/location_ajax',[LocationController::class, 'location_ajax'])->name('location_ajax');
    Route::post('/frequency_ajax',[FrequencyController::class, 'frequency_ajax'])->name('frequency_ajax');
    Route::post('/inventory_ajax',[InventoryController::class, 'inventory_ajax'])->name('inventory_ajax');
    // END AJAX RESOURCE
});
