<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;
use App\Models\Cartaos;
use App\Models\Viagem;
use Carbon\Carbon;

use Illuminate\Http\Request;

class CartaoController extends Controller
{
    public function index()
    {
        $cartoes = $this->cartoes();
        $cartoes = $cartoes == null ? $cartoes = 0 : $cartoes;
        return Inertia::render('Cartao', ['cartoes' => $cartoes]);
    }

    public function adicionarCartao(Request $req, $id = null)
    {

        if ($id == null) $id = auth()->user()->id;
        $req->validate([
            'nome' => 'required|string|max:255',
            'valorRecarga' => 'required',
        ]);
        $cartao = new Cartaos();
        $cartao->nome = $req->nome;
        $cartao->valor = $req->valorRecarga;
        $cartao->id_usuario = $id;
        $cartao->save();
        $user = User::where('id', $id)->first();
        $user->saldo = $user->saldo - $cartao->valor;
        $user->save();
        return redirect()->route('cartao', $id);
    }

    public function recarregarCartao(Request $req, $id = null)
    {
        if ($id == null) $id = auth()->user()->id;
        $cartao = Cartaos::where('id', $req->id)->first();
        $cartao->valor += $req->valorRecarga;
        $cartao->ultima_recarga = Carbon::now();
        $cartao->save();
        $saida = new Saida();
        $saida->nome = "Recarga de ônibus";
        $saida->valor = $req->valorRecarga;
        $saida->id_usuario = $id;
        $saida->id_categoria = 1;
        $saida->data = $cartao->ultima_recarga;
        $saida->save();
        $user = User::where('id', $id)->first();
        $user->saldo = $user->saldo - $req->valorRecarga;
        $user->save();
        return redirect()->route('cartao', $id);
    }

    public function retirarCartao(Request $req, $id = null)
    {
        if ($id == null) $id = auth()->user()->id;
        $cartao = Cartaos::where('id', $req->id)->first();
        $cartao->valor -= $req->valorRetirada * $req->numeroPassagens;
        $cartao->save();
        $viagem = new Viagem();
        $viagem->valor = $req->valorRetirada * $req->numeroPassagens;
        $viagem->cartaos_id = $cartao->id;
        $viagem->data = Carbon::now();
        $viagem->save();
        return redirect()->route('cartao', $id);
    }

    public function excluirCartao(Request $req)
    {
        $id_usuario = auth()->user()->id;
        $user = User::where('id', $id_usuario)->first();
        foreach ($req->listaExclusao as $id) {
            $cartao = Cartaos::where('id', $id)->first(); //sempre finalizar com first, get ou paginate porque senão nçao traz
            $user->saldo = $user->saldo + $cartao->valor;
            $user->save();
            $cartao->delete();
        }
        return redirect()->route('cartao');
    }

    private function cartoes()
    {
        $user = User::find(auth()->user()->id);
        $cartoes = $user->cartao()->with('viagem')->get();
        $cartoes = count($cartoes) > 0 ? $cartoes : null;
        if($cartoes){
            foreach ($cartoes as $cartao)
                $cartao->viagem = count($cartao->viagem) == 0 ?  null : $cartao->viagem;
        }
        return $cartoes;
    }
}
