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

    /* REMOVIDO: .card-ativos, .card-finalizados, 
      .card-header-custom e .table 
      para usar o padrão do Bootstrap.
    */
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
                                    
                                    <form action="{{ route('areaDaInstituicao.pontoDeColeta.destroy', $ponto->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este ponto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-excluir-ponto btn-sm" title="Excluir">
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

</div>
@endsection