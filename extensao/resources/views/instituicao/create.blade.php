<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Instituição - Traços de Esperança</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #e3f2fd, #f8f9fa);
            font-family: "Poppins", sans-serif;
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

        h2 {
            text-align: center;
            font-weight: 700;
            color: #1a73e8;
            margin-bottom: 30px;
        }

        label {
            font-weight: 500;
            color: #555;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 1px solid #ced4da;
            padding: 10px 14px;
            transition: all 0.2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #1a73e8;
            box-shadow: 0 0 6px rgba(26, 115, 232, 0.3);
        }

        .btn-primary {
            background-color: #1a73e8;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0d63d2;
            transform: scale(1.02);
        }

        a.text-secondary {
            color: #1a73e8 !important;
            font-weight: 500;
        }

        a.text-secondary:hover {
            text-decoration: underline;
        }

        @keyframes fadeInUp {
            0% {
                transform: translateY(20px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5 mb-5">
        <h2>Cadastro de Instituição</h2>

        <form action="{{ route('instituicao.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nome da Instituição</label>
                <input type="text" name="name" class="form-control" placeholder="Digite o nome" required>
            </div>

            <div class="mb-3">
                <label class="form-label">CNPJ</label>
                <input type="text" name="cnpj" class="form-control" placeholder="Apenas números" maxlength="14"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Endereço</label>
                <input type="text" name="endereco" class="form-control" placeholder="Rua, número, bairro, cidade..."
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="exemplo@instituicao.com" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input type="password" name="password" class="form-control" placeholder="Crie uma senha" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">
                Cadastrar Instituição
            </button>
        </form>

        <a href="{{ route('login.usuario') }}" class="btn btn-secondary w-100 mt-3 text-white text-decoration-none">
            Logar-se
        </a>
    </div>
</body>

</html>