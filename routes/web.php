<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
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

//ROLE CRUD
Route::get('/roles', [RolController::class, 'index'])->name('indexRol');
Route::get('/rol/create', [RolController::class, 'create'])->name('GuardarRol');
Route::post('/rol/create', [RolController::class, 'store'])->name('StoreRol');
Route::delete('/roles/delete/{id}', [RolController::class, 'destroy'])->name('BorrarRol');
Route::get('/roles/update/{id}', [RolController::class, 'edit'])->name('EditarRol');
Route::patch('/roles/update/{id}', [RolController::class, 'update'])->name('UpdateRol');

//USUARIOS CRUD
Route::get('/user', [UserController::class, 'index'])->name('indexUser');
Route::get('/user/create', [UserController::class, 'create'])->name('GuardarUser');
Route::post('/user/create', [UserController::class, 'store'])->name('StoreUser');
Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('BorrarUser');
Route::get('/user/update/{id}', [UserController::class, 'edit'])->name('EditarUser');
Route::patch('/user/update/{id}', [UserController::class, 'update'])->name('UpdateUser');

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
Route::post('/asignar/segmentacion', [App\Http\Controllers\ProcesosController::class, 'asignar_segmentar'])->name('asignar.segmentacion');


/* GESTIONAR */
Route::get('/gestionar/{id}', [App\Http\Controllers\GestionesController::class, 'index'])->name('gestionar.index');

/* CONSULTAS */
Route::get('/consultas', [App\Http\Controllers\PacientesController::class, 'index'])->name('consultas.index');

/* ADMINISTRACION */
Route::get('/administracion', [App\Http\Controllers\AdministracionesController::class, 'index'])->name('administracion.index');

/* REPORTES */
Route::get('/reportes', [App\Http\Controllers\ReportesController::class, 'index'])->name('reportes.index');

