<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário - Traços de Esperança</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e3f2fd, #f8f9fa);
            font-family: "Poppins", sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 10px;
        }

        .container {
            max-width: 600px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            padding: 40px;
        }

        h2 {
            text-align: center;
            font-weight: 700;
            color: #1a73e8;
            margin-bottom: 30px;
        }

        label { font-weight: 500; color: #555; }

        .form-control, .form-select {
            border-radius: 10px;
            border: 1px solid #ced4da;
            padding: 10px 14px;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #1a73e8;
            box-shadow: 0 0 6px rgba(26, 115, 232, 0.3);
        }

        .btn-primary {
            background-color: #1a73e8;
            border: none;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #0d63d2;
            transform: scale(1.02);
        }
    </style>
</head>

<body>
<div class="container">
    <h2>Editar Usuário</h2>

    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ $usuario->nome }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $usuario->email }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gênero</label>
            <select name="genero" class="form-select" required>
                <option value="masculino" {{ $usuario->genero === 'masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="feminino" {{ $usuario->genero === 'feminino' ? 'selected' : '' }}>Feminino</option>
                <option value="outro" {{ $usuario->genero === 'outro' ? 'selected' : '' }}>Outro</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">CPF</label>
            <input type="text" name="cpf" class="form-control" value="{{ $usuario->cpf }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Data de Nascimento</label>
            <input type="date" name="data_de_nascimento" class="form-control" value="{{ $usuario->data_de_nascimento }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control" value="{{ $usuario->telefone }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Endereço</label>
            <input type="text" name="endereco" class="form-control" value="{{ $usuario->endereco }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nova Senha (opcional)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-3">Salvar Alterações</button>
    </form>
</div>
</body>
</html>
