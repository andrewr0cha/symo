<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use DateTime;

class TrabalhoController extends Controller
{
    public function index(){
        return Inertia::render('Trabalho');
    }
}
