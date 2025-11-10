<?php

namespace App\Http\Controllers;

use App\Models\Doacao;
use App\Models\Instituicao;
use App\Models\Usuario;
use App\Models\ItensDoacao;
use App\Models\Mateirais_coletado;
use Illuminate\Http\Request;

class DoacaoController extends Controller
{
    public function index()
    {
        $doacoes = Doacao::with(['instituicao', 'usuario'])->get();
        return view('doacoes.index', compact('doacoes'));
    }

      public function create()
      {
          $instituicaos = Instituicao::all();
          $usuarios = Usuario::all();
          $mateirais_coletados = Mateirais_coletado::all();
  
          return view('doacoes.create', compact('instituicaos', 'usuarios', 'mateirais_coletados'));
      }

      public function store(Request $request)
      {
          $request->validate([
              'id_instituicao' => 'required|integer|exists:instituicaos,id',
              'id_usuario' => 'required|integer|exists:usuarios,id',
              'tipo' => 'required|string',
              'endereco_destino' => 'required_if:tipo,material|string',
              'data_prevista_entrega' => 'required_if:tipo,material|date',
              'id_material' => 'nullable|integer|exists:mateirais_coletados,id',
              'quantidade' => 'nullable|integer|min:1',
          ]);

          $doacao = Doacao::create([
              'id_instituicao' => $request->id_instituicao,
              'id_usuario' => $request->id_usuario,
              'tipo' => $request->tipo,
              'endereco_destino' => $request->input('endereco_destino'),
              'data_prevista_entrega' => $request->input('data_prevista_entrega'),
              'status' => 'Pendente',
          ]);
            if ($request->tipo === 'mateirais_coletados' && $request->id_mateirais_coletados && $request->quantidade) {
              $doacao->itens()->create([
                  'id_mateirais_coletados' => $request->id_mateirais_coletados,
                  'quantidade' => $request->quantidade,
              ]);
          }
  
          return redirect()->route('doacoes.index')->with('success', 'Doação registrada com sucesso!');
      }
}
