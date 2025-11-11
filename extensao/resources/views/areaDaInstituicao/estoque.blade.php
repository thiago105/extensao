@extends('layouts.areaInstituicao')

@section('content')

<div class="container-fluid">
    {{-- Título da página atualizado para o mesmo estilo do Perfil --}}
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-3">Materiais em Estoque</h1>
        </div>
    </div>

    {{-- Alertas (sem alteração) --}}
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
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title">Lista de Estoque</h5>
                    <a href="{{ route('estoque.create') }}" class="btn btn-primary">
                        + Adicionar
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Instituição</th>
                                    <th>Material</th>
                                    <th>Quantidade</th>
                                    <th class="text-center" style="width: 180px;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($estoques as $estoque)
                                    <tr>
                                        <td>{{ $estoque->id }}</td>
                                        <td>{{ $estoque->instituicao->name ?? '---' }}</td>
                                        <td>{{ $estoque->material->nome ?? '---' }}</td>
                                        <td>{{ $estoque->quantidade }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('estoque.edit', $estoque->id) }}" class="btn btn-primary btn-sm">
                                                Editar
                                            </a>
                                            <form action="{{ route('estoque.destroy', $estoque->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Deseja realmente excluir este material?')">
                                                    Excluir
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        {{-- 
                                            A classe 'sem-registros' provavelmente 
                                            será herdada do CSS global também.
                                        --}}
                                        <td colspan="5" class="sem-registros text-center p-3">Nenhum material em estoque.</td>
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