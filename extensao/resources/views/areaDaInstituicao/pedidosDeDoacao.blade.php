@extends('layouts.areaInstituicao')

@section('content')
<style>
    .btn-concluir-pedido {
        background-color: var(--cor-sucesso);
        color: var(--cor-branco);
        border: none;
        font-weight: 500;
    }
    .btn-concluir-pedido:hover {
        background-color: #255a42; 
        color: var(--cor-branco);
    }

    .btn-detalhes-pedido {
        background-color: var(--cor-secundaria);
        color: var(--cor-branco);
        border: none;
    }
    .btn-detalhes-pedido:hover {
        background-color: #c97f60;
        color: var(--cor-branco);
    }

    .btn-excluir-pedido {
        background-color: var(--cor-erro-falha);
        color: var(--cor-branco);
        border: none;
    }
    .btn-excluir-pedido:hover {
        background-color: #b02121; 
        color: var(--cor-branco);
    }

    .btn-reabrir-pedido {
        background-color: var(--cor-terciaria);
        color: var(--cor-preto);
        border: none;
    }
    .btn-reabrir-pedido:hover {
        background-color: #7abdaf;
        color: var(--cor-preto);
    }

    .action-buttons form {
        display: inline-block;
        margin: 4px;
    }
    .action-buttons a {
        display: inline-block;
        margin: 4px;
    }

    .card-pedido {
        transition: all 0.2s ease-in-out;
    }
    .card-pedido:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15)!important;
    }
    .card-pedido .card-body {
        padding-bottom: 0.5rem;
    }
    .card-pedido .card-text i {
        width: 20px;
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
        <h1 class="h3 mb-0 text-gray-800">Gerenciar Pedidos de Doação</h1>
    </div>

    <div class="mb-4">
        <h2 class="h5 mb-3 text-gray-800">Pedidos Pendentes</h2>
        
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
            @forelse ($pedidosPendentes as $pedido)
                <div class="col">
                    <div class="card h-100 shadow-sm card-pedido border-start-warning">
                        <div class="card-body">
                            <h5 class="card-title fw-bold" style="color: var(--cor-primaria);">
                                Pedido #{{ $pedido->id }}
                            </h5>
                            <p class="card-text mb-2">
                                <i class="bi bi-person me-2"></i>
                                <strong>Nome:</strong> {{ $pedido->usuario->nome ?? 'Usuário não encontrado' }}
                            </p>
                            <p class="card-text mb-2">
                                <i class="bi bi-geo-alt me-2"></i>
                                <strong>Endereço:</strong> {{ $pedido->endereco }}
                            </p>
                            <p class="card-text mb-2 text-truncate" title="{{ $pedido->observacao }}">
                                <i class="bi bi-chat-left-text me-2"></i>
                                <strong>Obs:</strong> {{ $pedido->observacao ?? 'Nenhuma.' }}
                            </p>
                            <p class="card-text text-muted small">
                                <i class="bi bi-calendar-event me-2"></i>
                                Solicitado em: {{ $pedido->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                        <div class="card-footer bg-light border-0 action-buttons text-center pt-2">
                            
                            <a href="{{ route('pedidoDeDoacao.show', $pedido->id) }}" class="btn btn-detalhes-pedido btn-sm" title="Ver Detalhes">
                                <i class="bi bi-eye-fill"></i> Detalhes
                            </a>
                            
                            <form id="form-concluir-{{ $pedido->id }}" action="{{ route('pedidoDeDoacao.concluir', $pedido->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                
                                <button type="button" 
                                        class="btn btn-concluir-pedido btn-sm" 
                                        title="Concluir"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#confirmationModal"
                                        data-modal-title="Confirmar Conclusão"
                                        data-modal-body="Tem certeza que deseja marcar este pedido como concluído?"
                                        data-modal-button-text="Sim, concluir pedido"
                                        data-modal-button-class="btn-concluir-pedido"
                                        data-form-target="#form-concluir-{{ $pedido->id }}">
                                    <i class="bi bi-check-circle-fill"></i> Concluir
                                </button>
                            </form>

                            <form id="form-excluir-{{ $pedido->id }}" action="{{ route('pedidoDeDoacao.destroy', $pedido->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                
                                <button type="button" 
                                        class="btn btn-excluir-pedido btn-sm" 
                                        title="Excluir"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#confirmationModal"
                                        data-modal-title="Confirmar Exclusão"
                                        data-modal-body="Tem certeza que deseja excluir este pedido? Esta ação não pode ser desfeita e todos os dados relacionados serão removidos."
                                        data-modal-button-text="Sim, excluir este pedido"
                                        data-modal-button-class="btn-excluir-pedido"
                                        data-form-target="#form-excluir-{{ $pedido->id }}">
                                    <i class="bi bi-trash-fill"></i> Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        Nenhum pedido de doação pendente no momento.
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <div class="mb-4">
        <h2 class="h5 mb-3 text-gray-800">Pedidos Concluídos</h2>
        
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
            @forelse ($pedidosConcluidos as $pedido)
                <div class="col">
                    <div class="card h-100 shadow-sm card-pedido border-start-success">
                        <div class="card-body text-muted">
                            <h5 class="card-title fw-bold text-muted">
                                Pedido #{{ $pedido->id }}
                            </h5>
                            <p class="card-text mb-2">
                                <i class="bi bi-person me-2"></i>
                                <strong>Nome:</strong> {{ $pedido->usuario->nome ?? 'Usuário não encontrado' }}
                            </p>
                            <p class="card-text mb-2">
                                <i class="bi bi-geo-alt me-2"></i>
                                <strong>Endereço:</strong> {{ $pedido->endereco }}
                            </p>
                            <p class="card-text small">
                                <i class="bi bi-calendar-event me-2"></i>
                                Solicitado em: {{ $pedido->created_at->format('d/m/Y H:i') }}
                            </p>
                            <p class="card-text small text-success fw-bold">
                                <i class="bi bi-calendar-check me-2"></i>
                                Concluído em: {{ $pedido->updated_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                        <div class="card-footer bg-light border-0 action-buttons text-center pt-2">
                            
                            <form id="form-reabrir-{{ $pedido->id }}" action="{{ route('pedidoDeDoacao.reabrir', $pedido->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                
                                <button type="button" 
                                        class="btn btn-reabrir-pedido btn-sm" 
                                        title="Reabrir Pedido"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#confirmationModal"
                                        data-modal-title="Confirmar Reabertura"
                                        data-modal-body="Tem certeza que deseja reabrir este pedido? Ele voltará para a lista de pendentes."
                                        data-modal-button-text="Sim, reabrir pedido"
                                        data-modal-button-class="btn-reabrir-pedido"
                                        data-form-target="#form-reabrir-{{ $pedido->id }}">
                                    <i class="bi bi-arrow-clockwise"></i> Reabrir
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-secondary">
                        Nenhum pedido de doação concluído.
                    </div>
                </div>
            @endforelse
        </div>
    </div>

</div>
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