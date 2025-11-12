<?php

namespace App\Http\Controllers;

// Imports necessários
use App\Models\Estoque_instituicao;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule; // Importar a classe Rule para validação

class EstoqueInstituicaoController extends Controller
{
    /**
     * Exibe uma lista dos itens em estoque da instituição logada.
     */
    public function index()
    {
        $instituicaoId = Auth::guard('instituicao')->id();

        if (!$instituicaoId) {
            return redirect()->route('login.instituicao')->withErrors('Você precisa estar logado como uma instituição.');
        }

        // Busca os itens de estoque da instituição logada
        // 'with('material')' carrega os dados do material relacionado para exibir o nome na view
        $estoqueItens = Estoque_instituicao::where('instituicao_id', $instituicaoId)
                                            ->with('material')
                                            ->get();

        // CORREÇÃO:
        // O log de erro mostra que sua view está em 'areaDaInstituicao.estoque'
        // e não 'estoque.index'.
        // Alterando para enviar os dados para a view correta.
        return view('areaDaInstituicao.estoque', compact('estoqueItens'));
    }

    /**
     * Mostra o formulário para criar um novo item de estoque.
     * (Este é o método que você forneceu)
     */
    public function create()
    {
        $instituicao = Auth::guard('instituicao')->id();

        // Busca todos os materiais para popular o <select> no formulário
        $materiais = \App\Models\Material::all();

        // Passa os materiais e o ID da instituição para a view
        return view('estoque.create', compact('materiais', 'instituicao'));
    }

    /**
     * Armazena um novo item de estoque no banco de dados.
     */
    public function store(Request $request)
    {
        $instituicaoId = Auth::guard('instituicao')->id();

        $request->validate([
            'material_id' => [
                'required',
                'exists:materials,id', // Garante que o material_id exista na tabela 'materials'
                // Garante que o material seja único PARA ESTA instituição
                // Usa o nome da tabela que você definiu no Model: 'estoque_instituicaos'
                Rule::unique('estoque_instituicaos')->where(function ($query) use ($instituicaoId) {
                    return $query->where('instituicao_id', $instituicaoId);
                }),
            ],
            'quantidade' => 'required|integer|min:0',
        ], [
            'material_id.required' => 'O campo material é obrigatório.',
            'material_id.exists' => 'O material selecionado não é válido.',
            'material_id.unique' => 'Este material já existe no seu estoque. Edite o item existente.',
            'quantidade.required' => 'O campo quantidade é obrigatório.',
            'quantidade.integer' => 'A quantidade deve ser um número inteiro.',
            'quantidade.min' => 'A quantidade não pode ser negativa.',
        ]);


        Estoque_instituicao::create([
            'instituicao_id' => $instituicaoId,
            'material_id' => $request->material_id,
            'quantidade' => $request->quantidade,
        ]);

        // Redireciona de volta para a lista de estoque
        return redirect()->route('estoque.index')->with('success', 'Item adicionado ao estoque com sucesso!');
    }

    /**
     * Mostra o formulário para editar um item de estoque.
     * (Necessário para o botão 'Editar' na view index)
     */
    public function edit($id)
    {
        $instituicaoId = Auth::guard('instituicao')->id();

        // Busca o item, garantindo que ele pertence à instituição logada
        $itemEstoque = Estoque_instituicao::where('id', $id)
                                         ->where('instituicao_id', $instituicaoId)
                                         ->firstOrFail(); // Falha se não encontrar ou não pertencer

        // Carrega o material relacionado para exibir o nome
        $itemEstoque->load('material');

        return view('estoque.edit', compact('itemEstoque'));
    }

    /**
     * Atualiza um item de estoque no banco de dados.
     * (Necessário para o formulário de edição)
     */
    public function update(Request $request, $id)
    {
        $instituicaoId = Auth::guard('instituicao')->id();

        $itemEstoque = Estoque_instituicao::where('id', $id)
                                         ->where('instituicao_id', $instituicaoId)
                                         ->firstOrFail();

        $request->validate([
            'quantidade' => 'required|integer|min:0',
        ], [
            'quantidade.required' => 'O campo quantidade é obrigatório.',
            'quantidade.integer' => 'A quantidade deve ser um número inteiro.',
            'quantidade.min' => 'A quantidade não pode ser negativa.',
        ]);

        $itemEstoque->update([
            'quantidade' => $request->quantidade,
        ]);

        return redirect()->route('estoque.index')->with('success', 'Estoque atualizado com sucesso!');
    }

    /**
     * Remove um item de estoque do banco de dados.
     * (Necessário para o botão 'Excluir' na view index)
     */
    public function destroy($id)
    {
        $instituicaoId = Auth::guard('instituicao')->id();

        $itemEstoque = Estoque_instituicao::where('id', $id)
                                         ->where('instituicao_id', $instituicaoId)
                                         ->firstOrFail();

        $itemEstoque->delete();

        return redirect()->route('estoque.index')->with('success', 'Item removido do estoque com sucesso!');
    }

    /**
     * Método 'estoque' que estava na sua rota 'areaDaInstituicao.estoque'.
     * Apenas redireciona para o 'index' para manter a consistência.
     */
    public function estoque()
    {
        return $this->index();
    }
}