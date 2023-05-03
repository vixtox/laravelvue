<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\ClienteController;

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

Route::get('/register', [RegisterController::class, 'create'])
    ->name('register.index');

Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');

Route::get('/login', [SessionsController::class, 'create'])
    ->name('login.index');

Route::post('/login', [SessionsController::class, 'store'])
    ->name('login.store');

Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout');

Route::get('/index', function () {
    return view('auth.index');
})->name('index');

Route::resource('/clientes', ClienteController::class);
