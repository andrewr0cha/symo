<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class EditarController extends Controller
{
    public function usuario()
    {
        $user = User::find(auth()->user()->id);
        return Inertia::render('Usuario', ['user' => $user]);
    }

    public function alterarUsuario(Request $req)
    {
        if (auth()->user()->email != $req->email) {
            $req->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'usuario' => 'required|string|max:255'
            ]);
        } else if (auth()->user()->usuario != $req->usuario) {
            $req->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'usuario' => 'required|string|max:255|unique:users',
            ]);
        } else if (auth()->user()->email != $req->email && auth()->user()->usuario != $req->usuario) {
            $req->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'usuario' => 'required|string|max:255|unique:users',
            ]);
        }
        $user = User::find(auth()->user()->id);
        $user->usuario = $req->usuario;
        $user->email = $req->email;
        $user->name = $req->name;
        $user->foto = $req->foto;
        $user->update();
        return redirect()->route('dashboard');
    }
}
