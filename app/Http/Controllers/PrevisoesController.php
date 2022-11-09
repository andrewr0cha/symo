<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use App\Models\Entrada;
use App\Models\Saida;
use DateTime;

class PrevisoesController extends Controller
{
    public function index()
    {
        $data = Carbon::now();
        
        $hoje = $data->format('Y-m-d');
        $amanha = $data->add(1, 'day')->format('Y-m-d');
        $semana = $data->subWeek()->format('Y-m-d');
        $mes = $data->subMonth()->format('Y-m-d');
        $ano = $data->subYear()->format('Y-m-d');
        $dados = $this->calcularDados($hoje,$amanha,$semana,$mes,$ano);
        $dadosAnuais = $this->listarAnual($ano, $amanha);
        $meses = $this->listarMeses($ano, $amanha);
        return Inertia::render('Previsoes', ['dados' => $dados,'dadosAnuais' => $dadosAnuais,'meses' => $meses]);
    }

    private function calcularDados($hoje, $amanha, $semana, $mes, $ano )
    {
        $diarioEntrada = Entrada::where('data', '>', $hoje)->where('data', '<', $amanha)->where('id_usuario', auth()->user()->id)->sum('valor');
        $diarioSaida = Saida::where('data', '>', $hoje)->where('data', '<', $amanha)->where('id_usuario', auth()->user()->id)->sum('valor');
        $semanalEntrada = Entrada::where('data', '>', $semana)->where('data', '<', $amanha)->where('id_usuario', auth()->user()->id)->sum('valor');
        $semanalSaida = Saida::where('data', '>', $semana)->where('data', '<', $amanha)->where('id_usuario', auth()->user()->id)->sum('valor');
        $mensalEntrada = Entrada::where('data', '>', $mes)->where('data', '<', $amanha)->where('id_usuario', auth()->user()->id)->sum('valor');
        $mensalSaida = Saida::where('data', '>', $mes)->where('data', '<', $amanha)->where('id_usuario', auth()->user()->id)->sum('valor');
        $anualEntrada = Entrada::where('data', '>', $ano)->where('data', '<', $amanha)->where('id_usuario', auth()->user()->id)->sum('valor');
        $anualSaida = Saida::where('data', '>', $ano)->where('data', '<', $amanha)->where('id_usuario', auth()->user()->id)->sum('valor');
        
        $dados = [
            $entrada = [$diarioEntrada, $semanalEntrada, $mensalEntrada, $anualEntrada],
            $saida = [$diarioSaida, $semanalSaida, $mensalSaida, $anualSaida]
        ];
        return $dados;
    }

    private function listarAnual($ano,$amanha){
        $entrada = Entrada::where('data', '>', $ano)->where('data', '<', $amanha)->where('id_usuario', auth()->user()->id)->orderBy('data','asc')->get();
        $entradaAnual=[0,0,0,0,0,0,0,0,0,0,0,0,0,];
        $i=0;$j=0;
        if(count($entrada)>0){
            $date=date_create($entrada[0]->data);
        $antiga2=$date;
        $date=date_format($date,'Y-m');
        $antiga=$date;
        $anoAtras=Carbon::now();
        $anoAtras = $anoAtras->subYear()->format('Y-m');
        foreach($entrada as $item){
            $date=date_create($item->data);
            $date=date_format($date,'Y-m');
            $atual=$date;
        while ($j==0){
            if($atual!=$anoAtras){
                $i++;
                $anoAtras=Carbon::parse($anoAtras)->addMonth()->format('Y-m');
            }else{$j++;}
        }
            if($atual==$antiga){
                $entradaAnual[$i]+=$item->valor;
            }
            else if($atual>$antiga){
                $date=date_create($item->data);
                $atual2=$date;
                $atual2=date_format($atual2,'n');
                $antiga2=date_format($antiga2,'n');
                if((intval($atual2)-intval($antiga2))==1||(intval($atual2)-intval($antiga2))==-11){$i++;}
                else if((intval($atual2)-intval($antiga2))==2||(intval($atual2)-intval($antiga2))==-10){$i+=2;}
            else if((intval($atual2)-intval($antiga2))==3||(intval($atual2)-intval($antiga2))==-9){$i+=3;}
                else if((intval($atual2)-intval($antiga2))==4||(intval($atual2)-intval($antiga2))==-8){$i+=4;}
                else if((intval($atual2)-intval($antiga2))==5||(intval($atual2)-intval($antiga2))==-7){$i+=5;}
                else if((intval($atual2)-intval($antiga2))==6||(intval($atual2)-intval($antiga2))==-6){$i+=6;}
                else if((intval($atual2)-intval($antiga2))==7||(intval($atual2)-intval($antiga2))==-5){$i+=7;}
                else if((intval($atual2)-intval($antiga2))==8||(intval($atual2)-intval($antiga2))==-4){$i+=8;}
                else if((intval($atual2)-intval($antiga2))==9||(intval($atual2)-intval($antiga2))==-3){$i+=9;}
                else if((intval($atual2)-intval($antiga2))==10||(intval($atual2)-intval($antiga2))==-2){$i+=10;}
                else if((intval($atual2)-intval($antiga2))==11||(intval($atual2)-intval($antiga2))==-1){$i+=11;}
                $entradaAnual[$i]+=$item->valor;
                $antiga=$atual;
                $antiga2=$date;
                }
        }}

        $saida = Saida::where('data', '>', $ano)->where('data', '<', $amanha)->where('id_usuario', auth()->user()->id)->orderBy('data','asc')->get();
        $saidaAnual=[0,0,0,0,0,0,0,0,0,0,0,0,0,];
        if(count($saida)>0){
        
        $i=0;$j=0;
        $date=date_create($saida[0]->data);
        $antiga2=$date;
        $date=date_format($date,'Y-m');
        $antiga=$date;
        $anoAtras=Carbon::now();
        $anoAtras = $anoAtras->subYear()->format('Y-m');
        foreach($saida as $item){
            $date=date_create($item->data);
            $date=date_format($date,'Y-m');
            $atual=$date;
        while ($j==0){
            if($atual!=$anoAtras){
                $i++;
                $anoAtras=Carbon::parse($anoAtras)->addMonth()->format('Y-m');
            }else{$j++;}
        }
            if($atual==$antiga){
                $saidaAnual[$i]+=$item->valor;
            }
            else if($atual>$antiga){
                $date=date_create($item->data);
                $atual2=$date;
                $atual2=date_format($atual2,'n');
                $antiga2=date_format($antiga2,'n');
                if((intval($atual2)-intval($antiga2))==1||(intval($atual2)-intval($antiga2))==-11){$i++;}
                else if((intval($atual2)-intval($antiga2))==2||(intval($atual2)-intval($antiga2))==-10){$i+=2;}
                else if((intval($atual2)-intval($antiga2))==3||(intval($atual2)-intval($antiga2))==-9){$i+=3;}
                else if((intval($atual2)-intval($antiga2))==4||(intval($atual2)-intval($antiga2))==-8){$i+=4;}
                else if((intval($atual2)-intval($antiga2))==5||(intval($atual2)-intval($antiga2))==-7){$i+=5;}
                else if((intval($atual2)-intval($antiga2))==6||(intval($atual2)-intval($antiga2))==-6){$i+=6;}
                else if((intval($atual2)-intval($antiga2))==7||(intval($atual2)-intval($antiga2))==-5){$i+=7;}
                else if((intval($atual2)-intval($antiga2))==8||(intval($atual2)-intval($antiga2))==-4){$i+=8;}
                else if((intval($atual2)-intval($antiga2))==9||(intval($atual2)-intval($antiga2))==-3){$i+=9;}
                else if((intval($atual2)-intval($antiga2))==10||(intval($atual2)-intval($antiga2))==-2){$i+=10;}
                else if((intval($atual2)-intval($antiga2))==11||(intval($atual2)-intval($antiga2))==-1){$i+=11;}
                $saidaAnual[$i]+=$item->valor;
                $antiga=$atual;
                $antiga2=$date;
                }
        }}
        $dadosAnuais=[$entradaAnual,$saidaAnual];
        return $dadosAnuais;
    }

    private function listarMeses($ano, $amanha){
        $meses=array();
        $j=['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro','Outubro', 'Novembro', 'Dezembro'];
        for($i=12;$i>=0;$i--){
            $data = Carbon::now();
            $data2=$data->subMonths($i);
            $meses[]=$j[date_format($data2,'n')-1].'/'.date_format($data2,'Y');
        }
        return $meses;
    }
}
