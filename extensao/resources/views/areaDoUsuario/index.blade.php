@extends('layouts.areaUsuario')

@section('content')
<style>
    .dashboard-container {
        display: flex;
        gap: 2rem;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 2rem;
    }

    .card-dashboard {
        flex: 1 1 300px;
        max-width: 450px;
        height: 250px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card-dashboard:hover {
        transform: scale(1.03);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
    }

    .card-doados {
        background-color: #ffc9c9;
    }

    .card-recebidos {
        background-color: #b7f7c5;
    }

    h1 {
        text-align: left;
        font-size: 2rem;
        color: var(--cor-preto);
        margin-bottom: 1rem;
    }
</style>

<h1>Dashboard do Usuário</h1>

<div class="dashboard-container">
    <div class="card-dashboard card-doados">
        Quantidade Doação feitas:
        <span class="ms-2 text-dark fw-bold">{{ $itensDoados ?? 0 }}</span>
    </div>

    <div class="card-dashboard card-recebidos">
    Quantidade Doação Recebidas:
        <span class="ms-2 text-dark fw-bold">{{ $itensRecebidos ?? 0 }}</span>
    </div>
</div>
@endsection
