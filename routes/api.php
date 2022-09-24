<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('noticias', 'NoticiasController');
Route::post('/updatenoticia/{id}', [App\Http\Controllers\NoticiasController::class, 'update'])->name('updatenoticia');
Route::post('/logueo', [AuthController::class, 'login']);
Route::get('/all', [App\Http\Controllers\NoticiasController::class, 'all']);
//Rutas de Centros Medicos
Route::resource('centros_medicos', 'CentrosMedicosController');
Route::get('/obtener_centros_medicos', [App\Http\Controllers\CentrosMedicosController::class, 'obtener_centros_medicos']);
Route::post('/updatecentrosmedicos/{id}', [App\Http\Controllers\CentrosMedicosController::class, 'update'])->name('updatecentrosmedicos');
//Rutas de Especialidades
Route::resource('especialidades', 'EspecialidadesController');
Route::get('/obtener_especialidades', [App\Http\Controllers\EspecialidadesController::class, 'obtener_especialidades']);
Route::post('/updateespecialidades/{id}', [App\Http\Controllers\EspecialidadesController::class, 'update'])->name('updateespecialidades');
Route::get('/especialidades_med_prod', [App\Http\Controllers\EspecialidadesController::class, 'obtener_especialidades_med_prod'])->name('especialidades_med_prod');

//Rutas de Horas
Route::resource('horas', 'HorasController');
Route::get('/obtener_horas', [App\Http\Controllers\HorasController::class, 'obtener_horas']);
Route::post('/updatehoras/{id}', [App\Http\Controllers\HorasController::class, 'update'])->name('updatehoras');
//Rutas de Horarios
Route::resource('horarios', 'HorariosController');
Route::get('/obtener_horario', [App\Http\Controllers\HorariosController::class, 'obtener_horario']);
Route::get('/buscar_horario/{busqueda}', [App\Http\Controllers\HorariosController::class, 'buscar_horario']);
Route::post('/updatehorario/{id}', [App\Http\Controllers\HorariosController::class, 'update'])->name('updatehorario');
Route::get('/habilitar_horarios/{id}', [App\Http\Controllers\HorariosController::class, 'habilitar_horarios'])->name('habilitar_horarios');
//Rutas de Medicos
Route::resource('medicos', 'MedicosController');
Route::get('/obtener_medicos', [App\Http\Controllers\MedicosController::class, 'obtener_medicos']);
Route::post('/updatemedicos/{id}', [App\Http\Controllers\MedicosController::class, 'update'])->name('updatemedicos');
//Rutas de Medicos Produccion
Route::resource('medicos_produccion', 'MedicoProduccionController');
Route::get('/obtener_medicos_prod', [App\Http\Controllers\MedicoProduccionController::class, 'obtener_medicos_prod']);
Route::post('/updatemedicos_prod/{id}', [App\Http\Controllers\MedicoProduccionController::class, 'update'])->name('updatemedicos_prod');

//Rutas de DetalleCentro Medico
Route::resource('detalle_centro_medico', 'DetalleCentroMedicoController');
Route::get('/obtener_detalle_centro_medicos', [App\Http\Controllers\DetalleCentroMedicoController::class, 'obtener_detalle_centro_medicos']);
Route::post('/update_detalle_centro_medicos/{id}', [App\Http\Controllers\DetalleCentroMedicoController::class, 'update'])->name('update_detalle_centro_medicos');

//Rutas de Registro
Route::resource('usuario', 'UsuarioController');
Route::post('/verificar_registro', [App\Http\Controllers\UsuarioController::class, 'validar_datos']);
Route::get('/obtener_usuario', [App\Http\Controllers\UsuarioController::class, 'obtener_usuario']);
Route::get('/buscar_usuario/{busqueda}', [App\Http\Controllers\UsuarioController::class, 'buscar_usuario']);
Route::post('/update_usuario', [App\Http\Controllers\UsuarioController::class, 'update_perfil'])->name('update_usuario');
//Rutas de Citas
Route::resource('citas', 'CitasController');
Route::get('/obtener_citas', [App\Http\Controllers\CitasController::class, 'obtener_citas']);
//Ruta de Gestion de Pago
Route::get('/obetener_token_pago', [App\Http\Controllers\GestionPagoController::class, 'index']);
Route::get('/obtener_tarjeta/{identificacion}', [App\Http\Controllers\GestionPagoController::class, 'obtener_tarjeta']);
Route::post('/refund', [App\Http\Controllers\GestionPagoController::class, 'reembolso']);

//Rutas de EmailCitas
Route::post('/email_cita', [App\Http\Controllers\CitasController::class, 'email_cita'])->name('email_cita');
//Rutas de EmailComprobante
Route::post('/email_comprobante', [App\Http\Controllers\CitasController::class, 'email_comprobante'])->name('email_comprobante');
//Rutas de Historial
Route::get('/historial/{id}', [App\Http\Controllers\CitasController::class, 'historial'])->name('historial');
//Rutas de Calificacion
Route::post('/calificacion_app', [App\Http\Controllers\CalificacionAppController::class, 'store'])->name('calificacion_app');
Route::resource('calificacion', 'CalificacionAppController');
//Actualizar Contrasena
Route::post('/cambiar_contrasena/{id}', [App\Http\Controllers\AuthController::class, 'cambiarContrasena'])->name('cambiarContrasena');
//Carga Masiva
Route::post('/carga_masiva', [App\Http\Controllers\HorariosController::class, 'carga_masiva'])->name('carga_masiva');
//Rutas de Usuarios
Route::resource('usuarios', 'UsuarioController');
Route::get('/obtener_usuario', [App\Http\Controllers\UsuarioController::class, 'obtener_usuario']);

