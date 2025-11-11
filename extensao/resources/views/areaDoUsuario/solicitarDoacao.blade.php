@extends('layouts.areaUsuario')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            {{-- Título atualizado para "Recebimento" --}}
            <h1 class="h3 mb-3">Solicitar Doação (Recebimento)</h1>
        </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Opa!</strong> Há algo errado:
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
    @endif

    <div class="row">

        <div class="col-12 col-lg-10 mb-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    {{-- Título do Card atualizado --}}
                    <h5 class="mb-0 card-title">Informações para Recebimento</h5>
                </div>
                <div class="card-body">

                    {{-- Texto de instrução atualizado --}}
                    <p class="card-text">Preencha seu endereço e informe os materiais que você precisa receber.</p>

                    {{-- A rota 'pedido.store' vai receber todos esses dados --}}
                    <form action="{{ route('pedido.store') }}" method="POST">
                        @csrf

                        {{-- Esta seção preenche a tabela 'pedido-de-doacao' --}}
                        <h5 class="mb-3">Seus Dados</h5>
                        <div class="row g-3">
                            <div class="col-md-12">
                                {{-- Label atualizada --}}
                                <label for="endereco" class="form-label">Endereço de Entrega</label>
                                <input type="text" id="endereco" name="endereco"
                                    class="form-control @error('endereco') is-invalid @enderror"
                                    value="{{ old('endereco', auth()->user()->endereco ?? '') }}"
                                    placeholder="Seu endereço completo"
                                    required>
                                @error('endereco')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="observacao" class="form-label">Observações (Itens fora da lista)</label>
                                <textarea id="observacao" name="observacao"
                                    class="form-control @error('observacao') is-invalid @enderror"
                                    rows="3"
                                    placeholder="Ex: Preciso de Roupas tamanho M, Comida não perecível...">{{ old('observacao') }}</textarea>
                                @error('observacao')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                {{-- Texto de ajuda adicionado conforme sua instrução --}}
                                <div class="form-text">
                                    Use este campo para pedir itens que não estão na lista (ex: Roupas, Comida, Móveis).
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Esta seção preenche a tabela 'material-pedido-de-doacao' --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            {{-- Título atualizado --}}
                            <h5 class="mb-0">Itens da Lista (Materiais)</h5>
                            <button type="button" id="btn-adicionar-item" class="btn btn-sm btn-secondary">
                                + Adicionar Item
                            </button>
                        </div>

                        <div id="itens-doacao-wrapper">
                            <div class="row g-3 align-items-center mb-2 item-doacao-row">
                                <div class="col-7">
                                    <label class="form-label visually-hidden">Material</label>
                                    <select name="itens[0][material_id]" class="form-select" required>
                                        <option value="" disabled selected>Selecione um material</option>
                                        @if(isset($materiais))
                                        @foreach($materiais as $material)
                                        <option value="{{ $material->id }}">{{ $material->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label class="form-label visually-hidden">Quantidade</label>
                                    <input type="number" name="itens[0][quantidade]" class="form-control"
                                        placeholder="Qtd." min="1" required>
                                </div>
                                <div class="col-2">
                                    {{-- O primeiro item não pode ser removido --}}
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary">
                                {{-- Texto do botão atualizado --}}
                                Confirmar Pedido
                            </button>
                            <a href="{{ route('areaDoUsuario.index') }}" class="btn btn-secondary ms-2">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{--
    Template para o JavaScript copiar.
    O nome 'itens[__INDEX__][...]' é lido pelo Laravel como um array.
--}}
<template id="template-item-doacao">
    <div class="row g-3 align-items-center mb-2 item-doacao-row">
        <div class="col-7">
            <select name="itens[__INDEX__][material_id]" class="form-select" required>
                <option value="" disabled selected>Selecione um material</option>
                @if(isset($materiais))
                @foreach($materiais as $material)
                <option value="{{ $material->id }}">{{ $material->name }}</option>
                @endforeach
                @endif
            </select>
        </div>
        <div class="col-3">
            <input type="number" name="itens[__INDEX__][quantidade]" class="form-control"
                placeholder="Qtd." min="1" required>
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-outline-danger btn-remover-item">
                &times;
            </button>
        </div>
    </div>
</template>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const btnAdicionar = document.getElementById('btn-adicionar-item');
        const wrapper = document.getElementById('itens-doacao-wrapper');
        const template = document.getElementById('template-item-doacao');
        let itemIndex = 1; // Começa em 1 porque o item 0 já está na página

        btnAdicionar.addEventListener('click', function() {
            const novoItem = template.content.cloneNode(true);
            const novoHtml = novoItem.innerHTML.replace(/__INDEX__/g, itemIndex);

            const novoElemento = document.createElement('div');
            novoElemento.innerHTML = novoHtml;

            novoElemento.querySelector('.btn-remover-item').addEventListener('click', function(e) {
                // Encontra o elemento pai (o 'div' com a classe 'row') e o remove
                e.target.closest('.item-doacao-row').parentElement.remove();
            });

            // Adiciona o 'div' que contém o 'row'
            wrapper.appendChild(novoElemento);

            itemIndex++;
        });

    });
</script>
@endsection