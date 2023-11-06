<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Agendamento;
use App\Models\Meta;
use App\Models\Saida;
use App\Models\Entrada;
use App\Models\Dicas;
use App\Models\User;
use DateTime;

class DashboardController extends Controller
{
    public function index()
    {
        $user=User::find(auth()->user()->id);
        $agendamentos=$user->agendamento()->orderBy('id', 'desc')->get();
        if ($agendamentos == null) $agendamentos = 0;
        else $atributosCalendario = $this->atributosCalendario($agendamentos);
        $data = new DateTime();
        //dd($data->format('Y-m-d'));
        $data = $data->format('Y-m-d');
        $agendamentosDia = $user->agendamento()->where('data', $data)->orderBy('id', 'desc')->get();
        if (count($agendamentosDia) >= 1) {
            $metasDia = $agendamentosDia;
            $metas = true;
        } else {
            $metasDia = 0;
            $metas = false;
        };
        $curtoPrazo = $user->meta()->where('duracao', 'Curto')->orderBy('id', 'desc')->get();
        if ($curtoPrazo == null) $curtoPrazo = 0;
        $medioPrazo = $user->meta()->where('duracao', 'Médio')->orderBy('id', 'desc')->get();
        if ($medioPrazo == null) $medioPrazo = 0;
        $longoPrazo = $user->meta()->where('duracao', 'Longo')->orderBy('id', 'desc')->get();
        if ($longoPrazo == null) $longoPrazo = 0;
        $gastosMensais = $this->somarGastos($user);
        $dicas = $this->sorteiaDicas();
        return Inertia::render('Dashboard', ['agendamentos' => $agendamentos, 'curtoPrazo' => $curtoPrazo, 'medioPrazo' => $medioPrazo, 'longoPrazo' => $longoPrazo, 'atributosCalendario' => $atributosCalendario, 'gastosMensais' => $gastosMensais, 'metasDia' => $metasDia, 'metas' => $metas, 'dicas' => $dicas]);
    }

    public function adicionarAgendamento(Request $req, int $id = null)
    {

        if ($id == null) {
            $agendamento = new Agendamento();
            $agendamento->nome = $req->nome;
            $agendamento->descricao = $req->descricao;
            $agendamento->data = $req->dataAgendamento;
            $agendamento->user_id= auth()->user()->id;
            $agendamento->save();
        } else {
            $agendamento = Agendamento::find($id);
            $agendamento->nome = $req->nome;
            $agendamento->descricao = $req->descricao;
            $agendamento->data = $req->dataAgendamento;
            $agendamento->update();
        }
        return redirect()->route('dashboard');
    }

    public function excluirAgendamento(Request $req)
    {
        foreach ($req->lista as $id) {
            $agendamento = Agendamento::find($id); //sempre finalizar com first, get ou paginate porque senão nçao traz
            $agendamento->delete();
        }
        return redirect()->route('dashboard');
    }

    public function adicionarMeta(Request $req)
    {
        $meta = new Meta();
        $meta->nome = $req->nome;
        $meta->valor = $req->valor;
        $meta->descricao = $req->descricao ?? "";
        $meta->duracao = $req->duracao;
        $meta->status = "Em andamento";
        $meta->user_id = auth()->user()->id;
        $meta->save();
        return redirect()->route('dashboard');
    }

    public function excluirMeta(Request $req)
    {
        foreach ($req->lista as $id) {
            $meta = Meta::find($id); //sempre finalizar com first, get ou paginate porque senão nçao traz
            if ($meta->valor_guardado > 0) {
                $user = User::find(auth()->user()->id);
                $user->saldo += $meta->valor_guardado;
                $user->cofreMeta -= $meta->valor_guardado;
                $user->update();
            }
            $meta->delete();
        }
        return redirect()->route('dashboard');
    }

    public function concluirMeta(Request $req)
    {
        foreach ($req->lista as $id) {
            $meta = Meta::find($id)->first();
            $meta->status = "Concluída";
            $meta->update();
        }
        return redirect()->route('dashboard');
    }

    public function guardarMeta(Request $req)
    {
        $meta = Meta::find($req->id);
        $meta->valor_guardado += $req->valor;
        $meta->save();
        $user = User::find(auth()->user()->id);
        $user->cofreMeta += $req->valor;
        $user->saldo -= $req->valor;
        $user->save();
        $saida = new Saida();
        $saida->nome = 'Dinheiro Guardado';
        $saida->id_categoria = 5;
        $saida->valor = $req->valor;
        $saida->descricao = 'Posto no Cofre para Meta Específica';
        $saida->data = date("Y-m-d H:i:s");
        $saida->user_id = auth()->user()->id;
        $saida->cofre = true;
        $saida->save();
        return redirect()->route('dashboard');
    }

    public function retirarMeta(Request $req)
    {
        $meta = Meta::find($req->id);
        $meta->valor_guardado -= $req->valor;
        $meta->save();
        $user = User::find(auth()->user()->id);
        $user->cofreMeta -= $req->valor;
        $user->saldo += $req->valor;
        $user->save();
        $entrada = new Entrada();
        $entrada->nome = 'Dinheiro Resgatado';
        $entrada->valor = $req->valor;
        $entrada->descricao = 'Retirado do Cofre de uma Meta Específica';
        $entrada->data = date("Y-m-d H:i:s");
        $entrada->user_id = auth()->user()->id;
        $entrada->cofre = true;
        $entrada->save();
        return redirect()->route('dashboard');
    }

    private function atributosCalendario($a)
    {
        $atributos = [];
        foreach ($a as $j) {
            $data = new DateTime($j->data);
            $data = $data->format('Y-m-d');
            $nome = $j->nome;
            array_push($atributos, ['title' => $nome, 'date' => $data]);
        }
        return $atributos;
    }

    private function somarGastos($user)
    {
        $data = Carbon::now();
        $primeiro = $data->startOfMonth()->format('Y-m-d');
        $ultimo = $data->endOfMonth()->format('Y-m-d');
        $gastos = $user->saida()->whereBetween('created_at', [$primeiro, $ultimo])->sum('valor');
        return $gastos;
    }

    private function sorteiaDicas()
    {
        $dicas = [];
        $numeros = [];
        $i = 0;
        while ($i < 3) {
            $numero = random_int(1, 18);
            if ((in_array($numero, $numeros))==false) {
                array_push($numeros, $numero);
                $i++;
            }
        }
        for ($i = 0; $i < 3; $i++) {
            $dica = Dicas::where('id', $numeros[$i])->first();
            $dicas[$i] = $dica->dica;
        }

        return $dicas;
    }
}
