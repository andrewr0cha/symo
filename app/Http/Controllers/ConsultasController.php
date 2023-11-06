<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Entrada;
use App\Models\Saida;
use App\Models\Meta;
use App\Models\Categoria;

class ConsultasController extends Controller
{
    public function index($id = null)
    {
        $user = User::find(auth()->user()->id);
        $entradas = $user->entrada()->orderBy('data', 'desc')->get();
        if ($entradas == null) $entradas = 0;
        $saidas = $user->saida()->orderBy('data', 'desc')->get();
        if ($saidas == null) $saidas = 0;
        $categoriasSaida = ['Essencial','Aposentadoria','Educação','Lazer'];
        $porcentagens = $this->somarCategorias($user);
        $porcentagensGerais = $this->somarCategoriasGerais();
        $gastosMensais = $this->somarGastos($user);
        $metasConcluidas = $user->meta()->where('status', 'like', 'Concluída')->get();
        $metasConcluidas = $metasConcluidas == null ? $metasConcluidas = 0 : $metasConcluidas->count();
        $metas = $user->meta()->get();
        $metas = $metas == null ? $metas = 0 : $metas->count();

        return Inertia::render('Consultas', ['entradas' => $entradas, 'saidas' => $saidas, 'porcentagens' => $porcentagens, 'porcentagensGerais' => $porcentagensGerais, 'categoriasSaida' => $categoriasSaida, 'id' => $id, 'gastosMensais' => $gastosMensais, 'metasConcluidas' => $metasConcluidas, 'metas' => $metas]);
    }

    public function adicionarEntrada(Request $req, $id = null)
    {
        if ($id == null) $id = auth()->user()->id;
        $req->validate([
            'nome' => 'required|string|max:255',
            'valor' => 'required',
        ]);
        $entrada = new Entrada();
        $entrada->nome = $req->nome;
        $entrada->valor = $req->valor;
        $entrada->descricao = $req->descricao;
        $entrada->user_id = $id;
        $entrada->data = $req->dataES;
        $entrada->save();
        $user = User::where('id', $id)->first();
        $user->saldo = $user->saldo + $entrada->valor;
        $user->save();
        return redirect()->route('consultas', $id);
    }

    public function adicionarSaida(Request $req, $id = null)
    {
        if ($id == null) $id = auth()->user()->id;
        $req->validate([
            'nome' => 'required|string|max:255',
            'valor' => 'required',
            'id_categoria' => 'required',
        ]);
        $saida = new Saida();
        $saida->nome = $req->nome;
        $saida->valor = $req->valor;
        $saida->descricao = $req->descricao;
        $saida->user_id = $id;
        switch($req->id_categoria){
            case 'Essencial':
                $saida->categorias_id=1;
                break;
            case 'Aposentadoria':
                $saida->categorias_id=2;
                break;
            case 'Educação':
                $saida->categorias_id=3;
                break;
            case 'Lazer':
                $saida->categorias_id=4;
                break;
            case 'Objetivos':
                $saida->categorias_id=5; 
                break;
        }
        $saida->data = $req->dataES;
        $saida->save();
        $user = User::find($id);
        $user->saldo = $user->saldo - $saida->valor;
        $user->save();
        return redirect()->route('consultas', $id);
    }



    public function adicionarCofre(Request $req)
    {
        $id = auth()->user()->id;
        $req->validate([
            'valor' => 'required',
        ]);
        $user = User::find($id);
        $user->cofre = $user->cofre + $req->valor;
        $user->saldo = $user->saldo - $req->valor;
        $user->save();
        $saida = new Saida();
        $saida->nome = 'Dinheiro Guardado';
        $saida->id_categoria = 5;
        $saida->valor = $req->valor;
        $saida->descricao = 'Posto no Cofre';
        $saida->data = date("Y-m-d H:i:s");
        $saida->user_id = $id;
        $saida->cofre = true;
        $saida->save();
        return redirect()->route('consultas', $id);
    }

    public function removerCofre(Request $req)
    {
        $id = auth()->user()->id;
        $req->validate([
            'valor' => 'required',
        ]);
        $user = User::find($id);
        $user->cofre = $user->cofre - $req->valor;
        $user->saldo = $user->saldo + $req->valor;
        $user->save();
        $entrada = new Entrada();
        $entrada->nome = 'Dinheiro Resgatado';
        $entrada->valor = $req->valor;
        $entrada->descricao = 'Resgate do Cofre';
        $entrada->data = date("Y-m-d H:i:s");
        $entrada->user_id = $id;
        $entrada->cofre = true;
        $entrada->save();
        return redirect()->route('consultas', $id);
    }

    public function excluirSaida(Request $req)
    {
        $id_usuario = auth()->user()->id;
        $user = User::find($id_usuario);
        foreach ($req->listaExclusao as $id) {
            $saida = Saida::find($id); //sempre finalizar com first, get ou paginate porque senão nçao traz
            $user->saldo = $user->saldo + $saida->valor;
            $user->save();
            $saida->delete();
        }
        return redirect()->route('consultas', $id_usuario);
    }

    public function excluirEntrada(Request $req)
    {
        $id_usuario = auth()->user()->id;
        $user = User::find($id_usuario);
        foreach ($req->listaExclusao as $id) {
            $entrada = Entrada::find($id); //sempre finalizar com first, get ou paginate porque senão nçao traz
            $user->saldo = $user->saldo - $entrada->valor;
            $user->save();
            $entrada->delete();
        }
        return redirect()->route('consultas', $id_usuario);
    }

    public function filtrarEntrada(Request $req)
    {
        $user = User::find(auth()->user()->id);
        $dataInicial = new Carbon($req->dataInicial);
        $dataInicial = $dataInicial->subDay(1, 'day')->format('Y-m-d');
        $dataFinal = new Carbon($req->dataFinal);
        $dataFinal = $dataFinal->add(1, 'day')->format('Y-m-d');
        $entradas = $user->entrada()->whereBetween('data', [$dataInicial, $dataFinal])->orderBy('data', 'desc')->get();
        if ($entradas == null) $entradas = 0;
        $saidas =$user->saida()->orderBy('data', 'desc')->get();
        if ($saidas == null) $saidas = 0;
        $categoriasSaida = ['Essencial','Aposentadoria','Educação','Lazer'];
        $porcentagens = $this->somarCategorias($user);
        $porcentagensGerais = $this->somarCategoriasGerais();
        return Inertia::render('Consultas', ['entradas' => $entradas, 'saidas' => $saidas, 'porcentagens' => $porcentagens, 'porcentagensGerais' => $porcentagensGerais, 'categoriasSaida' => $categoriasSaida]);
    }

    public function filtrarSaida(Request $req)
    {
        $user = User::find(auth()->user()->id);
        $entradas = $user->entrada()->orderBy('data', 'desc')->get();
        if ($entradas == null) $entradas = 0;
        $dataInicial = new Carbon($req->dataInicial);
        $dataInicial = $dataInicial->subDay(1, 'day')->format('Y-m-d');
        $dataFinal = new Carbon($req->dataFinal);
        $dataFinal = $dataFinal->add(1, 'day')->format('Y-m-d');
        $saidas = $user->entrada()->whereBetween('data', [$dataInicial, $dataFinal])->orderBy('data', 'desc')->get();
        if ($saidas == null) $saidas = 0;
        $categoriasSaida = ['Essencial','Aposentadoria','Educação','Lazer'];
        $porcentagens = $this->somarCategorias($user);
        $porcentagensGerais = $this->somarCategoriasGerais();
        return Inertia::render('Consultas', ['entradas' => $entradas, 'saidas' => $saidas, 'porcentagens' => $porcentagens, 'porcentagensGerais' => $porcentagensGerais, 'categoriasSaida' => $categoriasSaida]);
    }

    private function somarCategorias($user)
    {
        $data = Carbon::now();
        $primeiro = $data->startOfMonth()->format('Y-m-d');
        $ultimo = $data->endOfMonth()->format('Y-m-d');
        $total = $user->entrada()->whereBetween('data', [$primeiro, $ultimo])->where('cofre', false)->sum('valor');
        $essencial=$user->saida()->whereBetween('data', [$primeiro, $ultimo])->where('categorias_id', 1)->sum('valor');
        $aposentadoria = $user->saida()->whereBetween('data', [$primeiro, $ultimo])->where('categorias_id', 2)->sum('valor');
        $educacao = $user->saida()->whereBetween('data', [$primeiro, $ultimo])->where('categorias_id', 3)->sum('valor');
        $gosto = $user->saida()->whereBetween('data', [$primeiro, $ultimo])->where('categorias_id', 4)->sum('valor');
        $objetivos = $user->saida()->whereBetween('data', [$primeiro, $ultimo])->where('categorias_id', 5)->sum('valor');
        
        if ($total == 0) {
            $temEntrada = false;
            $porcentagens = [
                $essencial,
                $aposentadoria,
                $educacao,
                $gosto,
                $objetivos,
                $temEntrada
            ];
        } else {
            $temEntrada = true;
            $essencial = ($essencial / $total) * 100;
            $aposentadoria = ($aposentadoria / $total) * 100;
            $educacao = ($educacao / $total) * 100;
            $gosto = ($gosto / $total) * 100;
            $objetivos = ($objetivos / $total) * 100;
        }
        $porcentagens = [
            $essencial,
            $aposentadoria,
            $educacao,
            $gosto,
            $objetivos,
            $temEntrada
        ];
        return $porcentagens;
    }

    private function somarCategoriasGerais()
    {
        $data = Carbon::now();
        $primeiro = $data->startOfMonth()->format('Y-m-d');
        $ultimo = $data->endOfMonth()->format('Y-m-d');
        $total = Entrada::whereBetween('created_at', [$primeiro, $ultimo])->sum('valor');
        if ($total == 0) $total = 1;
        $essencial = Saida::whereBetween('created_at', [$primeiro, $ultimo])->where('categorias_id', 1)->sum('valor');
        $aposentadoria = Saida::whereBetween('created_at', [$primeiro, $ultimo])->where('categorias_id', 3)->sum('valor');
        $educacao = Saida::whereBetween('created_at', [$primeiro, $ultimo])->where('categorias_id', 4)->sum('valor');
        $gosto = Saida::whereBetween('created_at', [$primeiro, $ultimo])->where('categorias_id', 5)->sum('valor');
        $porcentagens =
            [
                ($essencial / $total) * 100,
                ($aposentadoria / $total) * 100,
                ($educacao / $total) * 100,
                ($gosto / $total) * 100
            ];
        return $porcentagens;
    }

    private function somarGastos($user)
    {
        $data = Carbon::now();
        $primeiro = $data->startOfMonth()->format('Y-m-d');
        $ultimo = $data->endOfMonth()->format('Y-m-d');
        $gastos=$user->saida()->whereBetween('created_at', [$primeiro, $ultimo])->sum('valor');
        return $gastos;
    }
}
