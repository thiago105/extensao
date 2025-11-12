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
                                    {{ $item->material->nome }} ({{ $item->quantidade }})
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
                        <form action="{{ route('areaDoUsuario.cancelarPedido', $pedido->id) }}" method="POST" 
                              onsubmit="return confirm('Tem certeza que deseja cancelar este pedido? Esta ação não pode ser desfeita.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
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
@endsection