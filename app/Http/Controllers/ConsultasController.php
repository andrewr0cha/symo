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
        $entradas = Entrada::where('id_usuario', '=', $id)->orderBy('data', 'desc')->get();
        if ($entradas == null) $entradas = 0;
        $saidas = Saida::where('id_usuario', '=', $id)->orderBy('data', 'desc')->get();
        if ($saidas == null) $saidas = 0;
        $categoriasEntrada = Categoria::where('id_tipo',1)->where('id_usuario', null)->orWhere('id_usuario', '=', $id)->get()->pluck('nome');
        $categoriasEntrada=$categoriasEntrada->toArray();
        $categoriasSaida = Categoria::where('id_tipo',2)->where('id_usuario', null)->orWhere('id_usuario', '=', $id)->get()->pluck('nome');
        $categoriasSaida=$categoriasSaida->toArray();
        return Inertia::render('Consultas', ['entradas' => $entradas, 'saidas' => $saidas, 'categoriasEntrada' => $categoriasEntrada,'categoriasSaida' => $categoriasSaida, 'id' => $id]);
    }

    public function adicionarEntrada(Request $req, $id)
    {
        $req->validate([
            'nome' => 'required|string|max:255',
            'valor' => 'required',
            'id_categoria' => 'required',
        ]);
        $entrada = new Entrada();
        $entrada->nome = $req->nome;
        $entrada->valor = $req->valor;
        $entrada->descricao = $req->descricao;
        $entrada->id_usuario = $id;
        $categoria=Categoria::where('nome', 'like', $req->id_categoria)->where('id_usuario','=',$id)->orWhere('id_usuario',null)->first();
        $entrada->id_categoria = $categoria->id;
        $entrada->data = date("Y-m-d H:i:s");
        $entrada->save();
        return redirect()->route('consultas', $id);
    }

    public function adicionarSaida(Request $req, $id)
    {
        $req->validate([
            'nome' => 'required|string|max:255',
            'valor' => 'required',
            'id_categoria' => 'required',
        ]);
        $entrada = new Saida();
        $entrada->nome = $req->nome;
        $entrada->valor = $req->valor;
        $entrada->descricao = $req->descricao;
        $entrada->id_usuario = $id;
        $categoria=Categoria::where('nome', 'like', $req->id_categoria)->where('id_usuario','=',$id)->orWhere('id_usuario',null)->first();
        $entrada->id_categoria = $categoria->id;
        $entrada->data = date("Y-m-d H:i:s");
        $entrada->save();
        return redirect()->route('consultas', $id);
    }
}


