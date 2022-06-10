<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Entrada;
use App\Models\Saida;
use App\Models\Categoria;

class ConsultasController extends Controller
{
    public function index($id)
    {
        $entradas = Entrada::all()->where('id_usuario', '=', $id);
        if ($entradas == null) $entradas = 0;

        $saidas = Saida::all()->where('id_usuario', '=', $id);
        if ($saidas == null) $saidas = 0;

        $categorias = Categoria::where('id_usuario', null)->orWhere('id_usuario', '=', $id)->get();
        return Inertia::render('Consultas', ['entradas' => $entradas, 'saidas' => $saidas, 'categorias' => $categorias]);
    }

    public function adicionarEntrada(Request $req)
    {
        $entrada = new Entrada();
        $entrada->nome = $req->nome;
        $entrada->valor = $req->valor;
        $entrada->descricao = $req->descricao;
        $entrada->id_usuario = $req->id_usuario;
        $entrada->id_categoria = $req->id_categoria;
        $entrada->data = date("Y-m-d");
        dd($entrada);
    }
}
