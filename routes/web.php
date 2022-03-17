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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/noticias', [App\Http\Controllers\NoticiasController::class, 'noticias'])->name('noticias')->middleware('auth');
Route::get('/centrosmedicos', [App\Http\Controllers\CentrosMedicosController::class, 'centros_medicos'])->name('centrosmedicos')->middleware('auth');
Route::get('/especialidades', [App\Http\Controllers\EspecialidadesController::class, 'especialidades'])->name('especialidades')->middleware('auth');
Route::get('/horas', [App\Http\Controllers\HorasController::class, 'horas'])->name('horas')->middleware('auth');
Route::get('/horarios', [App\Http\Controllers\HorariosController::class, 'horarios'])->name('horarios')->middleware('auth');
Route::get('/medicos', [App\Http\Controllers\MedicosController::class, 'medicos'])->name('medicos')->middleware('auth');
Route::get('/citas', [App\Http\Controllers\CitasController::class, 'citas'])->name('citas')->middleware('auth');
Route::get('/terminosycondiciones', function () {return view('terminosycondiciones');});
Route::get('/calificaciones', function () {return view('calificaciones');});
Route::get('/cambiarContrasena', function () {return view('auth.passwords.cambiarcontrasena');});
