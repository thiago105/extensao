<?php

namespace App\Http\Controllers;

use App\Models\Estoque_instituicao;
use App\Models\Material_doacao_recebida;
use App\Models\Material_pedido_de_doacao;
use App\Models\Pedido_de_doacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaDaIntituicaoController extends Controller
{
    public function index()
    { {
            $itensDoados = Material_doacao_recebida::sum('quantidade');
            $itensRecebidos = Material_pedido_de_doacao::sum('quantidade');

            return view('areaDaInstituicao.index', compact('itensDoados', 'itensRecebidos'));
        }
    }

    public function estoque()
    {
        $instituicaoId = Auth::guard('instituicao')->id();

        $estoques = Estoque_instituicao::with(['material', 'instituicao'])
            ->where('instituicaos_id', $instituicaoId)
            ->get();

        return view('areaDaInstituicao.estoque', compact('estoques'));
    }

    public function pedidosDeDoacao()
    {
        // Busca todos os pedidos com o usuário relacionado
        $pedidos = Pedido_de_doacao::with('usuario')
            ->orderBy('created_at', 'desc')
            ->get()
            ->partition('concluido'); // separa pendentes (false) e concluídos (true)

        return view('areaDaInstituicao.pedidosDeDoacao', [
            'pedidosPendentes' => $pedidos[1],
            'pedidosConcluidos' => $pedidos[0],
        ]);
    }
    public function pontoDeColeta()
    {
        return view("areaDaInstituicao.pontoDeColeta");
    }

    public function perfilInstituicao()
    {
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
