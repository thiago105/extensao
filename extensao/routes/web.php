<?php

use App\Models\Usuario;
use App\Models\Instituicao;
use App\Models\Mateirais_coletado;
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