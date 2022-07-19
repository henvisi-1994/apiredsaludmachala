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
Route::get('/usuarios', function () {return view('usuario');});
Route::get('/cambiarContrasena', function () {return view('cambiarcontrasena');});
Route::get('/status', [App\Http\Controllers\GestionPagoController::class, 'status'])->name('status');
Route::get('/obtener_centros_medicos', [App\Http\Controllers\CentrosMedicosController::class, 'index']);
Route::get('/especialidad_cm/{id_centroMedico}', [App\Http\Controllers\EspecialidadesController::class, 'especialidad_cm']);
Route::get('/clear-cache', function () {
    echo Artisan::call('config:clear');
    echo Artisan::call('config:cache');
    echo Artisan::call('cache:clear');
    echo Artisan::call('route:clear');
 });
 Route::get('/email_comprobante/{id_especialidad}/{id_usuario}/{id_horario}/{id_medico}/{identificacion}/{id_detalleCentroMed}/{autorizacion}', [App\Http\Controllers\CitasController::class, 'email_comprobante_ios'])->name('email_comprobante_ios');
 Route::get('/email_cita/{id_especialidad}/{id_medico}/{id_horario}/{id_detalleCentroMed}/{id_usuario}', [App\Http\Controllers\CitasController::class, 'email_cita_ios'])->name('email_cita');
 Route::get('/crearCita/{id_especialidad}/{id_horario}/{id_medico}/{id_usuario}', [App\Http\Controllers\CitasController::class, 'crearCita'])->name('crearCita');
 Route::get('/medicoEspecialidad/{id_especialidad}/{id_centroMedico}', [App\Http\Controllers\MedicosController::class, 'medicoEspecialidad']);


