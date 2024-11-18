<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarrinhoController;

Route::get('/', [HomeController::class, 'index']);

Route::group(['middleware' => ['auth']], function () {

    Route::post('carrinho/{produto}/adicionar', [CarrinhoController::class, 'addCarrinho'])->name('carrinho.adicionar');
    Route::post('carrinho/{produto}/remover', [CarrinhoController::class, 'removeCarrinho'])->name('carrinho.remover');
    
    



    // Rotas para produtos
    Route::get('/produto/{produto}', [ProdutoController::class, 'show'])->name('produto.show');
    Route::get('/produtos', [ProdutoController::class, 'index']);
    Route::get('/todos_produtos', [ProdutoController::class, 'todosProdutos'])->name('produtos.todos');
    
    // Rotas para categorias
    Route::get('/categoria', [CategoriaController::class, 'index']);
    Route::get('/categoria/{categoria}', [CategoriaController::class, 'show']);
    
    // Rota para perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rota para home e logout
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Rota extra para login
Route::get('enviado', [LoginController::class, 'sent']);

require __DIR__.'/auth.php';
