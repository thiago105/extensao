@extends('layouts.areaInstituicao')

@section('content')
<style>
    /* Estilos dos botões (Mantidos conforme seu pedido) 
    */
    .btn-novo-ponto {
        background-color: var(--cor-sucesso);
        color: var(--cor-branco);
        border: none;
        font-weight: 500;
    }
    .btn-novo-ponto:hover {
        background-color: #255a42; 
        color: var(--cor-branco);
    }

    .btn-editar-ponto {
        background-color: var(--cor-secundaria);
        color: var(--cor-branco);
        border: none;
    }
    .btn-editar-ponto:hover {
        background-color: #c97f60;
        color: var(--cor-branco);
    }

    .btn-excluir-ponto {
        background-color: var(--cor-erro-falha);
        color: var(--cor-branco);
        border: none;
    }
    .btn-excluir-ponto:hover {
        background-color: #b02121; 
        color: var(--cor-branco);
    }

    .btn-reativar-ponto {
        background-color: var(--cor-terciaria);
        color: var(--cor-preto);
        border: none;
    }
    .btn-reativar-ponto:hover {
        background-color: #7abdaf;
        color: var(--cor-preto);
    }

    /* Estilos de alinhamento dos botões (Mantidos) */
    .action-buttons form {
        display: inline-block;
        margin-left: 5px;
    }
    .action-buttons a {
        display: inline-block;
    }
</style>

<div class="container-fluid">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gerenciar Pontos de Coleta</h1>
        
        <a href="{{ route('areaDaInstituicao.pontoDeColeta.create') }}" class="btn btn-novo-ponto shadow-sm">
            <i class="bi bi-plus-circle me-1"></i>
            Novo Ponto de Coleta
        </a>
    </div>

    <div class="card shadow mb-4">
        
        <div class="card-header py-3">
            <h6 class="m-0 fw-bold" style="color: var(--cor-primaria);">Pontos Ativos</h6>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Endereço</th>
                            <th>Data Início</th>
                            <th>Data Fim</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pontosAtivos as $ponto)
                            <tr>
                                <td>{{ $ponto->id }}</td>
                                <td>{{ $ponto->endereco }}</td>
                                <td>{{ $ponto->data_inicio->format('d/m/Y') }}</td>
                                <td>
                                    {{ $ponto->data_fim ? $ponto->data_fim->format('d/m/Y') : 'Indeterminado' }}
                                </td>
                                <td class="text-center action-buttons">
                                    <a href="{{ route('areaDaInstituicao.pontoDeColeta.edit', $ponto->id) }}" class="btn btn-editar-ponto btn-sm" title="Editar">
                                        <i class="bi bi-pencil-fill"></i> Editar
                                    </a>
                                    
                                    {{-- 
                                        MUDANÇA 1: 
                                        - Adicionado ID ao formulário.
                                        - Removido o 'onsubmit'.
                                    --}}
                                    <form id="form-excluir-{{ $ponto->id }}" action="{{ route('areaDaInstituicao.pontoDeColeta.destroy', $ponto->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        
                                        {{-- 
                                            MUDANÇA 2: 
                                            - Trocado 'type="submit"' para 'type="button"'.
                                            - Adicionadas classes e atributos 'data-*' para controlar o modal.
                                        --}}
                                        <button type="button" 
                                                class="btn btn-excluir-ponto btn-sm" 
                                                title="Excluir"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#confirmationModal"
                                                data-modal-title="Confirmar Exclusão"
                                                data-modal-body="Tem certeza que deseja excluir este ponto de coleta? Esta ação não pode ser desfeita."
                                                data-modal-button-text="Sim, excluir ponto"
                                                data-modal-button-class="btn-excluir-ponto"
                                                data-form-target="#form-excluir-{{ $ponto->id }}">
                                            <i class="bi bi-trash-fill"></i> Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Nenhum ponto de coleta ativo no momento.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        
        <div class="card-header py-3">
            <h6 class="m-0 fw-bold" style="color: var(--cor-primaria);">Pontos Finalizados</h6>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Endereço</th>
                            <th>Data Início</th>
                            <th>Data Fim</th>
                            <th class="text-center">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pontosFinalizados as $ponto)
                            <tr>
                                <td>{{ $ponto->id }}</td>
                                <td>{{ $ponto->endereco }}</td>
                                <td>{{ $ponto->data_inicio->format('d/m/Y') }}</td>
                                <td>{{ $ponto->data_fim->format('d/m/Y') }}</td>
                                <td class="text-center action-buttons">
                                    <a href="{{ route('areaDaInstituicao.pontoDeColeta.edit', $ponto->id) }}" class="btn btn-reativar-ponto btn-sm" title="Reativar">
                                        <i class="bi bi-arrow-clockwise"></i> Reativar
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Nenhum ponto de coleta finalizado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div> {{-- 
    MUDANÇA 3: HTML DO MODAL
    - Adicionado o HTML para o modal de confirmação genérico.
--}}
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmar Ação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Você tem certeza que deseja realizar esta ação?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn" id="btn-confirm-modal-action">Confirmar</button>
            </div>
        </div>
    </div>
</div>


{{-- 
    MUDANÇA 4: JAVASCRIPT
    - Adicionado script para lidar com a lógica do modal.
--}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        const confirmationModal = document.getElementById('confirmationModal');
        let formToSubmit = null; 

        const confirmButton = document.getElementById('btn-confirm-modal-action');

        confirmationModal.addEventListener('show.bs.modal', function (event) {
            
            const button = event.relatedTarget; 

            const modalTitle = button.dataset.modalTitle;
            const modalBody = button.dataset.modalBody;
            const modalButtonText = button.dataset.modalButtonText;
            const modalButtonClass = button.dataset.modalButtonClass;
            
            const formTargetSelector = button.dataset.formTarget;
            formToSubmit = document.querySelector(formTargetSelector);

            confirmationModal.querySelector('.modal-title').textContent = modalTitle;
            confirmationModal.querySelector('.modal-body').textContent = modalBody;
            
            confirmButton.textContent = modalButtonText;
            
            confirmButton.className = 'btn'; 
            confirmButton.classList.add(modalButtonClass); 
        });

        confirmButton.addEventListener('click', function () {
            if (formToSubmit) {
                formToSubmit.submit();
            }
        });

    });
</script>

@endsection