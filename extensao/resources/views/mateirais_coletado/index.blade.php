<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiais em Estoque</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2; margin: 0; padding: 0; }
        .container { width: 80%; margin: 40px auto; background: #fff; border-radius: 10px;
                     padding: 30px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 25px; }
        th, td { border: 1px solid #ddd; text-align: left; padding: 10px; }
        th { background-color: #4CAF50; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .btn-add { background-color: #4CAF50; color: white; padding: 10px 15px; border-radius: 8px;
                   text-decoration: none; margin-bottom: 15px; display: inline-block; }
        .btn-add:hover { background-color: #45a049; }
        .btn-delete { background-color: #e74c3c; color: white; border: none; padding: 8px 12px;
                      border-radius: 6px; cursor: pointer; }
        .btn-delete:hover { background-color: #c0392b; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Materiais em Estoque</h2>

        <a href="{{ route('mateirais_coletado.create') }}" class="btn-add">+ Adicionar Novo Material</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Instituição</th>
                    <th>Material</th>
                    <th>Condição</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($itens as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->instituicao->name ?? 'N/A' }}</td>
                        <td>{{ $item->material }}</td>
                        <td>{{ $item->condicao }}</td>
                        <td>{{ $item->quantidade }}</td>
                        <td>
                            <form action="{{ route('mateirais_coletado.destroy', $item->id) }}" method="POST"
                                  onsubmit="return confirm('Deseja realmente excluir este item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
