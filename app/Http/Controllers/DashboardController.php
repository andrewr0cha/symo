<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;

class DashboardController extends Controller
{
    public function adicionarAgendamento(Request $req){
        $agendamento=new Agendamento();
        $agendamento->nome=$req->nome;
        $agendamento->valor=$req->valor??0;
        $agendamento->descricao=$req->descricao;
        $agendamento->data=$req->dataAgendamento;
        $agendamento->id_usuario=auth()->user()->id;
        $agendamento->save();
    }
}
