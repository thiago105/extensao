<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Traços de Esperança</title>
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
            text-align: center;
            margin-bottom: 25px;
        }

        .logo img {
            width: 180px;
            height: auto;
        }

        h2 {
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 25px;
            text-align: center;
        }

        label {
            font-weight: 500;
            color: #555;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 14px;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            border-color: #1a73e8;
            box-shadow: 0 0 6px rgba(26, 115, 232, 0.3);
        }

        .btn {
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            padding: 10px;
        }

        .btn-primary {
            background-color: #1a73e8;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0d63d2;
            transform: scale(1.03);
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
            transform: scale(1.03);
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

    <div class="container">
        <div class="logo">
            <img src="{{ asset('imgs/logo_menor.png') }}" alt="Logo Traços de Esperança">
        </div>

        @if ($tipo === 'usuario')
            <h2>Login do Usuário</h2>

            @if ($errors->has('login_error'))
                <div class="alert alert-danger text-center mb-4" id="alert-error">
                    {{ $errors->first('login_error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" name="tipo" value="usuario">
                <div class="mb-3">
                    <label for="email_user" class="form-label">Email</label>
                    <input id="email_user" type="email" name="email" class="form-control" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password_user" class="form-label">Senha</label>
                    <input id="password_user" type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary mt-2">Entrar como Usuário</button>
            </form>

        @elseif ($tipo === 'instituicao')
            <h2>Login da Instituição</h2>

            @if ($errors->has('login_error'))
                <div class="alert alert-danger text-center mb-4" id="alert-error">
                    {{ $errors->first('login_error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('instituicao.login') }}">
                @csrf
                <input type="hidden" name="tipo" value="instituicao">
                <div class="mb-3">
                    <label for="email_instituicao" class="form-label">Email</label>
                    <input id="email_instituicao" type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password_instituicao" class="form-label">Senha</label>
                    <input id="password_instituicao" type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success mt-2">Entrar como Instituição</button>
            </form>
        @endif
    </div>

</body>

</html>