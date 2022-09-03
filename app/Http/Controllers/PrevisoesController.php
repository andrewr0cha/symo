<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Entrada;
use App\Models\Saida;

class PrevisoesController extends Controller
{
    public function index()
    {
        $dados=$this->calcularDados();
        return Inertia::render('Previsoes');
    }

    private function calcularDados(){return "";}
}
