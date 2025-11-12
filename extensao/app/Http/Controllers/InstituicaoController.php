<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instituicao;
use Illuminate\Support\Facades\Hash;

class InstituicaoController extends Controller
{
    public function index()
    {
        $instituicoes = Instituicao::all();
        return view('instituicao.index', compact('instituicoes'));
    }

    public function create()
    {
        return view('instituicao.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:instituicaos,email',
            'password' => 'required|string|min:6',
            'cnpj' => 'required|string|max:18|unique:instituicaos,cnpj',
            'endereco' => 'required|string|max:200',
        ], [
            'email.unique' => 'Este e-mail já está cadastrado.',
            'cnpj.unique' => 'Este CNPJ já está cadastrado.',
        ]);

        Instituicao::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'cnpj' => $request->cnpj,
            'endereco' => $request->endereco,
        ]);

        return redirect()->route('login.instituicao')->with('success', 'Instituição cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $instituicao = Instituicao::findOrFail($id);
        return view('instituicao.edit', compact('instituicao'));
    }

    public function update(Request $request, $id)
    {
        $instituicao = Instituicao::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:instituicaos,email,' . $instituicao->id,
            'password' => 'nullable|string|min:6|confirmed',
            'cnpj' => 'required|string|max:18|unique:instituicaos,cnpj,' . $instituicao->id,
            'endereco' => 'required|string|max:200',
        ], [
            'email.unique' => 'Este e-mail já está em uso.',
            'cnpj.unique' => 'Este CNPJ já está em uso.',
        ]);

        $dados = $request->except(['password', 'password_confirmation']);
        if (!empty($request->password)) {
            $dados['password'] = bcrypt($request->password);
        }

        $instituicao->update($dados);

        return redirect()->route('areaDaInstituicao.perfilInstituicao')->with('success', 'Dados atualizados com sucesso!');
    }

    public function destroy($id)
    {
        $instituicao = Instituicao::findOrFail($id);
        $instituicao->delete();
        return redirect('/')->with('success', 'Conta excluída com sucesso!');
    }
}
