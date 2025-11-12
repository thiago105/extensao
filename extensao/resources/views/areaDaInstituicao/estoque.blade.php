@extends('layouts.areaInstituicao') {{-- Assumindo que seu layout principal se chama areaInstituicao --}}

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-3">Estoque da Instituição</h1>
        </div>
    </div>

    {{-- Alertas de Sucesso e Erro (igual ao seu exemplo) --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type-="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
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
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title">Itens em Estoque</h5>

                    {{-- Link para a rota de criação de item de estoque --}}
                    <a href="{{ route('estoque.create') }}" class="btn btn-primary">
                        + Adicionar Novo Item
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Material</th>
                                    <th>Quantidade</th>
                                    <th class="text-center" style="width: 180px;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- Loop sobre os itens de estoque passados pelo controller --}}
                                @forelse($estoqueItens as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    
                                    {{-- Exibe o nome do material. O '??' é um operador de coalescência nula
                                         para caso o material tenha sido excluído ou não seja encontrado --}}
                                    <td>{{ $item->material->name ?? 'Material não encontrado' }}</td>
                                    
                                    <td>{{ $item->quantidade }}</td>
                                    
                                    <td class="text-center">

                                        {{-- Rota para editar o item --}}
                                        <a href="{{ route('estoque.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                            Editar
                                        </a>

                                        {{-- Formulário para excluir o item --}}
                                        <form action="{{ route('estoque.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Deseja realmente excluir este item do estoque?')">
                                                Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center p-3">Nenhum item cadastrado no estoque.</td>
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