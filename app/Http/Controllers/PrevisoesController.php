<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use App\Models\Entrada;
use App\Models\Saida;

class PrevisoesController extends Controller
{
    public function index()
    {
        $dados = $this->calcularDados();
        return Inertia::render('Previsoes', ['dados' => $dados]);
    }

    private function calcularDados()
    {
        $data = Carbon::now();
        $hoje = $data->format('Y-m-d');
        $amanha = $data->add(1, 'day')->format('Y-m-d');
        $semana = $data->subWeek()->format('Y-m-d');
        $mes = $data->subMonth()->format('Y-m-d');
        $ano = $data->subYear()->format('Y-m-d');
        $diarioEntrada = Entrada::where('data', '>', $hoje)->where('data', '<', $amanha)->where('id_usuario', auth()->user()->id)->sum('valor');
        $diarioSaida = Saida::where('data', '>', $hoje)->where('data', '<', $amanha)->where('id_usuario', auth()->user()->id)->sum('valor');
        $semanalEntrada = Entrada::where('data', '>', $semana)->where('data', '<', $amanha)->where('id_usuario', auth()->user()->id)->sum('valor');
        $semanalSaida = Saida::where('data', '>', $semana)->where('data', '<', $amanha)->where('id_usuario', auth()->user()->id)->sum('valor');
        $mensalEntrada = Entrada::where('data', '>', $mes)->where('data', '<', $amanha)->where('id_usuario', auth()->user()->id)->sum('valor');
        $mensalSaida = Saida::where('data', '>', $mes)->where('data', '<', $amanha)->where('id_usuario', auth()->user()->id)->sum('valor');
        $anualEntrada = Entrada::where('data', '>', $ano)->where('data', '<', $amanha)->where('id_usuario', auth()->user()->id)->sum('valor');
        $anualSaida = Saida::where('data', '>', $ano)->where('data', '<', $amanha)->where('id_usuario', auth()->user()->id)->sum('valor');
        $dados = [
            $entrada = [$diarioEntrada, $semanalEntrada, $mensalEntrada, $anualEntrada],
            $saida = [$diarioSaida, $semanalSaida, $mensalSaida, $anualSaida]
        ];
        return $dados;
    }
}
