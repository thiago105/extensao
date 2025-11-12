@extends('layouts.areaInstituicao')

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-3">Tipos de Material Cadastrados</h1>
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
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title">Lista de Materiais</h5>

                    <a href="{{ route('material.create') }}" class="btn btn-primary">
                        + Adicionar Novo Material
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th class="text-center" style="width: 180px;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($materiais as $material)
                                <tr>
                                    <td>{{ $material->id }}</td>
                                    <td>{{ $material->name }}</td>
                                    <td class="text-center">

                                        <a href="{{ route('material.edit', $material->id) }}" class="btn btn-primary btn-sm">
                                            Editar
                                        </a>
                                        <form action="{{ route('material.destroy', $material->id) }}" method="POST" class="d-inline">
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
                                    <td colspan="3" class="text-center p-3">Nenhum tipo de material cadastrado.</td>
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