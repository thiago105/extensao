<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario - Traços de Esperança</title>
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
            animation: fadeInUp 0.6s ease;
        }

        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
        }

        .logo img {
            width: 180px;
            height: auto;
        }

        h2 {
            text-align: center;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        h5 {
            font-weight: 600;
            color: #1a73e8;
            margin-bottom: 20px;
        }

        label {
            font-weight: 500;
            color: #555;
        }

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

        .btn {
            border-radius: 10px;
            font-weight: 600;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #1a73e8;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0d63d2;
            transform: scale(1.02);
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
            transform: scale(1.02);
        }

        @keyframes fadeInUp {
            0% { transform: translateY(20px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        @media (max-width: 576px) {
            .container { padding: 25px; }
            h2 { font-size: 1.6rem; }
            .logo img { width: 140px; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="logo">
        <img src="{{ asset('imgs/logo_menor.png') }}" alt="logo Traços de esperança">
    </div>

    <h2>Editar Usuario</h2>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if ($tipo === 'estudante')
        <form action="{{ route('usuarios.update', $dados->id) }}" method="POST">
            @csrf
            @method('PUT')
            <h5>Editar Estudante</h5>

            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" value="{{ $dados->nome }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $dados->email }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gênero</label>
                <select name="genero" class="form-select" required>
                    <option value="masculino" {{ $dados->genero === 'masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="feminino" {{ $dados->genero === 'feminino' ? 'selected' : '' }}>Feminino</option>
                    <option value="outro" {{ $dados->genero === 'outro' ? 'selected' : '' }}>Outro</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">CPF</label>
                <input type="text" name="cpf" class="form-control" value="{{ $dados->cpf }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Data de Nascimento</label>
                <input type="date" name="data_de_nascimento" class="form-control" value="{{ $dados->data_de_nascimento }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Telefone</label>
                <input type="text" name="telefone" class="form-control" value="{{ $dados->telefone }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Endereço</label>
                <input type="text" name="endereco" class="form-control" value="{{ $dados->endereco }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nova Senha (opcional)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">Salvar Alterações</button>
        </form>
    @else
        <form action="{{ route('instituicoe.update', $dados->id) }}" method="POST">
            @csrf
            @method('PUT')
            <h5>Editar Instituição</h5>

            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" value="{{ $dados->nome }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">CNPJ</label>
                <input type="text" name="cnpj" class="form-control" value="{{ $dados->cnpj }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Endereço</label>
                <input type="text" name="endereco" class="form-control" value="{{ $dados->endereco }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $dados->email }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nova Senha (opcional)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <button type="submit" class="btn btn-success w-100 mt-3">Salvar Alterações</button>
        </form>
    @endif
</div>

</body>
</html>
