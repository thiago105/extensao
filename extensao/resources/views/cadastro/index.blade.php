<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolher Cadastro - Traços de Esperança</title>
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
            max-width: 500px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            padding: 40px;
            animation: fadeInUp 0.6s ease;
            text-align: center;
        }

        .logo img {
            width: 180px;
            height: auto;
            margin-bottom: 20px;
        }

        h2 {
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        .btn {
            border-radius: 10px;
            font-weight: 600;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
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
    {{-- Logo no topo --}}
    <div class="logo">
        <img src="{{ asset('imgs/logo_menor.png') }}" alt="logo Traços de Esperança">
    </div>

    <h2>Como você deseja se cadastrar?</h2>

    {{-- Botões de escolha --}}
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
        Sou Estudante
    </a>

    <a href="{{ route('instituicao.create') }}" class="btn btn-success">
        Sou Instituição
    </a>
</div>

</body>
</html>
