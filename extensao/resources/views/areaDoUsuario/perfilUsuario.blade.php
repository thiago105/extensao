@extends('layouts.areaUsuario')

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
    .form-control:disabled,
    .form-control[readonly] {
        background-color: #e9ecef;
        opacity: 1;
        cursor: not-allowed;
    }
</style>

<div class="container-fluid">
    <h1 class="h3 mb-4">Meu Perfil</h1>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Ops!</strong> Ocorreram alguns erros:
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
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold" style="color: var(--cor-primaria, #005F73);">Gerenciar Dados da Conta</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h5 class="mb-3">Informações Pessoais</h5>
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div class="mb-3">
                                    <label for="id" class="form-label">ID do Usuário</label>
                                    <input type="text" class="form-control" id="id" value="{{ $usuario->id }}" disabled readonly>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-9">
                                <div class="mb-3">
                                    <label for="nome" class="form-label">Nome Completo</label>
                                    <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $usuario->nome) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $usuario->email) }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="genero" class="form-label">Gênero</label>
                                    <select class="form-select" id="genero" name="genero" required>
                                        <option value="Masculino" {{ old('genero', $usuario->genero) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="Feminino" {{ old('genero', $usuario->genero) == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                                        <option value="Outro" {{ old('genero', $usuario->genero) == 'Outro' ? 'selected' : '' }}>Outro</option>
                                        <option value="Prefiro não informar" {{ old('genero', $usuario->genero) == 'Prefiro não informar' ? 'selected' : '' }}>Prefiro não informar</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cpf" class="form-label">CPF</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf', $usuario->cpf) }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="data_de_nascimento" class="form-label">Data de Nascimento</label>
                                    <input type="date" class="form-control" id="data_de_nascimento" name="data_de_nascimento" value="{{ old('data_de_nascimento', $usuario->data_de_nascimento) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <input type="tel" class="form-control" id="telefone" name="telefone" value="{{ old('telefone', $usuario->telefone) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="endereco" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="endereco" name="endereco" value="{{ old('endereco', $usuario->endereco) }}" required>
                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3">Alterar Senha</h5>
                        <p class="text-muted">Deixe em branco para manter a senha atual.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Nova Senha</label>
                                    <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirmar Nova Senha</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Membro Desde</label>
                                    <input type="text" class="form-control" value="{{ $usuario->created_at->format('d/m/Y H:i:s') }}" disabled readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Última Atualização</label>
                                    <input type="text" class="form-control" value="{{ $usuario->updated_at->format('d/m/Y H:i:s') }}" disabled readonly>
                                </div>
                            </div>
                        </div>


                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary" style="background-color: var(--cor-primaria, #005F73); border-color: var(--cor-primaria, #005F73);">
                                Salvar Alterações
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div> <div class="col-lg-4 mb-4">
            <div class="card shadow mb-4 border-danger">
                <div class="card-header py-3 bg-danger">
                    <h6 class="m-0 font-weight-bold text-white">Zona de Perigo</h6>
                </div>
                <div class="card-body">
                    <p>Uma vez que sua conta é excluída, todos os seus recursos e dados serão permanentemente apagados. Antes de excluir sua conta, por favor, baixe quaisquer dados ou informações que você deseja manter.</p>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                        Excluir Conta Permanentemente
                    </button>
                </div>
            </div>
        </div> </div> </div> <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModalLabel">Confirmar Exclusão da Conta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Você tem certeza que deseja excluir sua conta?</strong></p>
                <p>Esta ação não pode ser desfeita. Todos os seus dados serão permanentemente removidos.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Sim, excluir minha conta</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection