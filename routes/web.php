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

Route::get('/rp', function () {
    return view('reportes.excel');
});


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
Route::get('/user/perfil', [UserController::class, 'perfil'])->name('perfil');

/* IMPORTAR */
Route::get('/importar', [App\Http\Controllers\ImportarController::class, 'index'])->name('importar.index');
Route::post('/post/importar', [App\Http\Controllers\ImportarController::class, 'importar'])->name('importar.post');

/* PROCESOS */
Route::get('/proceso', [App\Http\Controllers\ProcesosController::class, 'index'])->name('proceso.index');
Route::get('/proceso/tabla', [App\Http\Controllers\ProcesosController::class, 'index_tabla'])->name('proceso.index.tabla');
Route::get('/proceso/c/estado', [App\Http\Controllers\ProcesosController::class, 'actualizar_estado'])->name('proceso.cambiar.estado');

/* PROCESO EXCELS VISTAS */
Route::get('/proceso/e/bri/{id}', [App\Http\Controllers\ProcesosController::class, 'bri_vista'])->name('proceso.e.bri');
Route::get('/proceso/e/cap/{id}', [App\Http\Controllers\ProcesosController::class, 'cap_vista'])->name('proceso.e.cap');
Route::get('/proceso/e/rec/{id}', [App\Http\Controllers\ProcesosController::class, 'rec_vista'])->name('proceso.e.rec');
Route::get('/proceso/e/ina/{id}', [App\Http\Controllers\ProcesosController::class, 'ina_vista'])->name('proceso.e.ina');
Route::get('/proceso/e/rep/{id}', [App\Http\Controllers\ProcesosController::class, 'rep_vista'])->name('proceso.e.rep');
Route::get('/proceso/e/hos/{id}', [App\Http\Controllers\ProcesosController::class, 'hos_vista'])->name('proceso.e.hos');
Route::get('/proceso/e/seg/{id}', [App\Http\Controllers\ProcesosController::class, 'seg_vista'])->name('proceso.e.seg');
Route::get('/proceso/e/filtro', [App\Http\Controllers\ProcesosController::class, 'filtro_excel'])->name('proceso.e.filtro');

/* PRO_AJAX */
Route::get('/filtro/consulta', [App\Http\Controllers\ProcesosController::class, 'filtro'])->name('conbo.filtro');
Route::post('/asignar/segmentacion', [App\Http\Controllers\ProcesosController::class, 'asignar_segmentar'])->name('asignar.segmentacion');

/* GESTIONAR */
Route::get('/gestionar/{id}', [App\Http\Controllers\GestionesController::class, 'index'])->name('gestionar.index');
Route::get('/gestionar/modal/proceso', [App\Http\Controllers\GestionesController::class, 'modal_proceso'])->name('gestionar.modal.proceso');
Route::get('/gestionar/modal/perfil', [App\Http\Controllers\GestionesController::class, 'modal_perfil'])->name('gestionar.modal.perfil');
Route::get('/gestionar/modal/gestion', [App\Http\Controllers\GestionesController::class, 'modal_gestion'])->name('gestionar.modal.gestion');
Route::post('/gestionar/modal/gestion/post', [App\Http\Controllers\GestionesController::class, 'post_gestion'])->name('gestionar.post');
Route::get('/gestion/marcar', [App\Http\Controllers\GestionesController::class, 'marcar'])->name('gestionar.marcar');

/* CAPTACIONES */
Route::get('/adm/captaciones', [App\Http\Controllers\CaptacionesController::class, 'index'])->name('captaciones.index');
Route::post('/adm/captaciones/asig', [App\Http\Controllers\CaptacionesController::class, 'asignar'])->name('captaciones.asignar');


/* PACIENTES */
Route::get('/consultas', [App\Http\Controllers\PacientesController::class, 'index'])->name('consultas.index');
Route::get('/adm/combo/dep/mun', [App\Http\Controllers\PacientesController::class, 'dep_mun'])->name('consultas.dep_mun');
Route::post('/con/pac/create', [App\Http\Controllers\PacientesController::class, 'create'])->name('consultas.create');

Route::get('/pac/get', [App\Http\Controllers\PacientesController::class, 'modal_edit'])->name('pacientes.get.edit');
Route::patch('/pac/patch', [App\Http\Controllers\PacientesController::class, 'post_edit'])->name('pacientes.edit.patch');

/* ADMINISTRACION */
Route::get('/administracion', [App\Http\Controllers\AdministracionesController::class, 'index'])->name('administracion.index');

/* REPORTES */
Route::get('/reportes', [App\Http\Controllers\ReportesController::class, 'index'])->name('reportes.index');
Route::get('/reportes/d', [App\Http\Controllers\ReportesController::class, 'reporte_descarga'])->name('reportes.descarga');

Route::get('/reportes/p', [App\Http\Controllers\ReportesController::class, 'index_personalizado'])->name('reportes.personalizados.index');


/* AYUDA */
Route::get('/ayuda', [App\Http\Controllers\AyudaController::class, 'index'])->name('ayuda.index');
