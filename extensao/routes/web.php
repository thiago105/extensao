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

    // Materiais
    Route::get('/materiais', [MaterialController::class, 'index'])->name('materiais.index');
    Route::get('/materiais/create', [MaterialController::class, 'create'])->name('materiais.create');
    Route::post('/materiais', [MaterialController::class, 'store'])->name('materiais.store');
    Route::get('/materiais/{id}', [MaterialController::class, 'show'])->name('materiais.show');
    Route::get('/materiais/{id}/edit', [MaterialController::class, 'edit'])->name('materiais.edit');
    Route::put('/materiais/{id}', [MaterialController::class, 'update'])->name('materiais.update');
    Route::delete('/materiais/{id}', [MaterialController::class, 'destroy'])->name('materiais.destroy');
});


// ==========================
// rotas para instituições
// ==========================
Route::middleware('auth:instituicao')->group(function () {

    //areaDaInstituicao
    Route::get('/area-da-instituicao', [AreaDaIntituicaoController::class,'index'])->name('areaDaInstituicao.index');
    Route::get('/area-da-instituicao/estoque', [AreaDaIntituicaoController::class,'estoque'])->name('areaDaInstituicao.estoque');
    Route::get('/area-da-instituicao/pedidos-de-doacao', [AreaDaIntituicaoController::class,'pedidosDeDoacao'])->name('areaDaInstituicao.pedidosDeDoacao');
    Route::get('/area-da-instituicao/ponto-de-coleta', [AreaDaIntituicaoController::class,'pontoDeColeta'])->name('areaDaInstituicao.pontoDeColeta');
    Route::get('/area-da-instituicao/perfil', [AreaDaIntituicaoController::class,'perfilInstituicao'])->name('areaDaInstituicao.perfilInstituicao');


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

    // Doações
    Route::get('/doacoes', [DoacaoRecebidaController::class, 'index'])->name('doacoes.index');
    Route::get('/doacoes/create', [DoacaoRecebidaController::class, 'create'])->name('doacoes.create');
    Route::post('/doacoes', [DoacaoRecebidaController::class, 'store'])->name('doacoes.store');
    Route::get('/doacoes/{id}', [DoacaoRecebidaController::class, 'show'])->name('doacoes.show');
    Route::get('/doacoes/{id}/edit', [DoacaoRecebidaController::class, 'edit'])->name('doacoes.edit');
    Route::put('/doacoes/{id}', [DoacaoRecebidaController::class, 'update'])->name('doacoes.update');
    Route::delete('/doacoes/{id}', [DoacaoRecebidaController::class, 'destroy'])->name('doacoes.destroy');

    // Pontos de coleta
    Route::get('/pontoColeta', [Ponto_de_coletaController::class, 'index'])->name('pontoColeta.index');
    Route::get('/pontoColeta/create', [Ponto_de_coletaController::class, 'create'])->name('pontoColeta.create');
    Route::post('/pontoColeta', [Ponto_de_coletaController::class, 'store'])->name('pontoColeta.store');
    Route::get('/pontoColeta/{id}', [Ponto_de_coletaController::class, 'show'])->name('pontoColeta.show');
    Route::get('/pontoColeta/{id}/edit', [Ponto_de_coletaController::class, 'edit'])->name('pontoColeta.edit');
    Route::put('/pontoColeta/{id}', [Ponto_de_coletaController::class, 'update'])->name('pontoColeta.update');
    Route::delete('/pontoColeta/{id}', [Ponto_de_coletaController::class, 'destroy'])->name('pontoColeta.destroy');
});


Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
