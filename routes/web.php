<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\RazaController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\HemogramaController;
use App\Http\Controllers\BioquimicaController;

// RUTAS PAGINA OFICIAL DVAPP
Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/sobrenosotros', function () {
    return view('sobrenosotros');
})->name('sobrenosotros');
Route::get('/servicios', function () {
    return view('servicios');
})->name('servicios');
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');
Route::get('/precios', function () {
    return view('precios');
})->name('precios');
Route::get('/testimonios', function () {
    return view('testimonios');
})->name('testimonios');

// RUTAS LOGIN Y LOGOUT
Route::get('/login', [SessionsController::class, 'create'])
    ->name('login.index');
Route::post('/login', [SessionsController::class, 'store'])
    ->name('login.store');
Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout');

// RUTAS USUARIOS LOGUEADOS
Route::middleware(['user'])->group(function () {
    // RUTA PANTALLA INICIO
    Route::get('/index', function () {
        return view('auth.index');
    })->name('index');
    // RUTAS CLIENTE
    Route::get('/clientes/buscar', [ClienteController::class, 'buscarClientes']);
    Route::resource('/clientes', ClienteController::class)->except([
        'create', 'edit'
    ]);
    // RUTAS MASCOTA
    Route::get('/mascotas/buscar', [MascotaController::class, 'buscarMascotas']);
    Route::resource('/mascotas', MascotaController::class)->except([
        'create', 'edit'
    ]);
    //RUTAS VISITA
    Route::get('/visitas/generate-pdf/{id}', [VisitaController::class, 'generatePDF']);
    Route::get('/visitas/hemograma/{id}', [VisitaController::class, 'inicioHemograma']);
    Route::get('/visitas/bioquimica/{id}', [VisitaController::class, 'inicioBioquimica']);
    Route::get('/visitas/listavisitas/{mascotas_id}', [VisitaController::class, 'mostrarVisitasMascota']);
    Route::resource('/visitas', VisitaController::class)->except(['create', 'edit']);
    Route::post('/enviarcorreo/{id}', [VisitaController::class, 'enviarCorreo'])->name('enviarCorreo');
    //RUTAS HEMOGRAMA
    Route::get('/hemogramas/generate-pdf/{id}', [HemogramaController::class, 'generatePDF']);
    Route::resource('/hemogramas', HemogramaController::class)->except(['create', 'edit']);
    //RUTAS BIOQUÍMICA
    Route::get('/bioquimicas/generate-pdf/{id}', [BioquimicaController::class, 'generatePDF']);
    Route::resource('/bioquimicas', BioquimicaController::class)->except(['create', 'edit']);

    // RUTAS VETERINARIO
    Route::get('/empleados/listar_veterinarios', [EmpleadoController::class, 'listar_veterinarios']);
    // RUTA PROVINCIA
    Route::get('/provincias', [ProvinciaController::class, 'index']);
    // RUTA MUNICIPIO
    Route::get('/municipios/{id}', [MunicipioController::class, 'show']);
    // RUTA RAZAS
    Route::get('/razas/{id}', [RazaController::class, 'show']);
});

// RUTAS RESERVADAS ROL ADMIN
Route::middleware(['admin'])->group(function () {

    // RUTAS EMPLEADO
    Route::get('/empleados/buscar', [EmpleadoController::class, 'buscarEmpleados']);
    Route::resource('/empleados', EmpleadoController::class)->except([
        'create', 'edit'
    ]);
});

// RUTAS REGISTRO USER
Route::get('/register', [RegisterController::class, 'create'])->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
