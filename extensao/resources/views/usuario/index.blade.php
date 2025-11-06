<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <title>Lista de Usuários</title>

    <!-- Estilo rápido e limpo -->
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
        <h1>Lista de Usuários</h1>

        @if($usuarios->isEmpty())
        <div class="empty">Nenhum usuário cadastrado.</div>
        @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Gênero</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Data de Nascimento</th>
                    <th>Qtd. Recebida</th>
                    <th>Qtd. Doada</th>
                    <th>Açoes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->nome }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->genero }}</td>
                    <td>{{ $usuario->cpf }}</td>
                    <td>{{ $usuario->telefone }}</td>
                    <td>{{ $usuario->endereco }}</td>
                    <td>{{ \Carbon\Carbon::parse($usuario->data_de_nascimento)->format('d/m/Y') }}</td>
                    <td>{{ $usuario->qntd_recebida }}</td>
                    <td>{{ $usuario->qntd_doada }}</td>
                    <td>
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-warning">Editar</a>

                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Excluir Usuario?')">Excluir</button>
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