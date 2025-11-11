@extends('layouts.areaInstituicao')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            {{-- Título da Página --}}
            <h1 class="h3 mb-3">Editar Material</h1>
        </div>
    </div>

    {{-- Bloco para exibir erros de validação --}}
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
        {{-- Limitando a largura do formulário --}}
        <div class="col-12 col-lg-8"> 
            
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0 card-title">Editando: {{ $material->name }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('material.update', $material->id) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- Importante para atualização --}}

                        <div class="mb-3">
                            <label for="id" class="form-label">ID</label>
                            <input type="text" id="id" class="form-control" 
                                   value="{{ $material->id }}" disabled>
                            {{-- O ID é mostrado mas não pode ser editado --}}
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome do Material</label>
                            <input type="text" id="name" name="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $material->name) }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">
                                </div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                Salvar Alterações
                            </button>
                            <a href="{{ route('material.index') }}" class="btn btn-secondary ms-2">
                                Cancelar
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection