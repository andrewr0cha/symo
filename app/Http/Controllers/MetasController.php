<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Meta;

class MetasController extends Controller
{
    public function index(){
        $curtoPrazo=Meta::where('id_usuario', auth()->user()->id)->where('duracao','Curto')->get();
        if($curtoPrazo==null) $curtoPrazo=0;
        $medioPrazo=Meta::where('id_usuario', auth()->user()->id)->where('duracao','Médio')->get();
        if($medioPrazo==null) $medioPrazo=0;
        $longoPrazo=Meta::where('id_usuario', auth()->user()->id)->where('duracao','Longo')->get();
        if($longoPrazo==null) $longoPrazo=0;
        return Inertia::render('Metas', ['curtoPrazo'=>$curtoPrazo,'medioPrazo'=>$medioPrazo,'longoPrazo'=>$longoPrazo]);
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
        return redirect()->route('metas');
    }

    public function excluirMeta(Request $req){
        foreach($req->lista as $id){
            $meta=Meta::where('id', $id)->first(); //sempre finalizar com first, get ou paginate porque senão nçao traz
            $meta->delete();
        }
        return redirect()->route('metas');
    }

    public function concluirMeta(Request $req){
        foreach($req->lista as $id){
            $meta=Meta::where('id',$id)->first();
            $meta->status="Concluída";
            $meta->update();
        }
        return redirect()->route('metas');
    }
}
