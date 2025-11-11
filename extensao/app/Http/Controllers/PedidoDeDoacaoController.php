<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\Pedido_de_doacao;
// ADICIONE ESTES DOIS 'USE'
use App\Models\Material_pedido_de_doacao; // O model para a tabela 'material-pedido-de-doacao'
use Illuminate\Support\Facades\DB;       // Para usar transações
use Illuminate\Support\Facades\Auth;

class PedidoDeDoacaoController extends Controller
{

    public function create()
    {
        // Busca todos os materiais cadastrados
        $materiais = Material::all();

        // Retorna para a view, com a variável $materiais disponível
        return view('areaDoUsuario.solicitarDoacao', compact('materiais'));
    }

    /**
     * MÉTODO STORE ATUALIZADO
     */
    public function store(Request $request)
    {
        // Validação atualizada para incluir os itens
        $validated = $request->validate([
            'observacao' => 'nullable|string|max:500',
            'endereco'   => 'required|string|max:255',
            'itens'      => 'required|array|min:1', // Pelo menos 1 item
            'itens.*.material_id' => 'required|exists:material,id',
            'itens.*.quantidade'  => 'required|integer|min:1',
        ]);

        // Inicia uma transação: se algo falhar, nada é salvo.
        DB::beginTransaction();

        try {
            // 1. Cria o pedido principal
            $pedido = Pedido_de_doacao::create([
                'usuario_id' => Auth::id(),
                'observacao' => $validated['observacao'] ?? '',
                'endereco'   => $validated['endereco'],
                'concluido'  => false,
            ]);

            // 2. Salva os itens do pedido
            foreach ($request->itens as $item) {
                Material_pedido_de_doacao::create([
                    'pedido_de_doacao_id' => $pedido->id,
                    'material_id'         => $item['material_id'],
                    'quantidade'          => $item['quantidade'],
                ]);
            }
            
            // 3. Sucesso! Salva tudo no banco.
            DB::commit();

            return redirect()
                ->route('areaDoUsuario.solicitarDoacao')
                ->with('success', 'Pedido de coleta registrado com sucesso!');

        } catch (\Exception $e) {
            // 4. Falha! Desfaz todas as operações.
            DB::rollBack();

            return redirect()
                ->route('areaDoUsuario.solicitarDoacao')
                ->with('error', 'Houve um erro ao registrar seu pedido. Tente novamente.');
        }
    }

    public function destroy($id)
    {
        $pedido = Pedido_de_doacao::findOrFail($id);

        if ($pedido->usuario_id !== Auth::id()) {
            abort(403, 'Ação não autorizada.');
        }

        // Antes de deletar o pedido, é uma boa prática
        // deletar os itens associados a ele.
        Material_pedido_de_doacao::where('pedido_de_doacao_id', $id)->delete();

        $pedido->delete();

        return redirect()
            // Corrigindo o nome da rota (estava com hífen)
            ->route('areaDoUsuario.solicitarDoacao') 
            ->with('success', 'Pedido de doação cancelado com sucesso.');
    }
}