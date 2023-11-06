<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Agendamento;
use App\Models\User;
use DateTime;

class AgendamentosController extends Controller
{
    public function index(){
        $user=User::find(auth()->user()->id);
        $agendamentos=$user()->agendamento()->orderBy('id', 'desc')->get();
        if($agendamentos==null) $agendamentos=0;
        else $atributosCalendario=$this->atributosCalendario($agendamentos);
        return Inertia::render('Agendamentos', ['agendamentos' => $agendamentos,'atributosCalendario'=>$atributosCalendario]);
    }

    public function adicionarAgendamento(Request $req){
        $agendamento=new Agendamento();
        $agendamento->nome=$req->nome;
        $agendamento->descricao=$req->descricao;
        $agendamento->data=$req->dataAgendamento;
        $agendamento->user_id=auth()->user()->id;
        $agendamento->save();
        return redirect()->route('agendamentos');
    }

    public function excluirAgendamento(Request $req){
        foreach($req->lista as $id){
            $agendamento=Agendamento::where('id', $id)->first(); //sempre finalizar com first, get ou paginate porque senão nçao traz
            $agendamento->delete();
        }
        return redirect()->route('agendamentos');
    }

    private function atributosCalendario($a){
        $atributos=[];
       foreach ($a as $j) {
            $data=new DateTime($j->data);
            $data=$data->format('Y-m-d');
            $nome=$j->nome;
            array_push($atributos,['title'=>$nome, 'date'=>$data]);
        }
        return $atributos;
    }
}
