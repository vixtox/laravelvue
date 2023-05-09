<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\MunicipioController;

// RUTAS PAGINA OFICIAL DVAPP
Route::get('/', function () {return view('home');})->name('home');
Route::get('/sobrenosotros', function () {return view('sobrenosotros');})->name('sobrenosotros');
Route::get('/servicios', function () {return view('servicios');})->name('servicios');
Route::get('/contacto', function () {return view('contacto');})->name('contacto');
Route::get('/precios', function () {return view('precios');})->name('precios');
Route::get('/testimonios', function () {return view('testimonios');})->name('testimonios');

// RUTAS REGISTRAR USUARIOS DVAPP
Route::get('/register', [RegisterController::class, 'create'])->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// RUTAS LOGIN Y LOGOUT
Route::get('/login', [SessionsController::class, 'create'])
    ->name('login.index');
Route::post('/login', [SessionsController::class, 'store'])
    ->name('login.store');
Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout');

// RUTA CONTROLADOR FRONTAL
Route::get('/index', function () {return view('auth.index');})->name('index');

// RUTAS CLIENTE
Route::resource('/clientes', ClienteController::class);
Route::get('/clientes/{id}', [ClienteController::class, 'obtenerInformacionID']);
Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');

// RUTA PROVINCIA
Route::get('/provincias', [ProvinciaController::class, 'index']);
// RUTA MUNICIPIO
Route::get('/municipios/{id}', [MunicipioController::class, 'show']);
