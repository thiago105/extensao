<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AreaDaIntituicaoController extends Controller
{
    public function index(){
        return view("areaDaInstituicao.index");
    }

    public function estoque(){
        return view("areaDaInstituicao.estoque");
    }

    public function pedidosDeDoacao(){
        return view("areaDaInstituicao.pedidosDeDoacao");
    }    

    public function pontoDeColeta(){
        return view("areaDaInstituicao.pontoDeColeta");
    }  
    
    public function perfilInstituicao(){
        return view("areaDaInstituicao.perfilInstituicao");
    } 

    // public function perfil(){
    //     return view("areaDaInstituicao.perfil");
    // }   
}
