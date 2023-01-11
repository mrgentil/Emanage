<?php

use App\Http\Controllers\ControlController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['auth:sanctum', 'verified']], function (){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
   //Controle Accès
    Route::resource('permission',PermissionController::class);
    Route::resource('directions',DirectionController::class);
    Route::resource('departements',DepartementController::class);
    Route::resource('personnels',EmployeeController::class);
});

Auth::routes(['register' => false]);
