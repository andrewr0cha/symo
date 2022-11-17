<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GrupoController extends Controller
{
    public function download()
    {
        $file = public_path() . "/download/HELP.pdf";
        $headers = [
            'Content-Type' => 'application/pdf',
        ];
        return response()->download($file, 'HELP.pdf', $headers);
    }
}
