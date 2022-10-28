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
return view('auth.login');
});

/* LOGIN/REGISTER/LOGOUT/HOME */
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* IMPORTAR */
Route::get('/importar', [App\Http\Controllers\ImportarController::class, 'index'])->name('importar.index');
Route::post('/post/importar', [App\Http\Controllers\ImportarController::class, 'importar'])->name('importar.post');
Route::get('/get/pdf/{codigo}', [App\Http\Controllers\ImportarController::class, 'descargar_pdf'])->name('importar.pdf.descargar');

/* PROCESOS */
Route::get('/proceso', [App\Http\Controllers\ProcesosController::class, 'index'])->name('proceso.index');
Route::get('/proceso/tabla', [App\Http\Controllers\ProcesosController::class, 'index_tabla'])->name('proceso.index.tabla');
Route::get('/proceso/c/estado', [App\Http\Controllers\ProcesosController::class, 'actualizar_estado'])->name('proceso.cambiar.estado');
/* PRO_AJAX */
Route::get('/filtro/consulta', [App\Http\Controllers\ProcesosController::class, 'filtro'])->name('conbo.filtro');


/* GESTIONAR */
Route::get('/gestionar', [App\Http\Controllers\GestionesController::class, 'index'])->name('gestionar.index');

/* CONSULTAS */
Route::get('/consultas', [App\Http\Controllers\PacientesController::class, 'index'])->name('consultas.index');

/* ADMINISTRACION */
Route::get('/administracion', [App\Http\Controllers\AdministracionesController::class, 'index'])->name('administracion.index');

/* REPORTES */
Route::get('/reportes', [App\Http\Controllers\ReportesController::class, 'index'])->name('reportes.index');

