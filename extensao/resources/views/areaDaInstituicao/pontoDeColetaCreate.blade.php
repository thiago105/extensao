@extends('layouts.areaInstituicao')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="h3 mb-0 text-gray-800">Novo Ponto de Coleta</h1>
                <a href="{{ route('areaDaInstituicao.pontoDeColeta.index') }}" class="btn btn-sm btn-secondary">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('areaDaInstituicao.pontoDeColeta.store') }}" method="POST">
                        @csrf <div class="mb-3">
                            <label for="endereco" class="form-label">Endereço Completo</label>
                            <input type="text" 
                                   class="form-control @error('endereco') is-invalid @enderror" 
                                   id="endereco" 
                                   name="endereco"
                                   value="{{ old('endereco') }}" 
                                   required 
                                   maxlength="200">
                            @error('endereco')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="data_inicio" class="form-label">Data de Início</label>
                                <input type="datetime-local" 
                                       class="form-control @error('data_inicio') is-invalid @enderror" 
                                       id="data_inicio" 
                                       name="data_inicio"
                                       value="{{ old('data_inicio', now()->format('Y-m-d\TH:i')) }}"
                                       required>
                                @error('data_inicio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="data_fim" class="form-label">Data de Término (Opcional)</label>
                                <input type="datetime-local" 
                                       class="form-control @error('data_fim') is-invalid @enderror" 
                                       id="data_fim" 
                                       name="data_fim"
                                       value="{{ old('data_fim') }}">
                                <small class="form-text text-muted">Deixe em branco se for por tempo indeterminado.</small>
                                @error('data_fim')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn" style="background-color: var(--cor-sucesso); color: var(--cor-branco);">
                                <i class="bi bi-check-circle"></i> Salvar Novo Ponto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection