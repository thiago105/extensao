@extends('layouts.areaInstituicao')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detalhes do Pedido #{{ $pedido->id }}</h1>
        <a href="{{ route('areaDaInstituicao.pedidosDeDoacao') }}" class="btn btn-secondary shadow-sm">
            <i class="bi bi-arrow-left me-1"></i>
            Voltar para a Lista
        </a>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold" style="color: var(--cor-primaria);">Informações do Pedido</h6>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">ID do Pedido:</dt>
                        <dd class="col-sm-8">{{ $pedido->id }}</dd>

                        <dt class="col-sm-4">Status:</dt>
                        <dd class="col-sm-8">
                            @if ($pedido->concluido)
                                <span class="badge bg-success">Concluído</span>
                            @else
                                <span class="badge bg-warning text-dark">Pendente</span>
                            @endif
                        </dd>

                        <dt class="col-sm-4">Data do Pedido:</dt>
                        <dd class="col-sm-8">{{ $pedido->created_at->format('d/m/Y \à\s H:i') }}</dd>

                        <dt class="col-sm-4">Endereço de Coleta:</dt>
                        <dd class="col-sm-8">{{ $pedido->endereco }}</dd>

                        <dt class="col-sm-4">Observações:</dt>
                        <dd class="col-sm-8">
                            {{ $pedido->observacao ?? 'Nenhuma observação.' }}
                        </dd>
                    </dl>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold" style="color: var(--cor-primaria);">Informações do Doador</h6>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">ID do Usuário:</dt>
                        <dd class="col-sm-8">{{ $pedido->usuario->id ?? 'Não encontrado' }}</dd>
                        
                        <dt class="col-sm-4">Nome:</dt>
                        <dd class="col-sm-8">{{ $pedido->usuario->nome ?? 'Não encontrado' }}</dd>
                        
                        <dt class="col-sm-4">Email:</dt>
                        <dd class="col-sm-8">{{ $pedido->usuario->email ?? 'Não encontrado' }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold" style="color: var(--cor-primaria);">Itens Solicitados</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead class="table-light">
                                <tr>
                                    <th>Material</th>
                                    <th>Quantidade Solicitada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pedido->itensDoPedido as $item)
                                    <tr>
                                        <td>
                                            {{ $item->material->name ?? 'Material não encontrado' }}
                                        </td>
                                        <td>{{ $item->quantidade }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">Nenhum item encontrado para este pedido.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection