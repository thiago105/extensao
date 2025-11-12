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

                                        {{-- 
                                            MUDANÇA 1: 
                                            - Adicionado ID ao formulário.
                                        --}}
                                        <form id="form-excluir-{{ $material->id }}" action="{{ route('material.destroy', $material->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            
                                            {{-- 
                                                MUDANÇA 2: 
                                                - Trocado 'type="submit"' para 'type="button"'.
                                                - Removido 'onclick'.
                                                - Adicionadas classes e atributos 'data-*' para controlar o modal.
                                            --}}
                                            <button type="button" 
                                                    class="btn btn-danger btn-sm"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#confirmationModal"
                                                    data-modal-title="Confirmar Exclusão"
                                                    data-modal-body="Deseja realmente excluir este material? Esta ação não pode ser desfeita."
                                                    data-modal-button-text="Sim, excluir material"
                                                    data-modal-button-class="btn-danger"
                                                    data-form-target="#form-excluir-{{ $material->id }}">
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
</div> {{-- 
    MUDANÇA 3: HTML DO MODAL
    - Adicionado o HTML para o modal de confirmação genérico.
--}}
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmar Ação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Você tem certeza que deseja realizar esta ação?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn" id="btn-confirm-modal-action">Confirmar</button>
            </div>
        </div>
    </div>
</div>


{{-- 
    MUDANÇA 4: JAVASCRIPT
    - Adicionado script para lidar com a lógica do modal.
--}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        const confirmationModal = document.getElementById('confirmationModal');
        let formToSubmit = null; 

        const confirmButton = document.getElementById('btn-confirm-modal-action');

        confirmationModal.addEventListener('show.bs.modal', function (event) {
            
            const button = event.relatedTarget; 

            const modalTitle = button.dataset.modalTitle;
            const modalBody = button.dataset.modalBody;
            const modalButtonText = button.dataset.modalButtonText;
            const modalButtonClass = button.dataset.modalButtonClass;
            
            const formTargetSelector = button.dataset.formTarget;
            formToSubmit = document.querySelector(formTargetSelector);

            confirmationModal.querySelector('.modal-title').textContent = modalTitle;
            confirmationModal.querySelector('.modal-body').textContent = modalBody;
            
            confirmButton.textContent = modalButtonText;
            
            confirmButton.className = 'btn'; 
            confirmButton.classList.add(modalButtonClass); 
        });

        confirmButton.addEventListener('click', function () {
            if (formToSubmit) {
                formToSubmit.submit();
            }
        });

    });
</script>

@endsection