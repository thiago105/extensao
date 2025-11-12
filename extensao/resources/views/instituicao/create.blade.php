<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Instituição - Traços de Esperança</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            color: #28a745;
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
            border-color: #28a745;
            box-shadow: 0 0 6px rgba(40, 167, 69, 0.3);
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838;
            transform: scale(1.02);
        }

        .btn-secondary {
            border-radius: 10px;
            font-weight: 500;
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

        <form action="{{ route('instituicao.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf

            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Nome da Instituição</label>
                    <input type="text" name="name" class="form-control" placeholder="Digite o nome" maxlength="100" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">CNPJ</label>
                    <input type="text" name="cnpj" id="cnpj" class="form-control" placeholder="00.000.000/0000-00" maxlength="18" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="exemplo@instituicao.com" maxlength="100" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Endereço</label>
                    <input type="text" name="endereco" class="form-control" placeholder="Rua, número, bairro, cidade..." maxlength="150" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Senha</label>
                    <input type="password" name="password" class="form-control" placeholder="Crie uma senha" minlength="6" maxlength="20" required>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100 mt-4">
                Cadastrar Instituição
            </button>

            <a href="{{ route('login.instituicao') }}" class="btn btn-secondary w-100 mt-3 text-white text-decoration-none">
                Logar-se
            </a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/imask"></script>

    <script>
        IMask(document.getElementById('cnpj'), {
            mask: '00000000000000'
        });
    </script>
</body>

</html>
