<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\Mateirais_coletadoController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\Item_doadoController;
use App\Http\Controllers\Ponto_de_coletaController;
use App\Http\Controllers\MateriaisController;

use App\Http\Controllers\DoacaoController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('/cadastro', 'cadastro.index')->name('cadastro.index');

Route::resource('usuarios', UsuarioController::class);

Route::resource('instituicao', InstituicaoController::class);

Route::resource('mateirais_coletado', Mateirais_coletadoController::class);

Route::resource('estoque', EstoqueController::class);

Route::resource('itemDoado', Item_doadoController::class);

Route::resource('pontoColeta', Ponto_de_coletaController::class);

Route::resource('materiais', MateriaisController::class);

Route::resource('doacoes', DoacaoController::class);