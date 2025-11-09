<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mateirais_coletado;
use App\Models\Instituicao;

class Mateirais_coletadoController extends Controller
{
    public function index()
    {
        $itens = \App\Models\Mateirais_coletado::with('instituicao')->get();
        return view('mateirais_coletado.index', compact('itens'));
    }
    
    public function create()
    {
        $instituicaos = Instituicao::all();
        return view('mateirais_coletado.create', compact('instituicaos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_instituicao' => 'required|integer|exists:instituicaos,id',
            'material' => 'required|string|max:100',
            'condicao' => 'required|string|max:50',
            'quantidade' => 'required|integer|min:1',
        ]);

        Mateirais_coletado::create($request->all());

        return redirect()->route('mateirais_coletado.index')
                         ->with('success', 'Material cadastrado com sucesso!');
    }
}
