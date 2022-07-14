<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Agendamento;
use App\Models\Meta;

class DashboardController extends Controller
{
    public function index(){
        $agendamentos=Agendamento::where('id_usuario', auth()->user()->id)->get();
        if($agendamentos==null) $agendamentos=0;
        return Inertia::render('Dashboard', ['agendamentos' => $agendamentos]);
    }

    public function adicionarAgendamento(Request $req){
        $agendamento=new Agendamento();
        $agendamento->nome=$req->nome;
        $agendamento->descricao=$req->descricao;
        $agendamento->data=$req->dataAgendamento;
        $agendamento->id_usuario=auth()->user()->id;
        $agendamento->save();
        return redirect()->route('dashboard');
    }

    public function excluirAgendamento(Request $req){
        foreach($req->listaExclusao as $id){
            $agendamento=Agendamento::where('id', $id)->first(); //sempre finalizar com first, get ou paginate porque senão nçao traz
            $agendamento->delete();
        }
        return redirect()->route('dashboard');
    }

    public function adicionarMeta(Request $req){
        $meta=new Meta();
        $meta->nome=$req->nome;
        $meta->valor=$req->valor;
        $meta->descricao=$req->descricao??"";
        $meta->duracao=$req->duracao;
        $meta->status="Em andamento";
        $meta->id_usuario=auth()->user()->id;
        $meta->save();
        return redirect()->route('dashboard');
    }
}
