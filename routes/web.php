<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NegocioController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
//Rotas responsaveis por carregara view de cadastro e realizar a logica de cadastro
Route::get('/cadastro',[NegocioController::class,'indexCadastro'])->name('form_cadastro_negocio');
Route::post('/cadastro',[NegocioController::class,'cadastro'])->name('cadastro_negocio');

Route::get('/login',[AuthController::class,'index'])->name('form_login_negocio');
Route::post('/login',[AuthController::class,'logar'])->name('login_negocio');

Route::get('/home',[AuthController::class,'home'])->name('home')->middleware('auth:negocio');

Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::get('/cadastro-produto',[ProdutoController::class,'index'])->name('form_cadastro_produto')->middleware('auth:negocio');
Route::post('/cadastro-produto',[ProdutoController::class,'cadastrar'])->name('cadastro_produto')->middleware('auth:negocio');

Route::get('/testes',function(){
    return "Olá Mundo";
});