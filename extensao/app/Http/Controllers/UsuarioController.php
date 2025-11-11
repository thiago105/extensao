<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuario.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos campos obrigatórios
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'genero' => 'required|string',
            'cpf' => 'required|string|max:14|unique:usuarios,cpf',
            'data_de_nascimento' => 'required|date',
            'telefone' => 'required|string|max:20',
            'endereco' => 'required|string|max:255',
            'senha' => 'required|string|min:6',
        ]);

        // Criação do registro
        $usuario = new Usuario();
        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->genero = $request->genero;
        $usuario->cpf = $request->cpf;
        $usuario->data_de_nascimento = $request->data_de_nascimento;
        $usuario->telefone = $request->telefone;
        $usuario->endereco = $request->endereco;
        $usuario->password = Hash::make($request->senha);
        $usuario->save();

        // Redirecionamento com mensagem
        return redirect()->route('home')->with('success', 'Estudante cadastrado com sucesso!');
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
        $usuario = Usuario::findOrFail($id);
        return view('usuario.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
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
            'telefone' => 'required|string|max:20',
            'endereco' => 'required|string|max:200',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $dados = $request->except('password', 'password_confirmation');

        if ($request->filled('password')) {
            $dados['password'] = Hash::make($request->password);
        }

        $usuario->update($dados);

        return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::id() != $id) {
            return redirect()->back()->with('error', 'Acesso negado.');
        }

        $usuario = Usuario::findOrFail($id);

        // deloga quando esta apagando
        Auth::logout();

        $usuario->delete();


        request()->session()->invalidate();
        request()->session()->regenerateToken();


        return redirect()->route('home')->with('success', 'Sua conta foi excluída com sucesso.');
    }
}
