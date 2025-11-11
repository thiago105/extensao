<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaDoUsuarioController extends Controller
{
    public function index(){
        return view("areaDoUsuario.index");
    }

    public function solicitarDoacao(){
        return view("areaDoUsuario.solicitarDoacao");
    }

    public function dashboard(){
        return view("areaDoUsuario.dashboard");
    }

    public function pedidos(){
        return view("areaDoUsuario.pedidos");
    }

    public function perfilUsuario(){
        
        $usuario = Auth::user();

        return view("areaDoUsuario.perfilUsuario", compact("usuario"));
    }
    public function pontoDeColeta(){
        return view("areaDoUsuario.pontoDeColeta");
    }
}
