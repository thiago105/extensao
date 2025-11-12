@extends('layouts.areaUsuario')

@section('content')
<div class="container mt-4">
    <h1>Meus Pedidos de Doação</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <hr>

    <h2>Pedidos em Aberto</h2>
    <div class="row">
        @forelse ($pedidosEmAberto as $pedido)
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <strong>Pedido de {{ $pedido->created_at->format('d/m/Y') }}</strong>
                        <span class="badge bg-warning text-dark">Pendente</span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Itens Solicitados:</h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($pedido->itensDoPedido as $item)
                                <li class="list-group-item">
                                    {{ $item->material->name }} ({{ $item->quantidade }})
                                </li>
                            @endforeach
                        </ul>

                        <p class="card-text mt-3">
                            <strong>Endereço de Coleta:</strong><br>
                            {{ $pedido->endereco }}
                        </p>
                        
                        @if ($pedido->observacao)
                            <p class="card-text">
                                <strong>Observação:</strong><br>
                                {{ $pedido->observacao }}
                            </p>
                        @endif
                    </div>
                    <div class="card-footer text-end">
                        
                        <form id="form-cancelar-{{ $pedido->id }}" action="{{ route('areaDoUsuario.cancelarPedido', $pedido->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                    
                            <button type="button" 
                                    class="btn btn-danger btn-sm"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#confirmationModal"
                                    data-modal-title="Confirmar Cancelamento"
                                    data-modal-body="Tem certeza que deseja cancelar este pedido? Esta ação não pode ser desfeita."
                                    data-modal-button-text="Sim, cancelar pedido"
                                    data-modal-button-class="btn-danger"
                                    data-form-target="#form-cancelar-{{ $pedido->id }}">
                                <i class="bi bi-trash"></i> Cancelar Pedido
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col">
                <div class="alert alert-info" role="alert">
                    Você não possui nenhum pedido em aberto no momento.
                </div>
            </div>
        @endforelse
    </div>

    <hr class="my-4">

    <h2>Histórico de Pedidos Concluídos</h2>
    <div class="list-group">
        @forelse ($pedidosConcluidos as $pedido)
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">Pedido de {{ $pedido->created_at->format('d/m/Y') }}</h5>
                    <p class="mb-1">Coletado em: {{ $pedido->endereco }}</p>
                    <small>
                        <a href="{{ route('pedido.show', $pedido->id) }}" class="btn btn-link btn-sm p-0">
                            Ver detalhes dos itens
                        </a>
                    </small>
                </div>
                <span class="badge bg-success rounded-pill">Concluído</span>
            </div>
        @empty
            <div class="alert alert-secondary" role="alert">
                Você ainda não tem pedidos concluídos.
            </div>
        @endforelse
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