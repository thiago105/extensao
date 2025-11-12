<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Material_doacao_recebida;
use App\Models\Material_pedido_de_doacao;
use App\Models\Doacao_recebida;
use App\Models\Pedido_de_doacao;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaDoUsuarioController extends Controller
{
    public function index()
    {
        $usuarioId = Auth::id(); // Pega o ID do usuário logado

        // Total que o usuário já doou
        $doacoesIds = Doacao_recebida::where('usuario_id', $usuarioId)->pluck('id');
        $itensDoados = Material_doacao_recebida::whereIn('doacao_recebida_id', $doacoesIds)->sum('quantidade');

        // Total que o usuário já recebeu (pedidos dele)
        $pedidosIds = Pedido_de_doacao::where('usuario_id', $usuarioId)->pluck('id');
        $itensRecebidos = Material_pedido_de_doacao::whereIn('pedido_de_doacao_id', $pedidosIds)->sum('quantidade');

        return view('areaDoUsuario.index', compact('itensDoados', 'itensRecebidos'));
    }

    public function dashboard()
    {
        return view("areaDoUsuario.dashboard");
    }

    public function pedidos()
    {
        return view("areaDoUsuario.pedidos");
    }

    public function perfilUsuario()
    {

        $usuario = Auth::user();

        return view("areaDoUsuario.perfilUsuario", compact("usuario"));
    }
    public function pontoDeColeta()
    {
        return view("areaDoUsuario.pontoDeColeta");
    }

    public function solicitarDoacao()
    {
        $materiais = Material::all();
        return view('areaDoUsuario.solicitarDoacao', compact('materiais'));
    }
}
