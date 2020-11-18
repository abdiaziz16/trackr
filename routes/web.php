<?php

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
    return view('/auth/login');
});


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/create', [App\Http\Controllers\HomeController::class, 'create'])->name('create');

Route::post('/approve/{id}',[App\Http\Controllers\HomeController::class, 'approve'])->name('approve');
Route::post('/review/{id}',[App\Http\Controllers\HomeController::class, 'review'])->name('review');
Route::post('/complete/{id}',[App\Http\Controllers\HomeController::class, 'complete'])->name('complete');

Route::post('/createLog',[App\Http\Controllers\HomeController::class, 'createLog'])->name('createlog');

Route::get('/download',[App\Http\Controllers\HomeController::class, 'downloadReport'])->name('download');

Route::get('/reports',[App\Http\Controllers\HomeController::class, 'reports'])->name('reports');

Route::get('/requestsReport',[App\Http\Controllers\HomeController::class, 'getAllRequests'])->name('requestsReport');

Route::post('/generateReport',[App\Http\Controllers\HomeController::class, 'generateReport'])->name('generateReport');
