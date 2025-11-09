<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Registrar Doação</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        :root {
            --bg: #f5f7fa;
            --card: #ffffff;
            --primary: #2b6cb0;
            --accent: #4CAF50;
            --muted: #6b7280;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--bg);
            margin: 0;
            padding: 20px;
            color: #222;
        }
        .container {
            max-width: 900px;
            margin: 24px auto;
            background: var(--card);
            border-radius: 10px;
            padding: 24px;
            box-shadow: 0 6px 20px rgba(27,31,35,0.08);
        }
        h1 {
            margin: 0 0 18px 0;
            font-size: 22px;
            color: var(--primary);
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        label { display:block; font-weight:600; margin-bottom:6px; color:var(--muted); font-size:14px; }
        select, input[type="text"], input[type="date"], input[type="number"] {
            width:100%;
            padding:10px 12px;
            border:1px solid #d1d5db;
            border-radius:6px;
            background:#fff;
            font-size:14px;
            box-sizing: border-box;
        }

        .full { grid-column: 1 / -1; } /* elemento ocupa a linha inteira */

        .actions {
            display:flex;
            gap:10px;
            justify-content:flex-end;
            align-items:center;
            margin-top:6px;
            grid-column: 1 / -1;
        }

        button {
            background: var(--accent);
            color: #fff;
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight:700;
        }
        button.secondary {
            background: transparent;
            color: #333;
            border: 1px solid #e5e7eb;
            font-weight:600;
        }

        .help { font-size:13px; color:#6b7280; margin-top:6px; }

        @media (max-width:720px){
            form { grid-template-columns: 1fr; }
            .actions { justify-content: center; }
        }

        .alert { padding:10px 12px; border-radius:6px; background:#fffbeb; border:1px solid #fef3c7; color:#92400e; margin-bottom:12px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registrar Doação</h1>

        {{-- Mensagens --}}
        @if ($errors->any())
            <div class="alert">
                <strong>Erro:</strong> Verifique os campos e tente novamente.
                <ul style="margin:8px 0 0 16px;">
                    @foreach ($errors->all() as $error)
                        <li style="font-size:13px">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert" style="background:#ecfdf5;border-color:#bbf7d0;color:#065f46;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Normaliza nomes de variáveis (fallbacks) --}}
        @php
            $institutions = isset($instituicoes) ? $instituicoes : (isset($instituicaos) ? $instituicaos : collect());
            $materials = isset($materiais) ? $materiais : (isset($mateirais_coletados) ? $mateirais_coletados : collect());
            $users = isset($usuarios) ? $usuarios : (isset($usuarios) ? $usuarios : collect());
        @endphp

        <form action="{{ route('doacoes.store') }}" method="POST">
        @csrf

            <div>
                <label for="id_instituicao">Instituição</label>
                <select id="id_instituicao" name="id_instituicao" required>
                    <option value="">Selecione a instituição</option>
                    @foreach($institutions as $inst)
                        {{-- tenta exibir ->nome, senão ->name --}}
                        <option value="{{ $inst->id }}">{{ $inst->nome ?? $inst->name ?? 'Instituição ' . $inst->id }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="id_usuario">Usuário</label>
                <select id="id_usuario" name="id_usuario" required>
                    <option value="">Selecione o usuário</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->nome ?? $u->name ?? $u->email ?? ('Usuário ' . $u->id) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="tipo">Tipo de Doação</label>
                <select id="tipo" name="tipo" required>
                    <option value="material">Material</option>
                    <option value="dinheiro">Dinheiro</option>
                </select>
                <div class="help">Selecione "Material" para escolher item do estoque; "Dinheiro" para doação financeira.</div>
            </div>

            <div>
                <label for="id_material">Material</label>
                <select id="id_material" name="id_material">
                    <option value="">-- selecione o material --</option>
                    @foreach($materials as $m)
                        {{-- tenta exibir campo 'material' ou 'nome' --}}
                        <option value="{{ $m->id }}">{{ $m->material ?? $m->nome ?? ('Material ' . $m->id) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="quantidade">Quantidade</label>
                <input id="quantidade" name="quantidade" type="number" min="1" placeholder="Ex: 10">
            </div>

            <div class="full">
                <label for="endereco_destino">Endereço de Destino</label>
                <input id="endereco_destino" name="endereco_destino" type="text" placeholder="Rua, número, bairro, cidade...">
            </div>

            <div>
                <label for="data_prevista_entrega">Data Prevista de Entrega</label>
                <input id="data_prevista_entrega" name="data_prevista_entrega" type="date">
            </div>

            <div class="actions">
                <a href="{{ url()->previous() }}" class="secondary-btn">
                    <button type="button" class="secondary">Cancelar</button>
                </a>

                <button type="submit">Registrar Doação</button>
            </div>
        </form>
    </div>

    <script>
        // Toggle do campo material/quantidade baseado no tipo
        (function(){
            const tipo = document.getElementById('tipo');
            const material = document.getElementById('id_material');
            const quantidade = document.getElementById('quantidade');

            function toggleFields() {
                if (tipo.value === 'material') {
                    material.required = true;
                    quantidade.required = true;
                    material.parentNode.style.opacity = "1";
                    quantidade.parentNode.style.opacity = "1";
                } else {
                    material.required = false;
                    quantidade.required = false;
                    material.value = "";
                    quantidade.value = "";
                    material.parentNode.style.opacity = "0.6";
                    quantidade.parentNode.style.opacity = "0.6";
                }
            }

            tipo.addEventListener('change', toggleFields);
            // Inicializa no estado atual
            toggleFields();
        })();
    </script>
</body>
</html>
