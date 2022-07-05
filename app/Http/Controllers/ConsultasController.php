<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\User;
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
        /*$categoriasEntrada = Categoria::where('id_tipo',2)->get()->pluck('nome');
        $categoriasEntrada=$categoriasEntrada->toArray();*/
        $categoriasSaida = Categoria::where('id_tipo',1)->get()->pluck('nome');
        $categoriasSaida=$categoriasSaida->toArray();
        $porcentagens=$this->somarCategorias();
        return Inertia::render('Consultas', ['entradas' => $entradas, 'saidas' => $saidas, 'porcentagens' => $porcentagens,'categoriasSaida' => $categoriasSaida, 'id' => $id]);
    }

    public function adicionarEntrada(Request $req, $id)
    {
        $req->validate([
            'nome' => 'required|string|max:255',
            'valor' => 'required',
        ]);
        $entrada = new Entrada();
        $entrada->nome = $req->nome;
        $entrada->valor = $req->valor;
        $entrada->descricao = $req->descricao;
        $entrada->id_usuario = $id;
        $entrada->data = date("Y-m-d H:i:s");
        $entrada->save();
        $user=User::where('id',$id)->first();
        $user->saldo=$user->saldo+$entrada->valor;
        $user->save();
        return redirect()->route('consultas', $id);
    }

    public function adicionarSaida(Request $req, $id)
    {
        $req->validate([
            'nome' => 'required|string|max:255',
            'valor' => 'required',
            'id_categoria' => 'required',
        ]);
        $saida = new Saida();
        $saida->nome = $req->nome;
        $saida->valor = $req->valor;
        $saida->descricao = $req->descricao;
        $saida->id_usuario = $id;
        $categoria=Categoria::where('nome', 'like', $req->id_categoria)->first();
        $saida->id_categoria = $categoria->id;
        $saida->data = date("Y-m-d H:i:s");
        $saida->save();
        $user=User::where('id',$id)->first();
        $user->saldo=$user->saldo-$saida->valor;
        $user->save();
        return redirect()->route('consultas', $id);
    }

    public function excluirSaida(Request $req){
        $id_usuario = auth()->user()->id;
        $user=User::where('id',$id_usuario)->first();
        foreach($req->listaExclusao as $id){
            $saida=Saida::where('id', $id)->first(); //sempre finalizar com first, get ou paginate porque senão nçao traz
            $user->saldo=$user->saldo+$saida->valor;
            $user->save();
            $saida->delete();
        }
        return redirect()->route('consultas', $id_usuario);
    }

    public function excluirEntrada(Request $req){
        
        $id_usuario = auth()->user()->id;
        $user=User::where('id',$id_usuario)->first();
        foreach($req->listaExclusao as $id){
            $entrada=Entrada::where('id', $id)->first(); //sempre finalizar com first, get ou paginate porque senão nçao traz
            $user->saldo=$user->saldo-$entrada->valor;
            $user->save();
            $entrada->delete();
        }
        return redirect()->route('consultas', $id_usuario);
    }

    private function somarCategorias(){
        $ano=date("Y");
        $mes=date("m");
        $data = Carbon::parse($ano."-".$mes."-01");
        $primeiro=$data->startOfMonth()->format('Y-m-d');
        $ultimo=$data->endOfMonth()->format('Y-m-d');
        $total=Entrada::whereBetween('created_at', [$primeiro, $ultimo])->sum('valor');
        if($total==0) $total=1;
        $essencial=Saida::whereBetween('created_at', [$primeiro, $ultimo])->where('id_categoria',1)->sum('valor');
        $objetivos=Saida::whereBetween('created_at', [$primeiro, $ultimo])->where('id_categoria',2)->sum('valor');
        $aposentadoria=Saida::whereBetween('created_at', [$primeiro, $ultimo])->where('id_categoria',3)->sum('valor');
        $educacao=Saida::whereBetween('created_at', [$primeiro, $ultimo])->where('id_categoria',4)->sum('valor');
        $gosto=Saida::whereBetween('created_at', [$primeiro, $ultimo])->where('id_categoria',5)->sum('valor');
        $porcentagens=
            [($essencial/$total)*100,
            ($objetivos/$total)*100,
            ($aposentadoria/$total)*100,
            ($educacao/$total)*100,
            ($gosto/$total)*100];
        return $porcentagens;
    }
}


