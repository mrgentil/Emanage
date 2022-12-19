<?php

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
    Route::get("/permissions",[PermissionController::class,'index'])->name("permission.index");

    Route::get('roles',[RoleController::class,'index'])->name('roles');
    Route::post('roles',[RoleController::class,'store'])->name('roles.store');
    Route::put('roles',[RoleController::class,'update'])->name('roles.update');
    Route::delete('roles',[RoleController::class,'destroy'])->name('roles.destroy');


});

Auth::routes(['register' => false]);

