<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\Pedido_de_doacao;
use App\Models\Material_pedido_de_doacao;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PedidoDeDoacaoController extends Controller
{
    public function create()
    {
        $materiais = Material::all();

        return view('areaDoUsuario.solicitarDoacao', compact('materiais'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'observacao' => 'nullable|string|max:500',
            'endereco' => 'required|string|max:255',
            'itens' => 'required|array|min:1',
            'itens.*.material_id' => 'required|exists:material,id',
            'itens.*.quantidade' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $pedido = Pedido_de_doacao::create([
                'usuario_id' => Auth::id(),
                'observacao' => $validated['observacao'] ?? '',
                'endereco' => $validated['endereco'],
                'concluido' => false,
            ]);

            foreach ($request->itens as $item) {
                Material_pedido_de_doacao::create([
                    'pedido_de_doacao_id' => $pedido->id,
                    'material_id' => $item['material_id'],
                    'quantidade' => $item['quantidade'],
                ]);
            }

            DB::commit();

            return redirect()
                ->route('areaDoUsuario.solicitarDoacao')
                ->with('success', 'Pedido de coleta registrado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();


            return redirect()
                ->route('areaDoUsuario.solicitarDoacao')
                ->with('error', 'Houve um erro ao registrar seu pedido. Tente novamente.');
        }
    }
    public function cancelarPedidoUsuario($id)
    {
        $pedido = Pedido_de_doacao::findOrFail($id);

        if ($pedido->usuario_id !== Auth::id()) {
            abort(403, 'Ação não autorizada.');
        }

        Material_pedido_de_doacao::where('pedido_de_doacao_id', $id)->delete();
        $pedido->delete();

        return redirect()
            ->route('areaDoUsuario.meusPedidos')
            ->with('success', 'Pedido de doação cancelado com sucesso.');
    }
    public function index()
    {
        $pedidos = Pedido_de_doacao::with('usuario')
            ->orderBy('created_at', 'desc')
            ->get()
            ->partition('concluido');

        return view('areaDaInstituicao.pedidosDeDoacao', [
            'pedidosPendentes' => $pedidos[1],
            'pedidosConcluidos' => $pedidos[0]
        ]);
    }

    public function show($id)
    {
        $pedido = Pedido_de_doacao::with(['usuario', 'itensDoPedido.material'])->findOrFail($id);
        return view('pedidoDeDoacao.show', compact('pedido'));
    }

    public function concluir($id)
    {
        $pedido = Pedido_de_doacao::findOrFail($id);
        $pedido->update(['concluido' => true]);

        return redirect()
            ->route('areaDaInstituicao.pedidosDeDoacao')
            ->with('success', 'Pedido marcado como concluído!');
    }

    public function reabrir($id)
    {
        $pedido = Pedido_de_doacao::findOrFail($id);
        $pedido->update(['concluido' => false]);

        return redirect()
            ->route('areaDaInstituicao.pedidosDeDoacao')
            ->with('success', 'Pedido reaberto com sucesso!');
    }

    public function destroyInstituicao($id)
    {
        $pedido = Pedido_de_doacao::findOrFail($id);

        DB::beginTransaction();
        try {
            Material_pedido_de_doacao::where('pedido_de_doacao_id', $id)->delete();

            $pedido->delete();

            DB::commit();

            return redirect()
                ->route('areaDaInstituicao.pedidosDeDoacao')
                ->with('success', 'Pedido de doação excluído permanentemente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->route('areaDaInstituicao.pedidosDeDoacao')
                ->with('error', 'Erro ao excluir o pedido.');
        }
    }

    public function destroy($id)
    {
        $pedido = Pedido_de_doacao::findOrFail($id);

        $pedido->itensDoPedido()->delete();

        $pedido->delete();

        return redirect()->route('pedidosDeDoacao')
            ->with('success', 'Pedido e itens relacionados excluídos com sucesso.');
    }
}
