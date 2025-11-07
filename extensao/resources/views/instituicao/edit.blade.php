<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Instituição - Traços de Esperança</title>
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
            color: #28a745;
            margin-bottom: 30px;
        }

        label { font-weight: 500; color: #555; }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ced4da;
            padding: 10px 14px;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 6px rgba(40, 167, 69, 0.3);
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-success:hover {
            background-color: #218838;
            transform: scale(1.02);
        }
    </style>
</head>

<body>
<div class="container">
    <h2>Editar Instituição</h2>

    <form action="{{ route('instituicao.update', $instituicao->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nome da Instituição</label>
            <input type="text" name="name" class="form-control" value="{{ $instituicao->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">CNPJ</label>
            <input type="text" name="cnpj" class="form-control" value="{{ $instituicao->cnpj }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Endereço</label>
            <input type="text" name="endereco" class="form-control" value="{{ $instituicao->endereco }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $instituicao->email }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nova Senha (opcional)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <button type="submit" class="btn btn-success w-100 mt-3">Salvar Alterações</button>
    </form>
</div>
</body>
</html>
