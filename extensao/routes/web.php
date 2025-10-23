<?php

use App\Models\Instituicao;
use App\Models\Usuario;
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