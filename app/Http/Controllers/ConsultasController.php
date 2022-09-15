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
        if ($id == null) $id = auth()->user()->id;
        $entradas = Entrada::where('id_usuario', '=', $id)->orderBy('data', 'desc')->get();
        if ($entradas == null) $entradas = 0;
        $saidas = Saida::where('id_usuario', '=', $id)->orderBy('data', 'desc')->get();
        if ($saidas == null) $saidas = 0;
        /*$categoriasEntrada = Categoria::where('id_tipo',2)->get()->pluck('nome');
        $categoriasEntrada=$categoriasEntrada->toArray();*/
        $categoriasSaida = Categoria::where('id', '<', 5)->get()->pluck('nome');
        $categoriasSaida = $categoriasSaida->toArray();
        $porcentagens = $this->somarCategorias();
        $porcentagensGerais = $this->somarCategoriasGerais();
        $gastosMensais = $this->somarGastos();
        $metasConcluidas = Meta::where('id_usuario', $id)->where('status', 'like', 'Concluída')->get();
        $metasConcluidas = $metasConcluidas == null ? $metasConcluidas = 0 : $metasConcluidas->count();
        $metas = Meta::where('id_usuario', $id)->get();
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
        $entrada->id_usuario = $id;
        $entrada->data = date("Y-m-d H:i:s");
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
        $saida->id_usuario = $id;
        $categoria = Categoria::where('nome', 'like', $req->id_categoria)->first();
        $saida->id_categoria = $categoria->id;
        $saida->data = date("Y-m-d H:i:s");
        $saida->save();
        $user = User::where('id', $id)->first();
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
        $user = User::where('id', $id)->first();
        $user->cofre = $user->cofre + $req->valor;
        $user->saldo = $user->saldo - $req->valor;
        $user->save();
        $saida = new Saida();
        $saida->nome ='Dinheiro Guardado';
        $saida->id_categoria=5;
        $saida->valor = $req->valor;
        $saida->descricao = 'cofre';
        $saida->data = date("Y-m-d H:i:s");
        $saida->id_usuario = $id;
        $saida->save();
        return redirect()->route('consultas', $id);
    }

    public function removerCofre(Request $req)
    {
        $id = auth()->user()->id;
        $req->validate([
            'valor' => 'required',
        ]);
        $user = User::where('id', $id)->first();
        $user->cofre = $user->cofre - $req->valor;
        $entrada = new Entrada();
        $entrada->nome ='Dinheiro Resgatado';
        $entrada->valor = $req->valor;
        $entrada->descricao = 'Resgato do cofre';
        $entrada->data = date("Y-m-d H:i:s");
        $entrada->id_usuario = $id;
        $entrada->save();
        $user->saldo = $user->saldo + $req->valor;
        $user->save();
        $saida=Saida::where('id_usuario',$id)->where('descricao','like','cofre')->orderBy('created_at', 'desc')->first();
        
        
        if($req->valor>=$saida->valor){
        while($req->valor>=$saida->valor){
            
            if($req->valor=$saida->valor){$saida->delete();break;}
            else{$req->valor=$req->valor-$saida->valor;
            $saida->delete();
            $saida=Saida::where('id_usuario',$id)->where('descricao','like','cofre')->orderBy('created_at', 'desc')->first();
            }
        }
    }
        else{
            $saida->valor=$saida->valor-$req->valor;
            $saida->save();
        }
        return redirect()->route('consultas', $id);
    }

    public function excluirSaida(Request $req)
    {
        $id_usuario = auth()->user()->id;
        $user = User::where('id', $id_usuario)->first();
        foreach ($req->listaExclusao as $id) {
            $saida = Saida::where('id', $id)->first(); //sempre finalizar com first, get ou paginate porque senão nçao traz
            $user->saldo = $user->saldo + $saida->valor;
            $user->save();
            $saida->delete();
        }
        return redirect()->route('consultas', $id_usuario);
    }

    public function excluirEntrada(Request $req)
    {
        $id_usuario = auth()->user()->id;
        $user = User::where('id', $id_usuario)->first();
        foreach ($req->listaExclusao as $id) {
            $entrada = Entrada::where('id', $id)->first(); //sempre finalizar com first, get ou paginate porque senão nçao traz
            $user->saldo = $user->saldo - $entrada->valor;
            $user->save();
            $entrada->delete();
        }
        return redirect()->route('consultas', $id_usuario);
    }

    public function filtrarEntrada(Request $req)
    {
        $id = auth()->user()->id;
        $entradas = Entrada::where('id_usuario', '=', $id)->whereBetween('data', [$req->dataInicial, $req->dataFinal])->orderBy('data', 'desc')->get();
        if ($entradas == null) $entradas = 0;
        $saidas = Saida::where('id_usuario', '=', $id)->orderBy('data', 'desc')->get();
        if ($saidas == null) $saidas = 0;
        /*$categoriasEntrada = Categoria::where('id_tipo',2)->get()->pluck('nome');
        $categoriasEntrada=$categoriasEntrada->toArray();*/
        $categoriasSaida = Categoria::where('id_tipo', 1)->get()->pluck('nome');
        $categoriasSaida = $categoriasSaida->toArray();
        $porcentagens = $this->somarCategorias();
        $porcentagensGerais = $this->somarCategoriasGerais();
        return Inertia::render('Consultas', ['entradas' => $entradas, 'saidas' => $saidas, 'porcentagens' => $porcentagens, 'porcentagensGerais' => $porcentagensGerais, 'categoriasSaida' => $categoriasSaida, 'id' => $id]);
    }

    public function filtrarSaida(Request $req)
    {
        $id = auth()->user()->id;
        $entradas = Entrada::where('id_usuario', '=', $id)->orderBy('data', 'desc')->get();
        if ($entradas == null) $entradas = 0;
        $saidas = Saida::where('id_usuario', '=', $id)->whereBetween('data', [$req->dataInicial, $req->dataFinal])->orderBy('data', 'desc')->get();
        if ($saidas == null) $saidas = 0;
        /*$categoriasEntrada = Categoria::where('id_tipo',2)->get()->pluck('nome');
        $categoriasEntrada=$categoriasEntrada->toArray();*/
        $categoriasSaida = Categoria::where('id_tipo', 1)->get()->pluck('nome');
        $categoriasSaida = $categoriasSaida->toArray();
        $porcentagens = $this->somarCategorias();
        $porcentagensGerais = $this->somarCategoriasGerais();
        return Inertia::render('Consultas', ['entradas' => $entradas, 'saidas' => $saidas, 'porcentagens' => $porcentagens, 'porcentagensGerais' => $porcentagensGerais, 'categoriasSaida' => $categoriasSaida, 'id' => $id]);
    }

    private function somarCategorias()
    {
        $data = Carbon::now();
        $primeiro = $data->startOfMonth()->format('Y-m-d');
        $ultimo = $data->endOfMonth()->format('Y-m-d');
        $total = Entrada::whereBetween('data', [$primeiro, $ultimo])->where('id_usuario', auth()->user()->id)->sum('valor');

        $essencial = Saida::whereBetween('data', [$primeiro, $ultimo])->where('id_categoria', 1)->where('id_usuario', auth()->user()->id)->sum('valor');
        $aposentadoria = Saida::whereBetween('data', [$primeiro, $ultimo])->where('id_categoria', 2)->where('id_usuario', auth()->user()->id)->sum('valor');
        $educacao = Saida::whereBetween('data', [$primeiro, $ultimo])->where('id_categoria', 3)->where('id_usuario', auth()->user()->id)->sum('valor');
        $gosto = Saida::whereBetween('data', [$primeiro, $ultimo])->where('id_categoria', 4)->where('id_usuario', auth()->user()->id)->sum('valor');
        $objetivos = Saida::whereBetween('data', [$primeiro, $ultimo])->where('id_categoria', 5)->where('id_usuario', auth()->user()->id)->sum('valor');

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
        $essencial = Saida::whereBetween('created_at', [$primeiro, $ultimo])->where('id_categoria', 1)->sum('valor');
        $aposentadoria = Saida::whereBetween('created_at', [$primeiro, $ultimo])->where('id_categoria', 3)->sum('valor');
        $educacao = Saida::whereBetween('created_at', [$primeiro, $ultimo])->where('id_categoria', 4)->sum('valor');
        $gosto = Saida::whereBetween('created_at', [$primeiro, $ultimo])->where('id_categoria', 5)->sum('valor');
        $porcentagens =
            [
                ($essencial / $total) * 100,
                ($aposentadoria / $total) * 100,
                ($educacao / $total) * 100,
                ($gosto / $total) * 100
            ];
        return $porcentagens;
    }

    private function somarGastos()
    {
        $data = Carbon::now();
        $primeiro = $data->startOfMonth()->format('Y-m-d');
        $ultimo = $data->endOfMonth()->format('Y-m-d');
        $gastos = Saida::whereBetween('created_at', [$primeiro, $ultimo])->where('id_usuario', auth()->user()->id)->sum('valor');
        return $gastos;
    }
}
