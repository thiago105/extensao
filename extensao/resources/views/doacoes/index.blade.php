<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Doações</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 40px auto;
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 10px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .btn-add {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            margin-bottom: 15px;
        }

        .btn-add:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Lista de Doações</h2>

    <a href="{{ route('doacoes.create') }}" class="btn-add">+ Registrar Nova Doação</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Instituição</th>
                <th>Usuário</th>
                <th>Tipo de Doação</th>
                <th>Endereço de Destino</th>
                <th>Data Prevista</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($doacoes as $doacao)
                <tr>
                    <td>{{ $doacao->id }}</td>
                    <td>{{ $doacao->instituicao->name ?? 'N/A' }}</td>
                    <td>{{ $doacao->usuario->nome ?? 'N/A' }}</td>
                    <td>{{ ucfirst($doacao->tipo) }}</td>
                    <td>{{ $doacao->endereco_destino ?? 'N/A' }}</td>
                    <td>
                        {{ $doacao->data_prevista_entrega 
                            ? \Carbon\Carbon::parse($doacao->data_prevista_entrega)->format('d/m/Y')
                            : '—' }}
                    </td>
                    <td>{{ $doacao->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Nenhuma doação registrada ainda.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
