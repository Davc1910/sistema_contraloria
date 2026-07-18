<?php

use App\Http\Controllers\BancoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\OficinaController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\MobiliarioController;
use App\Http\Controllers\TipoPerifericoController;
use App\Http\Controllers\PerifericoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\TipoSolicitudController;
use App\Http\Controllers\ReporteController;



Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Route::get('/reset-password/{token}/{email}', function ($token, $email) {
//     return view('reset-password-confirm', ['token' => $token, 'email' => $email]);
// })->name('password.reset');

Route::post('/reset-password', [PasswordResetController::class, 'sendEmail'])->name('password.email');

Route::post('/reset-password/{token}', [PasswordResetController::class, 'reset'])->name('password.update');

/* Ruta Registro del Usuario */
Route::get('/register', [RegisterController::class, 'show']);
Route::post('/register', [RegisterController::class, 'register']);

/*creamos un grupo de rutas protegidas para los controlador de roles */

Route::resource('roles', RolController::class)->middleware('auth');
Route::resource('usuarios', UsuarioController::class)->middleware('auth');
Route::get('/verificar-cedula', [ UsuarioController::class,'verificarCedula'])->middleware('auth');

/* Ruta Login o Inicio de Sesión */
Route::get('/login', [LoginController::class, 'show']);
Route::post('/login', [LoginController::class, 'login']);

/* Ruta Home o Vista Principal(Inicio) */
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
Route::get('/vocero', [HomeController::class, 'showVoceros'])->name('vocero.index');

/* Ruta Logout o Cierre de Sesión */
Route::get('/logout', [logoutController::class, 'logout']);

/* Ruta Perfil Usuario */
Route::get('/Perfil',  [UserSettingsController::class,'Perfil'])->name('Perfil')->middleware('auth');
Route::post('/change/password',  [UserSettingsController::class,'changePassword'])->name('changePassword');

/* Ruta Oficina */
Route::get('/oficina',  [OficinaController::class,'index'])->name('oficina')->middleware('auth');
Route::get('/oficina/create', [OficinaController::class, 'create'])->name('oficina.create')->middleware('auth');
Route::get('/oficina/pdf', [OficinaController::class,'pdf'])->name('oficina.pdf')->middleware('auth');
Route::resource('oficina', OficinaController::class)->middleware('auth');

/* Ruta Persona */
Route::get('/persona',  [PersonaController::class,'index'])->name('persona')->middleware('auth');
Route::get('/persona/create', [PersonaController::class, 'create'])->name('persona.create')->middleware('auth');
Route::get('/persona/pdf',  [PersonaController::class,'pdf'])->name('persona.pdf')->middleware('auth');
Route::resource('persona', PersonaController::class)->middleware('auth');

/* Ruta Marca */
Route::get('/marca',  [MarcaController::class,'index'])->name('marca')->middleware('auth');
Route::get('/marca/create', [MarcaController::class, 'create'])->name('marca.create')->middleware('auth');
Route::get('/marca/pdf',  [MarcaController::class,'pdf'])->name('marca.pdf')->middleware('auth');
Route::resource('marca', MarcaController::class)->middleware('auth');

/* Ruta Modelo */
Route::get('/modelo',  [ModeloController::class,'index'])->name('modelo')->middleware('auth');
Route::get('/modelo/create', [ModeloController::class, 'create'])->name('modelo.create')->middleware('auth');
Route::get('/modelo/pdf',  [ModeloController::class,'pdf'])->name('modelo.pdf')->middleware('auth');
Route::resource('modelo', ModeloController::class)->middleware('auth');

/* Ruta Articulo*/
Route::get('/articulo',  [ArticuloController::class,'index'])->name('articulo')->middleware('auth');
Route::get('/articulo/create', [ArticuloController::class, 'create'])->name('articulo.create')->middleware('auth');
Route::get('/articulo/pdf',  [ArticuloController::class,'pdf'])->name('articulo.pdf')->middleware('auth');
Route::resource('articulo', ArticuloController::class)->middleware('auth');

/* Ruta Mobiliario */
Route::get('/mobiliario',  [MobiliarioController::class,'index'])->name('mobiliario')->middleware('auth');
Route::get('/mobiliario/create', [MobiliarioController::class, 'create'])->name('mobiliario.create')->middleware('auth');
Route::get('/mobiliario/pdf',  [MobiliarioController::class,'pdf'])->name('mobiliario.pdf')->middleware('auth');
Route::resource('mobiliario', MobiliarioController::class)->middleware('auth');

/* Ruta Tipo de Periférico */
Route::get('/tipo_periferico',  [TipoPerifericoController::class,'index'])->name('tipo_periferico')->middleware('auth');
Route::get('/tipo_periferico/create', [TipoPerifericoController::class, 'create'])->name('tipo_periferico.create')->middleware('auth');
Route::get('/tipo_periferico/pdf',  [TipoPerifericoController::class,'pdf'])->name('tipo_periferico.pdf')->middleware('auth');
Route::resource('tipo_periferico', TipoPerifericoController::class)->middleware('auth');

/* Ruta Periférico */
Route::get('/periferico',  [PerifericoController::class,'index'])->name('periferico')->middleware('auth');
Route::get('/periferico/create', [PerifericoController::class, 'create'])->name('periferico.create')->middleware('auth');
Route::get('/periferico/pdf',  [PerifericoController::class,'pdf'])->name('periferico.pdf')->middleware('auth');
Route::resource('periferico', PerifericoController::class)->middleware('auth');

/* Ruta Equipo*/
Route::get('/equipo',  [EquipoController::class,'index'])->name('equipo')->middleware('auth');
Route::get('/equipo/create', [EquipoController::class, 'create'])->name('equipo.create')->middleware('auth');
Route::get('/equipo/pdf',  [EquipoController::class,'pdf'])->name('equipo.pdf')->middleware('auth');
Route::resource('equipo', EquipoController::class)->middleware('auth');

/* Ruta Solicitud */
Route::get('/solicitud/create', [SolicitudController::class, 'create'])->name('solicitud.create')->middleware('auth');
Route::get('/solicitud/pdf',  [SolicitudController::class,'pdf'])->name('solicitud.pdf')->middleware('auth');
Route::resource('solicitud', SolicitudController::class)->middleware('auth');

/* Ruta Tipo de Solicitud */
Route::get('/incorporar', [Controller::class, 'index'])->name('incorporar')->middleware('auth');
Route::get('/incorporar/create', [IncorporarController::class, 'create'])->name('incorporar.create')->middleware('auth');
Route::resource('incorporar', IncorporarController::class)->middleware('auth');

// /* Ruta Estadistica*/
// Route::get('estadistica', [EstadisticaController::class, 'index'])->name('estadistica')->middleware('auth');

/* Ruta Bitacora*/
Route::get('bitacora', [ReporteController::class, 'bitacora'])->name('bitacora')->middleware('auth');

/* Ruta Reporte*/
// Route::get('reporte', [ReporteController::class, 'index'])->name('index')->middleware('auth');
// Route::get('/reporte/pdf',  [ReporteController::class,'generarPDF'])->name('reporte')->middleware('auth');

/* Ruta Reporte*/
// Route::get('especifico', [EspecificosController ::class, 'index'])->name('index')->middleware('auth');
// Route::get('/especifico/pdf',  [EspecificosController ::class,'generarPDF'])->name('especifico')->middleware('auth');

/* Ruta Manual */
// Route::get('/manual',  [ManualController::class,'index'])->name('manual')->middleware('auth');
