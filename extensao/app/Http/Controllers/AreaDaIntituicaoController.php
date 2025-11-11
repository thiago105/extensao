<?php

namespace App\Http\Controllers;

use App\Models\Estoque_instituicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaDaIntituicaoController extends Controller
{
    public function index(){
        return view("areaDaInstituicao.index");
    }

    public function estoque()
    {
        $instituicaoId = Auth::guard('instituicao')->id();

        $estoques = Estoque_instituicao::with(['material', 'instituicao'])
            ->where('instituicaos_id', $instituicaoId)
            ->get();

        return view('areaDaInstituicao.estoque', compact('estoques'));
    }

    public function pedidosDeDoacao(){
        return view("areaDaInstituicao.pedidosDeDoacao");
    }    

    public function pontoDeColeta(){
        return view("areaDaInstituicao.pontoDeColeta");
    }  
    
    public function perfilInstituicao(){
        $instituicao = Auth::guard('instituicao')->user();
        
        return view("areaDaInstituicao.perfilInstituicao", compact('instituicao'));
    } 

    public function material()
{
    // busca os materiais cadastrados no banco
    $materiais = \App\Models\Material::all();

    // retorna a view que lista/cadastra materiais
    return view('areaDaInstituicao.material', compact('materiais'));
}


    // public function perfil(){
    //     return view("areaDaInstituicao.perfil");
    // }   
}
