<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/layout', function () {
    return Inertia::render('LayoutSideBar');
})->name('layout');

Route::get('/consultas/{id}', 'App\Http\Controllers\ConsultasController@index')->name('consultas');

Route::post('/adicionar', 'App\Http\Controllers\ConsultasController@adicionarEntrada')->name('adicionar.entrada');

/*function () {
    return Inertia::render('Consultas');
}*/

require __DIR__ . '/auth.php';
