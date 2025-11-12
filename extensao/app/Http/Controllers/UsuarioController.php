<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuario.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuario.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'genero' => 'required|string',
            'cpf' => 'required|string|max:14|unique:usuarios,cpf',
            'data_de_nascimento' => 'required|date',
            'telefone' => 'required|string|max:20|unique:usuarios,telefone',
            'endereco' => 'required|string|max:255',
            'senha' => 'required|string|min:6',
        ], [
            'telefone.unique' => 'Este telefone já está cadastrado',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
        ]);

        Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'genero' => $request->genero,
            'cpf' => $request->cpf,
            'data_de_nascimento' => $request->data_de_nascimento,
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
            'password' => Hash::make($request->senha),
        ]);

        return redirect()->route('home')->with('success', 'Estudante cadastrado com sucesso!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuario.edit', compact('usuario'));
    }

    public function update(Request $request, string $id)
    {
        if (Auth::id() != $id) {
            return redirect()->back()->with('error', 'Acesso negado.');
        }

        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
            'genero' => 'required',
            'cpf' => 'required|string|max:14|unique:usuarios,cpf,' . $usuario->id,
            'data_de_nascimento' => 'required|date',
            'telefone' => 'required|string|max:20|unique:usuarios,telefone,' . $usuario->id,
            'endereco' => 'required|string|max:200',
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'email.unique' => 'Este e-mail já está em uso.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'telefone.unique' => 'Este telefone já está cadastrado.',
        ]);

        $dados = $request->except('password', 'password_confirmation');

        if ($request->filled('password')) {
            $dados['password'] = Hash::make($request->password);
        }

        $usuario->update($dados);

        return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        if (Auth::id() != $id) {
            return redirect()->back()->with('error', 'Acesso negado.');
        }

        $usuario = Usuario::findOrFail($id);

        Auth::logout();
        $usuario->delete();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Sua conta foi excluída com sucesso.');
    }
}
