<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EstoqueInstituicaoController extends Controller
{
    public function create()
    {
        $instituicao = Auth::guard('instituicao')->id();

        $materiais = \App\Models\Material::all();

        return view('estoque.create', compact('materiais', 'instituicao'));
    }
}
