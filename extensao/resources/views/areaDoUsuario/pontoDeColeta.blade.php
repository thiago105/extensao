@extends('layouts.areaUsuario')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Pontos de Coleta Ativos</h1>

    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5 class="mb-0">Filtrar Pontos de Coleta</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('areaDoUsuario.pontoDeColeta') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-5">
                        <label for="filtro_nome" class="form-label">Nome da Instituição</label>
                        <input type"text" class="form-control" id="filtro_nome" name="filtro_nome"
                               value="{{ $filtros['filtro_nome'] ?? '' }}">
                    </div>
                    <div class="col-md-3">
                        <label for="filtro_data" class="form-label">Ativo na Data</label>
                        <input type="date" class="form-control" id="filtro_data" name="filtro_data"
                               value="{{ $filtros['filtro_data'] ?? '' }}">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2" style="background-color: var(--cor-primaria); border-color: var(--cor-primaria);">
                            <i class="bi bi-search"></i> Filtrar
                        </button>
                        <a href="{{ route('areaDoUsuario.pontoDeColeta') }}" class="btn btn-secondary">
                            Limpar Filtros
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Instituição</th>
                            <th scope="col">Endereço</th>
                            <th scope="col">Data de Início</th>
                            <th scope="col">Data de Término</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pontosDeColeta as $ponto)
                        <tr>
                            <td>
                                {{ $ponto->instituicao->name ?? 'Instituição não encontrada' }}
                            </td>
                            <td>{{ $ponto->endereco }}</td>
                            <td>{{ \Carbon\Carbon::parse($ponto->data_inicio)->format('d/m/Y') }}</td>
                            <td>
                                @if ($ponto->data_fim)
                                {{ \Carbon\Carbon::parse($ponto->data_fim)->format('d/m/Y') }}
                                @else
                                <span class="badge bg-success">Permanente</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                Nenhum ponto de coleta encontrado com os filtros aplicados.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $pontosDeColeta->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection