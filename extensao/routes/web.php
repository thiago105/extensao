<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\Mateirais_coletadoController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\Item_doadoController;
use App\Http\Controllers\Ponto_de_coletaController;
use App\Http\Controllers\MateriaisController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\InstituicaoLoginController;
use App\Http\Controllers\DoacaoController;
use App\Http\Controllers\AreaDoUsuarioController;
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

    // Itens doados
    Route::get('/itemDoado', [Item_doadoController::class, 'index'])->name('itemDoado.index');
    Route::get('/itemDoado/create', [Item_doadoController::class, 'create'])->name('itemDoado.create');
    Route::post('/itemDoado', [Item_doadoController::class, 'store'])->name('itemDoado.store');
    Route::get('/itemDoado/{id}', [Item_doadoController::class, 'show'])->name('itemDoado.show');
    Route::get('/itemDoado/{id}/edit', [Item_doadoController::class, 'edit'])->name('itemDoado.edit');
    Route::put('/itemDoado/{id}', [Item_doadoController::class, 'update'])->name('itemDoado.update');
    Route::delete('/itemDoado/{id}', [Item_doadoController::class, 'destroy'])->name('itemDoado.destroy');

    // Materiais
    Route::get('/materiais', [MateriaisController::class, 'index'])->name('materiais.index');
    Route::get('/materiais/create', [MateriaisController::class, 'create'])->name('materiais.create');
    Route::post('/materiais', [MateriaisController::class, 'store'])->name('materiais.store');
    Route::get('/materiais/{id}', [MateriaisController::class, 'show'])->name('materiais.show');
    Route::get('/materiais/{id}/edit', [MateriaisController::class, 'edit'])->name('materiais.edit');
    Route::put('/materiais/{id}', [MateriaisController::class, 'update'])->name('materiais.update');
    Route::delete('/materiais/{id}', [MateriaisController::class, 'destroy'])->name('materiais.destroy');
});


// ==========================
// rotas para instituições
// ==========================
Route::middleware('auth:instituicao')->group(function () {

    Route::get('/instituicao', [InstituicaoController::class, 'index'])->name('instituicao.index');
    Route::get('/instituicao/{id}', [InstituicaoController::class, 'show'])->name('instituicao.show');
    Route::get('/instituicao/{id}/edit', [InstituicaoController::class, 'edit'])->name('instituicao.edit');
    Route::put('/instituicao/{id}', [InstituicaoController::class, 'update'])->name('instituicao.update');
    Route::delete('/instituicao/{id}', [InstituicaoController::class, 'destroy'])->name('instituicao.destroy');

    // Estoque
    Route::get('/estoque', [EstoqueController::class, 'index'])->name('estoque.index');
    Route::get('/estoque/create', [EstoqueController::class, 'create'])->name('estoque.create');
    Route::post('/estoque', [EstoqueController::class, 'store'])->name('estoque.store');
    Route::get('/estoque/{id}', [EstoqueController::class, 'show'])->name('estoque.show');
    Route::get('/estoque/{id}/edit', [EstoqueController::class, 'edit'])->name('estoque.edit');
    Route::put('/estoque/{id}', [EstoqueController::class, 'update'])->name('estoque.update');
    Route::delete('/estoque/{id}', [EstoqueController::class, 'destroy'])->name('estoque.destroy');

    // Doações
    Route::get('/doacoes', [DoacaoController::class, 'index'])->name('doacoes.index');
    Route::get('/doacoes/create', [DoacaoController::class, 'create'])->name('doacoes.create');
    Route::post('/doacoes', [DoacaoController::class, 'store'])->name('doacoes.store');
    Route::get('/doacoes/{id}', [DoacaoController::class, 'show'])->name('doacoes.show');
    Route::get('/doacoes/{id}/edit', [DoacaoController::class, 'edit'])->name('doacoes.edit');
    Route::put('/doacoes/{id}', [DoacaoController::class, 'update'])->name('doacoes.update');
    Route::delete('/doacoes/{id}', [DoacaoController::class, 'destroy'])->name('doacoes.destroy');

    // Materiais coletados
    Route::get('/materiaisColetado', [Mateirais_coletadoController::class, 'index'])->name('mateirais_coletado.index');
    Route::get('/materiaisColetado/create', [Mateirais_coletadoController::class, 'create'])->name('mateirais_coletado.create');
    Route::post('/materiaisColetado', [Mateirais_coletadoController::class, 'store'])->name('mateirais_coletado.store');
    Route::get('/materiaisColetado/{id}', [Mateirais_coletadoController::class, 'show'])->name('mateirais_coletado.show');
    Route::get('/materiaisColetado/{id}/edit', [Mateirais_coletadoController::class, 'edit'])->name('mateirais_coletado.edit');
    Route::put('/materiaisColetado/{id}', [Mateirais_coletadoController::class, 'update'])->name('mateirais_coletado.update');
    Route::delete('/materiaisColetado/{id}', [Mateirais_coletadoController::class, 'destroy'])->name('mateirais_coletado.destroy');

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
