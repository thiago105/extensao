<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <title>Lista de Instituições</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f6f6f6;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 10px 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .empty {
            text-align: center;
            padding: 20px;
            color: #777;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Lista de Instituições</h1>

        <div class="mb-3">
            <a href="{{ route('instituicao.create') }}" class="btn btn-success">
                <i class="bi bi-building-add"></i>
                Nova Instituição
            </a>
        </div>

        @if($instituicaos->isEmpty())
        <div class="empty">Nenhuma instituição cadastrada.</div>
        @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuário Responsável</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>CNPJ</th>
                    <th>Endereço</th>
                    <th>Criado em</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($instituicaos as $instituicao)
                <tr>
                    <td>{{ $instituicao->id }}</td>
                    <td>{{ $instituicao->usuario->nome ?? '—' }}</td>
                    <td>{{ $instituicao->name }}</td>
                    <td>{{ $instituicao->email }}</td>
                    <td>{{ $instituicao->cnpj }}</td>
                    <td>{{ $instituicao->endereco }}</td>
                    <td>{{ \Carbon\Carbon::parse($instituicao->created_at)->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('instituicao.edit', $instituicao->id) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>

                        <form action="{{ route('instituicao.destroy', $instituicao->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Excluir esta instituição?')">
                                <i class="bi bi-trash-fill"></i> Excluir
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

</body>

</html>