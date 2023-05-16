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

    // RUTAS CLIENTE

    Route::resource('/mascotas', MascotaController::class)->except([
        'create', 'edit'
    ]);

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