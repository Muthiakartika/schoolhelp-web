<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SchoolAdminsController;
use App\Http\Controllers\SchoolController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

# SCHOOL HELP
Route::group(['middleware' => 'help'], function () {
    Route::group(['middleware' => ['verified']], function (){

        //LOGIN
        Route::get('/school-help', [App\Http\Controllers\HomeController::class, 'helpIndex'])
        ->name('school-help.index');
        //SCHOOL
        Route::resource('schools', SchoolController::class);
        //DELETE SCHOOL
        Route::delete('schools/delete/{id}', [SchoolController::class, 'destroy'])
        ->name('schools.destroy');
        //SCHOOL ADMIN
        Route::resource('school-admins', SchoolAdminsController::class);
         //DELETE SCHOOL
         Route::delete('school-admins/delete/{id}', [SchoolAdminsController::class, 'destroy'])
         ->name('school-admins.destroy');
    });
});

# SCHOOL ADMIN
Route::group(['middleware' => 'admin'], function () {
    Route::group(['middleware' => ['verified']], function (){

        //LOGIN
        Route::get('/school-administrator', [App\Http\Controllers\HomeController::class, 'adminIndex'])
        ->name('school-admin.index');
      
    });
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
