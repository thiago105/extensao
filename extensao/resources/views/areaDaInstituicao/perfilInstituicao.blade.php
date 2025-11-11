@extends('layouts.areaInstituicao')

@section('content')
<style>
    /* 
    --cor-primaria: #005F73;
    --cor-secundaria: #E29578;
    --cor-terciaria: #94D2BD;
    --cor-branco: #F5F5F5;
    --cor-preto: #0B0C10;
    --cor-erro-falha: #D62828;
    --cor-sucesso: #2D6A4F;
    --cor-header: #404040;
    --cor-sidebar: #555555;
    --cor-body: #F8F8F8;
    --sidebar-expanded: 240px;
    --sidebar-collapsed: 70px;
    --cor-body-bg: var(--cor-body); 
    */
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-3">Perfil da Instituição</h1>
        </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Opa!</strong> Parece que há algo errado:
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0 card-title">Editar Informações</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('instituicao.update', $instituicao->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="id" class="form-label">ID</label>
                                <input type="text" id="id" class="form-control" value="{{ $instituicao->id }}" disabled>
                            </div>

                            <div class="col-md-6">
                                <label for="cnpj" class="form-label">CNPJ</label>
                                <input type="text" id="cnpj" name="cnpj" class="form-control" value="{{ old('cnpj', $instituicao->cnpj) }}" required>
                            </div>

                            <div class="col-12">
                                <label for="name" class="form-label">Nome da Instituição</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $instituicao->name) }}" required>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $instituicao->email) }}" required>
                            </div>

                            <div class="col-12">
                                <label for="endereco" class="form-label">Endereço</label>
                                <input type="text" id="endereco" name="endereco" class="form-control" value="{{ old('endereco', $instituicao->endereco) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label">Nova Senha</label>
                                <input type="password" id="password" name="password" class="form-control" aria-describedby="passwordHelp">
                                <div id="passwordHelp" class="form-text">
                                    Deixe em branco para não alterar a senha.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirmar Nova Senha</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Data de Cadastro</label>
                                <input type="text" class="form-control" value="{{ $instituicao->created_at ? $instituicao->created_at->format('d/m/Y H:i') : 'N/A' }}" disabled>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Última Atualização</label>
                                <input type="text" class="form-control" value="{{ $instituicao->updated_at ? $instituicao->updated_at->format('d/m/Y H:i') : 'N/A' }}" disabled>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary" style="background-color: var(--cor-primaria); border-color: var(--cor-primaria);">
                                    Salvar Alterações
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0 card-title">Zona de Perigo</h5>
                </div>
                <div class="card-body">
                    <p>Ao apagar sua conta, todas as informações associadas (pontos de coleta, estoque, etc.) serão permanentemente removidas.</p>
                    <p><strong>Esta ação não pode ser desfeita.</strong></p>

                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteInstituicaoModal">
                        Apagar Minha Conta Permanentemente
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="deleteInstituicaoModal" tabindex="-1" aria-labelledby="deleteInstituicaoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteInstituicaoModalLabel">Confirmar Exclusão da Conta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Você tem certeza que deseja excluir esta conta de instituição?</strong></p>
                <p>Esta ação não pode ser desfeita. Todos os seus dados (pontos de coleta, estoque, etc.) serão permanentemente removidos.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                <form action="{{ route('instituicao.destroy', $instituicao->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Sim, excluir esta conta</button>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection