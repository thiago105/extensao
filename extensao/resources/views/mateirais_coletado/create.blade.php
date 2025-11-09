<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Material Escolar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            color: #555;
        }

        input,
        textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            width: 100%;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .voltar {
            display: block;
            text-align: center;
            margin-top: 15px;
        }

        .voltar a {
            text-decoration: none;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Cadastrar Material Escolar</h2>

        <form action="{{ route('mateirais_coletado.store') }}" method="POST">
        @csrf

<label for="id_instituicao">Instituição:</label>
<select name="id_instituicao" required>
    <option value="">Selecione uma instituição</option>
    @foreach($instituicaos as $inst)
        <option value="{{ $inst->id }}">{{ $inst->id }} - {{ $inst->name ?? 'Sem nome' }}</option>
    @endforeach
</select>

    <label for="material">Nome do Material:</label>
    <input type="text" name="material" required placeholder="Ex: Caderno, lápis">

    <label for="condicao">Condição:</label>
    <input type="text" name="condicao" required placeholder="Ex: Novo, Usado">

    <label for="quantidade">Quantidade:</label>
    <input type="number" name="quantidade" required min="1" placeholder="Ex: 50">

    <button type="submit">Salvar</button>
</form>


        <div class="voltar">
            <a href="{{ route('estoque.index') }}">← Voltar para lista de materiais</a>
        </div>
    </div>
</body>

</html>
