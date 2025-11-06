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

Route::resource('usuarios', UsuarioController::class);

Route::resource('instituicao', InstituicaoController::class);

Route::resource('materiaisColetados', Mateirais_coletadoController::class);

Route::resource('estoque', EstoqueController::class);

Route::resource('itemDoado', Item_doadoController::class);

Route::resource('pontoColeta', Ponto_de_coletaController::class);

Route::resource('materiais', MateriaisController::class);