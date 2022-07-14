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

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/consultas/{id?}', 'App\Http\Controllers\ConsultasController@index')->name('consultas');

Route::post('/adicionar/entrada/{id?}', 'App\Http\Controllers\ConsultasController@adicionarEntrada')->name('adicionar.entrada');

Route::post('/adicionar/saida/{id?}', 'App\Http\Controllers\ConsultasController@adicionarSaida')->name('adicionar.saida');

Route::post('/adicionar/agendamento', 'App\Http\Controllers\DashboardController@adicionarAgendamento')->name('adicionar.agendamento');

Route::post('/adicionar/meta', 'App\Http\Controllers\DashboardController@adicionarMeta')->name('adicionar.meta');

Route::post('/excluir/saida', 'App\Http\Controllers\ConsultasController@excluirSaida')->name('excluir.saida');

Route::post('/excluir/entrada', 'App\Http\Controllers\ConsultasController@excluirEntrada')->name('excluir.entrada');

Route::post('/excluir/agendamento', 'App\Http\Controllers\DashboardController@excluirAgendamento')->name('excluir.agendamento');

Route::post('/filtrar/entrada', 'App\Http\Controllers\ConsultasController@filtrarEntrada')->name('filtrar.entrada');

Route::post('/filtrar/saida', 'App\Http\Controllers\ConsultasController@filtrarSaida')->name('filtrar.saida');

Route::get('/filtrar/entrada', 'App\Http\Controllers\ConsultasController@index');

Route::get('/filtrar/saida', 'App\Http\Controllers\ConsultasController@index');

/*function () {
    return Inertia::render('Consultas');
}*/

require __DIR__ . '/auth.php';
