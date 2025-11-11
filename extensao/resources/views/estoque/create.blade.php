@extends('layouts.areaInstituicao')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-3">Cadastrar Nova Doação Recebida</h1>
        </div>
    </div>

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
    
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-12 col-lg-8"> 
            
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0 card-title">Registrar Recebimento de Doação</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('estoque.store') }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nome_doador" class="form-label">Nome do Doador</label>
                                    <input type="text" id="nome_doador" name="nome_doador" 
                                           class="form-control @error('nome_doador') is-invalid @enderror" 
                                           value="{{ old('nome_doador') }}" 
                                           placeholder="Pessoa física ou empresa" required>
                                    @error('nome_doador')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="data_doacao" class="form-label">Data de Recebimento</label>
                                    <input type="date" id="data_doacao" name="data_doacao" 
                                           class="form-control @error('data_doacao') is-invalid @enderror" 
                                           value="{{ old('data_doacao', date('Y-m-d')) }}" required>
                                    @error('data_doacao')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row g-3">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="material_id" class="form-label">Material Recebido</label>
                                    <select id="material_id" name="material_id" 
                                            class="form-select @error('material_id') is-invalid @enderror" required>
                                        <option value="" disabled selected>Selecione o material</option>
                                        @if(isset($materiais))
                                            @foreach($materiais as $material)
                                                <option value="{{ $material->id }}" {{ old('material_id') == $material->id ? 'selected' : '' }}>
                                                    {{ $material->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('material_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="quantidade" class="form-label">Quantidade</label>
                                    <input type="number" id="quantidade" name="quantidade" 
                                           class="form-control @error('quantidade') is-invalid @enderror" 
                                           value="{{ old('quantidade') }}" 
                                           placeholder="Ex: 50" min="1" required>
                                    @error('quantidade')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="observacoes" class="form-label">Observações (Opcional)</label>
                            <textarea id="observacoes" name="observacoes" 
                                      class="form-control @error('observacoes') is-invalid @enderror" 
                                      rows="3" 
                                      placeholder="Alguma nota sobre a doação, condição do material, etc.">{{ old('observacoes') }}</textarea>
                            @error('observacoes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                Salvar Doação
                            </button>
                            <a href="{{ route('areaDaInstituicao.estoque') }}" class="btn btn-secondary ms-2">
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