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

Route::get('/grupo', function () {
    return Inertia::render('Grupo');
})->name('grupo');

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/consultas/{id?}', 'App\Http\Controllers\ConsultasController@index')->middleware(['auth', 'verified'])->name('consultas');

Route::get('/fluxo', 'App\Http\Controllers\FluxoController@index')->middleware(['auth', 'verified'])->name('fluxo');

Route::get('/simulacao', 'App\Http\Controllers\SimulacaoController@index')->middleware(['auth', 'verified'])->name('simulacao');

Route::post('/simulacao/excluir', 'App\Http\Controllers\SimulacaoController@excluir')->middleware(['auth', 'verified'])->name('excluir.simulacao');

Route::post('/simulacao/salvar', 'App\Http\Controllers\SimulacaoController@salvar')->middleware(['auth', 'verified'])->name('salvar.simulacao');

Route::get('/agendamentos', 'App\Http\Controllers\AgendamentosController@index')->middleware(['auth', 'verified'])->name('agendamentos');

Route::get('/metas', 'App\Http\Controllers\MetasController@index')->middleware(['auth', 'verified'])->name('metas');

Route::post('/adicionar/entrada/{id?}', 'App\Http\Controllers\ConsultasController@adicionarEntrada')->middleware(['auth', 'verified'])->name('adicionar.entrada');

Route::post('/adicionar/saida/{id?}', 'App\Http\Controllers\ConsultasController@adicionarSaida')->middleware(['auth', 'verified'])->name('adicionar.saida');

Route::post('/adicionar/cofre', 'App\Http\Controllers\ConsultasController@adicionarCofre')->middleware(['auth', 'verified'])->name('guardar');

Route::post('/remover/cofre', 'App\Http\Controllers\ConsultasController@removerCofre')->middleware(['auth', 'verified'])->name('remover');

Route::post('/adicionar/agendamento/{id?}', 'App\Http\Controllers\DashboardController@adicionarAgendamento')->middleware(['auth', 'verified'])->name('adicionar.agendamento');

Route::post('mobile/adicionar/agendamento/{id?}', 'App\Http\Controllers\AgendamentosController@adicionarAgendamento')->middleware(['auth', 'verified'])->name('agendamento.adicionar.agendamento');

Route::post('/adicionar/meta', 'App\Http\Controllers\DashboardController@adicionarMeta')->middleware(['auth', 'verified'])->name('adicionar.meta');

Route::post('/guardar/meta', 'App\Http\Controllers\DashboardController@guardarMeta')->middleware(['auth', 'verified'])->name('guardar.meta');

Route::post('/retirar/meta', 'App\Http\Controllers\DashboardController@retirarMeta')->middleware(['auth', 'verified'])->name('retirar.meta');

Route::post('mobile/adicionar/meta', 'App\Http\Controllers\MetasController@adicionarMeta')->middleware(['auth', 'verified'])->name('meta.adicionar.meta');

Route::post('/excluir/saida', 'App\Http\Controllers\ConsultasController@excluirSaida')->middleware(['auth', 'verified'])->name('excluir.saida');

Route::post('/excluir/entrada', 'App\Http\Controllers\ConsultasController@excluirEntrada')->middleware(['auth', 'verified'])->name('excluir.entrada');

Route::post('/excluir/agendamento', 'App\Http\Controllers\DashboardController@excluirAgendamento')->middleware(['auth', 'verified'])->name('excluir.agendamento');

Route::post('mobile/excluir/agendamento', 'App\Http\Controllers\AgendamentosController@excluirAgendamento')->middleware(['auth', 'verified'])->name('agendamento.excluir.agendamento');

Route::post('/excluir/meta', 'App\Http\Controllers\DashboardController@excluirMeta')->middleware(['auth', 'verified'])->name('excluir.meta');

Route::post('mobile/excluir/meta', 'App\Http\Controllers\MetasController@excluirMeta')->middleware(['auth', 'verified'])->name('meta.excluir.meta');

Route::post('/meta/concluir', 'App\Http\Controllers\DashboardController@concluirMeta')->middleware(['auth', 'verified'])->name('concluir.meta');

Route::post('mobile/meta/concluir', 'App\Http\Controllers\MetasController@concluirMeta')->middleware(['auth', 'verified'])->name('meta.concluir.meta');

Route::post('/filtrar/entrada', 'App\Http\Controllers\ConsultasController@filtrarEntrada')->middleware(['auth', 'verified'])->name('filtrar.entrada');

Route::post('/filtrar/saida', 'App\Http\Controllers\ConsultasController@filtrarSaida')->middleware(['auth', 'verified'])->name('filtrar.saida');

Route::get('/filtrar/entrada', 'App\Http\Controllers\ConsultasController@index');

Route::get('/filtrar/saida', 'App\Http\Controllers\ConsultasController@index');

Route::get('/editar/usuario', 'App\Http\Controllers\EditarController@usuario')->middleware(['auth', 'verified'])->name('usuario');;

Route::post('/alterar/usuario', 'App\Http\Controllers\EditarController@alterarUsuario')->middleware(['auth', 'verified'])->name('alterar.usuario');;

/*function () {
    return Inertia::render('Consultas');
}*/

require __DIR__ . '/auth.php';
