@extends('layouts.areaInstituicao')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-3">Cadastrar Tipos de Material</h1>
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


    <div class="row">
        

        <div class="col-12 col-lg-7 mb-4"> 
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0 card-title">Adicionar Novo(s) Material(is)</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('material.store') }}" method="POST">
                        @csrf

                        <label class="form-label">Nome do material</label>

                        <div id="campos-materiais-wrapper">
                            

                            <div class="input-group mb-3">
                                <input type="text" name="name[]" class="form-control" 
                                       placeholder="Ex: Papelão" required>
                            </div>

                        </div>

                        <button type="button" id="btn-adicionar-campo" class="btn btn-secondary btn-sm mb-4">
                            + Adicionar outro
                        </button>

                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary">
                                Salvar Materiais
                            </button>
                            <a href="{{ route('areaDaInstituicao.material') }}" class="btn btn-outline-secondary ms-2">
                                Cancelar
                            </a>
                        </div>
                    </form>

                    <template id="template-campo-material">
                        <div class="input-group mb-3">
                            <input type="text" name="name[]" class="form-control" 
                                   placeholder="Nome do material" required>
                            <button type="button" class="btn btn-outline-danger btn-remover-campo">
                                &times;
                            </button>
                        </div>
                    </template>

                </div>
            </div>
        </div>


        <div class="col-12 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0 card-title">Materiais Já Cadastrados</h5>
                </div>
                <div class="card-body" style="max-height: 400px; overflow-y: auto;">

                    @if(isset($materiais) && $materiais->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($materiais as $material)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $material->name }}

                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Nenhum tipo de material cadastrado ainda.</p>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const btnAdicionar = document.getElementById('btn-adicionar-campo');
    const wrapper = document.getElementById('campos-materiais-wrapper');
    const template = document.getElementById('template-campo-material');

    if (!btnAdicionar || !wrapper || !template) {
        console.warn('Elemento(s) não encontrado(s):', { btnAdicionar, wrapper, template });
        return;
    }

    // Delegation para remover botões (funciona mesmo para campos adicionados depois)
    wrapper.addEventListener('click', function(e) {
        if (e.target && e.target.matches('.btn-remover-campo')) {
            const ig = e.target.closest('.input-group');
            if (ig) ig.remove();
        }
    });

    // Adicionar novo campo
    btnAdicionar.addEventListener('click', function () {
        // Clona o conteúdo do template (DocumentFragment)
        const novoFragment = template.content.cloneNode(true);

        // Insere no wrapper (DocumentFragment adiciona os elementos filhos)
        wrapper.appendChild(novoFragment);

        // Focar no último input adicionado (garante compatibilidade)
        const inputs = wrapper.querySelectorAll('input[name="name[]"]');
        if (inputs.length) {
            inputs[inputs.length - 1].focus();
        }
    });

    // Habilita remoção nos campos carregados inicialmente (se houver)
    wrapper.querySelectorAll('.btn-remover-campo').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.target.closest('.input-group')?.remove();
        });
    });
});
</script>

@endsection