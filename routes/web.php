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
Route::get('/produtos/{produto}/editar', [ProdutoController::class, 'edit'])->name('produtos.edit')->middleware('auth:negocio');
Route::put('/produtos/{produto}', [ProdutoController::class, 'update'])->name('produtos.update')->middleware('auth:negocio');
Route::delete('/produtos/{produto}', [ProdutoController::class, 'destroy'])->name('produtos.destroy')->middleware('auth:negocio');

// Perfil / Minhas Informações
Route::get('/minhas-informacoes', [NegocioController::class, 'info'])->name('minhas_informacoes')->middleware('auth:negocio');
Route::get('/perfil/editar', [NegocioController::class, 'editProfile'])->name('perfil.editar')->middleware('auth:negocio');
Route::put('/perfil', [NegocioController::class, 'updateProfile'])->name('perfil.atualizar')->middleware('auth:negocio');

Route::get('/testes',function(){
    return "Olá Mundo";
});