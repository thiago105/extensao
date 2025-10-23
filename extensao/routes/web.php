<?php

use App\Models\Usuario;
use App\Models\Instituicao;
use App\Models\Mateirais_coletado;
use App\Models\Estoque;
use App\Models\Item_doado;
use App\Models\Ponto_de_coleta;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuarios', function () {
    return Usuario::get();
});


Route::get('/instituicaos', function () {
    return Instituicao::get();
});

Route::get('/materiaisColetados', function () {
    return Mateirais_coletado::get();
});

Route::get('/estoque', function () {
    return Estoque::get();
});

Route::get('/itemDoado', function () {
    return Item_doado::get();
});

Route::get('/pontoColeta', function () {
    return Ponto_de_coleta::get();
});