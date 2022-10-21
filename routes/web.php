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
return view('gestionar.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/* IMPORTAR */
Route::get('/importar', [App\Http\Controllers\ImportarController::class, 'index'])->name('importar.index');
Route::post('/post/importar', [App\Http\Controllers\ImportarController::class, 'importar'])->name('importar.post');
