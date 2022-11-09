<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use App\Models\Entrada;
use App\Models\Simulacao;
use DateTime;

class SimulacaoController extends Controller
{
    public function index()
    {
        $meses = $this->listarMeses();
        $meses2 = $this->listarMeses2();
        $lista = $this->listarDados();
        $somas = $this->somarDados();
        return Inertia::render('Simulacao', ['meses' => $meses, 'meses2' => $meses2, 'lista' => $lista, 'dados' => $somas]);
    }

    public function salvar(Request $req)
    {
        for ($i = 0; $i < 13; $i++) {
            for ($j = 0; $j < count($req[$i]); $j++) {
                if ($req[$i][$j]["id"] == null) {
                    $simulacao = new Simulacao;
                    $simulacao->nome = $req[$i][$j]["nome"];
                    $simulacao->valor = $req[$i][$j]["valor"];
                    $simulacao->data = $req[$i][$j]["data"];
                    $simulacao->tipo = $req[$i][$j]["tipo"];
                    $simulacao->id_usuario = auth()->user()->id;
                    $simulacao->save();
                }
            }
        }
        return redirect()->route('simulacao');
    }

    public function excluir(Request $req)
    {
        foreach ($req->listaExclusao as $id) {
            $simulacao = Simulacao::find($id);
            $simulacao->delete();
        }
        return redirect()->route('simulacao');
    }

    private function listarMeses()
    {
        $meses = array();
        $j = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
        for ($i = 0; $i <= 12; $i++) {
            $data = Carbon::now();
            $data2 = $data->addMonths($i);
            $meses[] = $j[date_format($data2, 'n') - 1] . '/' . date_format($data2, 'Y');
        }
        return $meses;
    }

    private function listarMeses2()
    {
        $meses = array();
        for ($i = 0; $i <= 12; $i++) {
            $data = Carbon::now();
            $data2 = $data->addMonths($i);
            $meses[] = date_format($data2, 'Y-m') . '-01';
        }
        return $meses;
    }

    private function listarDados()
    {
        $data = Carbon::now();
        $mes = $data->format('Y-m') . '-01';;
        $ano = $data->addYear()->format('Y-m') . '-01';
        $dados = Simulacao::where('data', '>=', $mes)->where('data', '<=', $ano)->where('id_usuario', auth()->user()->id)->orderBy('data', 'asc')->get();
        $lista = [[], [], [], [], [], [], [], [], [], [], [], [], [],];
        $i = 0;
        $j = 0;
        if (count($dados) > 0) {
            $date = date_create($dados[0]->data);
            $antiga2 = $date;
            $date = date_format($date, 'Y-m');
            $antiga = $date;
            $anoAtual = Carbon::now();
            $anoAtual = $anoAtual->format('Y-m');
            foreach ($dados as $item) {
                $date = date_create($item->data);
                $date = date_format($date, 'Y-m');
                $atual = $date;
                while ($j == 0) {
                    if ($atual != $anoAtual) {
                        $i++;
                        $anoAtual = Carbon::parse($anoAtual)->addMonth()->format('Y-m');
                    } else {
                        $j++;
                    }
                }
                if ($atual == $antiga) {
                    array_push($lista[$i], $item);
                } else if ($atual > $antiga) {
                    $date = date_create($item->data);
                    $atual2 = $date;
                    $atual2 = date_format($atual2, 'n');
                    $antiga2 = date_format($antiga2, 'n');
                    if ((intval($atual2) - intval($antiga2)) == 1 || (intval($atual2) - intval($antiga2)) == -11) {
                        $i++;
                    } else if ((intval($atual2) - intval($antiga2)) == 2 || (intval($atual2) - intval($antiga2)) == -10) {
                        $i += 2;
                    } else if ((intval($atual2) - intval($antiga2)) == 3 || (intval($atual2) - intval($antiga2)) == -9) {
                        $i += 3;
                    } else if ((intval($atual2) - intval($antiga2)) == 4 || (intval($atual2) - intval($antiga2)) == -8) {
                        $i += 4;
                    } else if ((intval($atual2) - intval($antiga2)) == 5 || (intval($atual2) - intval($antiga2)) == -7) {
                        $i += 5;
                    } else if ((intval($atual2) - intval($antiga2)) == 6 || (intval($atual2) - intval($antiga2)) == -6) {
                        $i += 6;
                    } else if ((intval($atual2) - intval($antiga2)) == 7 || (intval($atual2) - intval($antiga2)) == -5) {
                        $i += 7;
                    } else if ((intval($atual2) - intval($antiga2)) == 8 || (intval($atual2) - intval($antiga2)) == -4) {
                        $i += 8;
                    } else if ((intval($atual2) - intval($antiga2)) == 9 || (intval($atual2) - intval($antiga2)) == -3) {
                        $i += 9;
                    } else if ((intval($atual2) - intval($antiga2)) == 10 || (intval($atual2) - intval($antiga2)) == -2) {
                        $i += 10;
                    } else if ((intval($atual2) - intval($antiga2)) == 11 || (intval($atual2) - intval($antiga2)) == -1) {
                        $i += 11;
                    }
                    array_push($lista[$i], $item);
                    $antiga = $atual;
                    $antiga2 = $date;
                }
            }
        }
        return $lista;
    }

    private function somarDados()
    {
        $data = Carbon::now();
        $mes = $data->format('Y-m') . '-01';;
        $ano = $data->addYear()->format('Y-m') . '-01';
        $entrada = Simulacao::where('data', '>=', $mes)->where('data', '<=', $ano)->where('id_usuario', auth()->user()->id)->where('tipo', '=', 'entrada')->orderBy('data', 'asc')->get();
        $entradaAnual = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,];
        $i = 0;
        $j = 0;
        if (count($entrada) > 0) {
            $date = date_create($entrada[0]->data);
            $antiga2 = $date;
            $date = date_format($date, 'Y-m');
            $antiga = $date;
            $anoAtual = Carbon::now();
            $anoAtual = $anoAtual->format('Y-m');
            foreach ($entrada as $item) {
                $date = date_create($item->data);
                $date = date_format($date, 'Y-m');
                $atual = $date;
                while ($j == 0) {
                    if ($atual != $anoAtual) {
                        $i++;
                        $anoAtual = Carbon::parse($anoAtual)->addMonth()->format('Y-m');
                    } else {
                        $j++;
                    }
                }
                if ($atual == $antiga) {
                    $entradaAnual[$i] += $item->valor;
                } else if ($atual > $antiga) {
                    $date = date_create($item->data);
                    $atual2 = $date;
                    $atual2 = date_format($atual2, 'n');
                    $antiga2 = date_format($antiga2, 'n');
                    if ((intval($atual2) - intval($antiga2)) == 1 || (intval($atual2) - intval($antiga2)) == -11) {
                        $i++;
                    } else if ((intval($atual2) - intval($antiga2)) == 2 || (intval($atual2) - intval($antiga2)) == -10) {
                        $i += 2;
                    } else if ((intval($atual2) - intval($antiga2)) == 3 || (intval($atual2) - intval($antiga2)) == -9) {
                        $i += 3;
                    } else if ((intval($atual2) - intval($antiga2)) == 4 || (intval($atual2) - intval($antiga2)) == -8) {
                        $i += 4;
                    } else if ((intval($atual2) - intval($antiga2)) == 5 || (intval($atual2) - intval($antiga2)) == -7) {
                        $i += 5;
                    } else if ((intval($atual2) - intval($antiga2)) == 6 || (intval($atual2) - intval($antiga2)) == -6) {
                        $i += 6;
                    } else if ((intval($atual2) - intval($antiga2)) == 7 || (intval($atual2) - intval($antiga2)) == -5) {
                        $i += 7;
                    } else if ((intval($atual2) - intval($antiga2)) == 8 || (intval($atual2) - intval($antiga2)) == -4) {
                        $i += 8;
                    } else if ((intval($atual2) - intval($antiga2)) == 9 || (intval($atual2) - intval($antiga2)) == -3) {
                        $i += 9;
                    } else if ((intval($atual2) - intval($antiga2)) == 10 || (intval($atual2) - intval($antiga2)) == -2) {
                        $i += 10;
                    } else if ((intval($atual2) - intval($antiga2)) == 11 || (intval($atual2) - intval($antiga2)) == -1) {
                        $i += 11;
                    }
                    $entradaAnual[$i] += $item->valor;
                    $antiga = $atual;
                    $antiga2 = $date;
                }
            }
        }

        $data = Carbon::now();
        $mes = $data->format('Y-m') . '-01';;
        $ano = $data->addYear()->format('Y-m') . '-01';
        $saida = Simulacao::where('data', '>=', $mes)->where('data', '<=', $ano)->where('id_usuario', auth()->user()->id)->where('tipo', '=', 'saida')->orderBy('data', 'asc')->get();

        $saidaAnual = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,];
        $i = 0;
        $j = 0;
        if (count($saida) > 0) {
            $date = date_create($saida[0]->data);
            $antiga2 = $date;
            $date = date_format($date, 'Y-m');
            $antiga = $date;
            $anoAtual = Carbon::now();
            $anoAtual = $anoAtual->format('Y-m');
            foreach ($saida as $item) {
                $date = date_create($item->data);
                $date = date_format($date, 'Y-m');
                $atual = $date;
                while ($j == 0) {
                    if ($atual != $anoAtual) {
                        $i++;
                        $anoAtual = Carbon::parse($anoAtual)->addMonth()->format('Y-m');
                    } else {
                        $j++;
                    }
                }
                if ($atual == $antiga) {
                    $saidaAnual[$i] += $item->valor;
                } else if ($atual > $antiga) {
                    $date = date_create($item->data);
                    $atual2 = $date;
                    $atual2 = date_format($atual2, 'n');
                    $antiga2 = date_format($antiga2, 'n');
                    if ((intval($atual2) - intval($antiga2)) == 1 || (intval($atual2) - intval($antiga2)) == -11) {
                        $i++;
                    } else if ((intval($atual2) - intval($antiga2)) == 2 || (intval($atual2) - intval($antiga2)) == -10) {
                        $i += 2;
                    } else if ((intval($atual2) - intval($antiga2)) == 3 || (intval($atual2) - intval($antiga2)) == -9) {
                        $i += 3;
                    } else if ((intval($atual2) - intval($antiga2)) == 4 || (intval($atual2) - intval($antiga2)) == -8) {
                        $i += 4;
                    } else if ((intval($atual2) - intval($antiga2)) == 5 || (intval($atual2) - intval($antiga2)) == -7) {
                        $i += 5;
                    } else if ((intval($atual2) - intval($antiga2)) == 6 || (intval($atual2) - intval($antiga2)) == -6) {
                        $i += 6;
                    } else if ((intval($atual2) - intval($antiga2)) == 7 || (intval($atual2) - intval($antiga2)) == -5) {
                        $i += 7;
                    } else if ((intval($atual2) - intval($antiga2)) == 8 || (intval($atual2) - intval($antiga2)) == -4) {
                        $i += 8;
                    } else if ((intval($atual2) - intval($antiga2)) == 9 || (intval($atual2) - intval($antiga2)) == -3) {
                        $i += 9;
                    } else if ((intval($atual2) - intval($antiga2)) == 10 || (intval($atual2) - intval($antiga2)) == -2) {
                        $i += 10;
                    } else if ((intval($atual2) - intval($antiga2)) == 11 || (intval($atual2) - intval($antiga2)) == -1) {
                        $i += 11;
                    }
                    $saidaAnual[$i] += $item->valor;
                    $antiga = $atual;
                    $antiga2 = $date;
                }
            }
        }
        $dados = [$entradaAnual, $saidaAnual];

        return $dados;
    }
}
