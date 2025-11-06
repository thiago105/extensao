<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instituicao;
use Illuminate\Support\Facades\Hash;

class InstituicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cadastroUsuario');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos campos obrigatórios
        $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:instituicaos,cnpj',
            'endereco' => 'required|string|max:255',
            'email' => 'required|email|unique:instituicaos,email',
            'senha' => 'required|string|min:6',
        ]);

        // Criação do registro
        $instituicao = new Instituicao();
        $instituicao->nome = $request->nome;
        $instituicao->cnpj = $request->cpf_cnpj;
        $instituicao->endereco = $request->endereco;
        $instituicao->email = $request->email;
        $instituicao->senha = Hash::make($request->senha);
        $instituicao->save();

        return redirect()->route('home')->with('success', 'Instituição cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
