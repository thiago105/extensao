<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\Mateirais_coletadoController;
use App\Http\Controllers\EstoqueInstituicaoController;
use App\Http\Controllers\Item_doadoController;
use App\Http\Controllers\Ponto_de_coletaController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\InstituicaoLoginController;
use App\Http\Controllers\DoacaoRecebidaController;
use App\Http\Controllers\AreaDoUsuarioController;
use App\Http\Controllers\AreaDaIntituicaoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('/cadastro', 'cadastro.index')->name('cadastro.index');

// Login geral
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Cadastro
Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::get('/instituicao/create', [InstituicaoController::class, 'create'])->name('instituicao.create');
Route::post('/instituicao', [InstituicaoController::class, 'store'])->name('instituicao.store');

// Login instituição
Route::get('/instituicao/login', [InstituicaoLoginController::class, 'showLoginForm'])->name('instituicao.login.form');
Route::post('/instituicao/login', [InstituicaoLoginController::class, 'login'])->name('instituicao.login');

// Rotas para Usuarios
Route::middleware(['auth.ambos'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Usuários
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/{id}', [UsuarioController::class, 'show'])->name('usuarios.show');
    Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

    // Area do usuário
    Route::get('/area-do-usuario', [AreaDoUsuarioController::class, 'index'])->name('areaDoUsuario.index');
    Route::get('/area-do-usuario/solicitar-doacao', [AreaDoUsuarioController::class, 'solicitarDoacao'])->name('areaDoUsuario.solicitarDoacao');
    Route::get('/area-do-usuario/ponto-de-coleta', [AreaDoUsuarioController::class, 'pontoDeColeta'])->name('areaDoUsuario.pontoDeColeta');
    Route::get('/area-do-usuario/dashboard', [AreaDoUsuarioController::class, 'dashboard'])->name('areaDoUsuario.dashboard');
    Route::get('/area-do-usuario/pedidos', [AreaDoUsuarioController::class, 'pedidos'])->name('areaDoUsuario.pedidos');
    Route::get('/area-do-usuario/perfilUsuario', [AreaDoUsuarioController::class, 'perfilUsuario'])->name('areaDoUsuario.perfilUsuario');
});


// ==========================
// rotas para instituições
// ==========================
Route::middleware('auth:instituicao')->group(function () {

    //areaDaInstituicao
    Route::get('/area-da-instituicao', [AreaDaIntituicaoController::class, 'index'])->name('areaDaInstituicao.index');
    Route::get('/area-da-instituicao/estoque', [AreaDaIntituicaoController::class, 'estoque'])->name('areaDaInstituicao.estoque');
    Route::get('/area-da-instituicao/pedidos-de-doacao', [AreaDaIntituicaoController::class, 'pedidosDeDoacao'])->name('areaDaInstituicao.pedidosDeDoacao');

    Route::get('/area-da-instituicao/perfil', [AreaDaIntituicaoController::class, 'perfilInstituicao'])->name('areaDaInstituicao.perfilInstituicao');
    Route::get('/area-da-instituicao/material', [AreaDaIntituicaoController::class, 'material'])->name('areaDaInstituicao.material');


    Route::get('/instituicao', [InstituicaoController::class, 'index'])->name('instituicao.index');
    Route::get('/instituicao/{id}', [InstituicaoController::class, 'show'])->name('instituicao.show');
    Route::get('/instituicao/{id}/edit', [InstituicaoController::class, 'edit'])->name('instituicao.edit');
    Route::put('/instituicao/{id}', [InstituicaoController::class, 'update'])->name('instituicao.update');
    Route::delete('/instituicao/{id}', [InstituicaoController::class, 'destroy'])->name('instituicao.destroy');



    // Estoque
    Route::get('/estoque', [EstoqueInstituicaoController::class, 'index'])->name('estoque.index');
    Route::get('/estoque/create', [EstoqueInstituicaoController::class, 'create'])->name('estoque.create');
    Route::post('/estoque', [EstoqueInstituicaoController::class, 'store'])->name('estoque.store');
    Route::get('/estoque/{id}', [EstoqueInstituicaoController::class, 'show'])->name('estoque.show');
    Route::get('/estoque/{id}/edit', [EstoqueInstituicaoController::class, 'edit'])->name('estoque.edit');
    Route::put('/estoque/{id}', [EstoqueInstituicaoController::class, 'update'])->name('estoque.update');
    Route::delete('/estoque/{id}', [EstoqueInstituicaoController::class, 'destroy'])->name('estoque.destroy');

    // Material
    Route::get('/material', [MaterialController::class, 'index'])->name('material.index');
    Route::get('/material/create', [MaterialController::class, 'create'])->name('material.create');
    Route::post('/material', [MaterialController::class, 'store'])->name('material.store');
    Route::get('/material/{id}', [MaterialController::class, 'show'])->name('material.show');
    Route::get('/material/{id}/edit', [MaterialController::class, 'edit'])->name('material.edit');
    Route::put('/material/{id}', [MaterialController::class, 'update'])->name('material.update');
    Route::delete('/material/{id}', [MaterialController::class, 'destroy'])->name('material.destroy');

    // Doações
    Route::get('/doacoes', [DoacaoRecebidaController::class, 'index'])->name('doacoes.index');
    Route::get('/doacoes/create', [DoacaoRecebidaController::class, 'create'])->name('doacoes.create');
    Route::post('/doacoes', [DoacaoRecebidaController::class, 'store'])->name('doacoes.store');
    Route::get('/doacoes/{id}', [DoacaoRecebidaController::class, 'show'])->name('doacoes.show');
    Route::get('/doacoes/{id}/edit', [DoacaoRecebidaController::class, 'edit'])->name('doacoes.edit');
    Route::put('/doacoes/{id}', [DoacaoRecebidaController::class, 'update'])->name('doacoes.update');
    Route::delete('/doacoes/{id}', [DoacaoRecebidaController::class, 'destroy'])->name('doacoes.destroy');

    // Pontos de coleta
    Route::get('/ponto-de-coleta/create', [Ponto_de_coletaController::class, 'create'])->name('pontoDeColeta.create');
    Route::post('/ponto-de-coleta', [Ponto_de_coletaController::class, 'store'])->name('pontoDeColeta.store');
    Route::get('/ponto-de-coleta/{id}', [Ponto_de_coletaController::class, 'show'])->name('pontoDeColeta.show');
    Route::get('/ponto-de-coleta/{id}/edit', [Ponto_de_coletaController::class, 'edit'])->name('pontoDeColeta.edit');
    Route::put('/ponto-de-coleta/{id}', [Ponto_de_coletaController::class, 'update'])->name('pontoDeColeta.update');

    Route::get('/area-da-instituicao/ponto-de-coleta', [Ponto_de_coletaController::class, 'index'])
        ->name('areaDaInstituicao.pontoDeColeta.index');

    Route::get('/area-da-instituicao/ponto-de-coleta/novo', [Ponto_de_coletaController::class, 'create'])
        ->name('areaDaInstituicao.pontoDeColeta.create');

    Route::post('/area-da-instituicao/ponto-de-coleta', [Ponto_de_coletaController::class, 'store'])
        ->name('areaDaInstituicao.pontoDeColeta.store');

    Route::get('/area-da-instituicao/ponto-de-coleta/{id}/editar', [Ponto_de_coletaController::class, 'edit'])
        ->name('areaDaInstituicao.pontoDeColeta.edit');

    Route::put('/area-da-instituicao/ponto-de-coleta/{id}', [Ponto_de_coletaController::class, 'update'])
        ->name('areaDaInstituicao.pontoDeColeta.update');


    Route::delete('/area-da-instituicao/ponto-de-coleta/{id}', [Ponto_de_coletaController::class, 'destroy'])
        ->name('areaDaInstituicao.pontoDeColeta.destroy');
});


Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
