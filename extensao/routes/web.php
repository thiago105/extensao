<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\Mateirais_coletadoController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\Item_doadoController;
use App\Http\Controllers\Ponto_de_coletaController;
use App\Http\Controllers\MateriaisController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

// Cadastro unificado (exibição)
Route::view('cadastroUsuario', 'cadastroUsuario')->name('cadastroUsuario');

// Rota para exibir o formulário de cadastro de usuário
Route::get('/cadastroUsuario', [App\Http\Controllers\UsuarioController::class, 'create'])->name('usuarios.create');

// Rota para salvar os dados do formulário
Route::post('/cadastroUsuario', [App\Http\Controllers\UsuarioController::class, 'store'])->name('usuarios.store');

Route::resource('usuarios', UsuarioController::class);

Route::resource('instituicao', InstituicaoController::class);

Route::resource('materiaisColetados', Mateirais_coletadoController::class);

Route::resource('estoque', EstoqueController::class);

Route::resource('itemDoado', Item_doadoController::class);

Route::resource('pontoColeta', Ponto_de_coletaController::class);

Route::resource('materiais', MateriaisController::class);