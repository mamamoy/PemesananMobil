<?php

use App\Http\Controllers\ApprovingController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();


Route::middleware(['auth'])->group(function(){
    Route::resource('approving', ApprovingController::class);
    Route::resource('reservation', ReservationController::class);
    
    Route::get('/ReservationExport', [App\Http\Controllers\ReservationController::class, 'exportExcel'])->name('ReservationExport');
    Route::get('/ApprovalExport', [App\Http\Controllers\ApprovingController::class, 'exportExcel'])->name('ApprovalExport');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/getDataVehicles', [App\Http\Controllers\HomeController::class, 'getDataVehicles'])->name('getDataVehicles');
    Route::get('/getDataDrivers', [App\Http\Controllers\HomeController::class, 'getDataDrivers'])->name('getDataDrivers');
    Route::get('/getDataReservation', [App\Http\Controllers\ReservationController::class, 'getDataReservation'])->name('getDataReservation');
    Route::get('/getDataApproval', [App\Http\Controllers\ApprovingController::class, 'getDataApproval'])->name('getDataApproval');
});
