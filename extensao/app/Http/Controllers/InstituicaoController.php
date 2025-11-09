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
        $instituicaos = Instituicao::all();
        return view('instituicao.index', compact('instituicaos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = \App\Models\Usuario::all();
        return view('instituicao.create', compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:instituicaos,email',
            'password' => 'required|string|min:6',
            'cnpj' => 'required|string|max:14|unique:instituicaos,cnpj',
            'endereco' => 'required|string|max:200',
        ]);

        Instituicao::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'cnpj' => $request->cnpj,
            'endereco' => $request->endereco,
        ]);

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
        $instituicao = Instituicao::findOrFail($id);
        return view('instituicao.edit', compact('instituicao'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $instituicao = Instituicao::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:instituicaos,email,' . $instituicao->id,
            'password' => 'nullable|string|min:6',
            'cnpj' => 'required|string|max:14|unique:instituicaos,cnpj,' . $instituicao->id,
            'endereco' => 'required|string|max:200',
        ]);

        $dados = $request->all();

        // Atualiza a senha apenas se o campo for preenchido
        if (!empty($request->password)) {
            $dados['password'] = bcrypt($request->password);
        } else {
            unset($dados['password']);
        }

        $instituicao->update($dados);

        return redirect()->route('instituicao.index')->with('success', 'Instituição atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $instituicao = Instituicao::findOrFail($id);
        $instituicao->delete();

        return redirect()->route('instituicao.index')->with('success', 'Instituição excluída com sucesso!');
    }
}
