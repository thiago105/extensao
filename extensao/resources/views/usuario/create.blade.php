<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Usuário - Traços de Esperança</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
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
            padding: 40px 30px;
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
    <div class="container mt-4 mb-5">
        <h2>Cadastro de Estudante</h2>

        <form action="{{ route('usuarios.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf

            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-control" maxlength="100" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" maxlength="100" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Gênero</label>
                    <select name="genero" class="form-select" required>
                        <option value="">-- Selecione --</option>
                        <option value="masculino">Masculino</option>
                        <option value="feminino">Feminino</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="form-control" maxlength="14" required placeholder="000.000.000-00">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Data de Nascimento</label>
                    <input type="date" name="data_de_nascimento" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="form-control" maxlength="15" required placeholder="(00) 00000-0000">
                </div>

                <div class="col-12">
                    <label class="form-label">Endereço</label>
                    <input type="text" name="endereco" class="form-control" maxlength="150" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-control" minlength="6" maxlength="20" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-4">
                Cadastrar Estudante
            </button>

            <a href="{{ route('login.usuario') }}" class="btn btn-secondary w-100 mt-3 text-white text-decoration-none">
                Logar-se
            </a>
        </form>
    </div>

    <!-- Scripts Bootstrap e IMask -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/imask"></script>

    <script>
        // Máscara de CPF
        IMask(document.getElementById('cpf'), {
            mask: '00000000000'
        });

        // Máscara de telefone
        IMask(document.getElementById('telefone'), {
            mask: [
                { mask: '0000000000' },
                { mask: '00000000000' }
            ]
        });
    </script>
</body>

</html>
