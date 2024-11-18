<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TesteController;

// Rota de teste
Route::get('/teste-final', [TesteController::class, 'testeFinal']);

// Rotas protegidas por autenticação
Route::get('/', [HomeController::class, 'index']);

Route::get('register', [RegisteredUserController::class, 'showRegisterForm']);


Route::middleware('auth')->group(function () {
    // Rotas para carrinho
    Route::get('carrinho/{produto}', [CarrinhoController::class, 'addCarrinho']);
    Route::get('carrinho', [CarrinhoController::class, 'carrinho']);
    Route::post('carrinho/addQuantidadeItens/{produto}', [CarrinhoController::class, 'addQuantidadeItens'])->name('carrinho.addQuantidadeItens');
    Route::post('carrinho/delQuantidadeItens/{produto}', [CarrinhoController::class, 'delQuantidadeItens'])->name('carrinho.delQuantidadeItens');
    Route::patch('carrinho/{produto}', [CarrinhoController::class, 'updateQuantidadeItens'])->name('carrinho.updateQuantidadeItens');
    Route::post('carrinho/deleteCarrinho/{produto}', [CarrinhoController::class, 'deleteCarrinho'])->name('carrinho.deleteCarrinho');

    // Rotas para produtos individuais e categorias (protegidas)
    Route::get('/produto/{produto}', [ProdutoController::class, 'show'])->name('produto.show');
    Route::get('/categoria', [CategoriaController::class, 'index']);
    Route::get('/categoria/{categoria}', [CategoriaController::class, 'show']);

    // Rotas para perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rotas públicas
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/todos_produtos', [ProdutoController::class, 'todosProdutos'])->name('produtos.todos');

// Rota para verificar o estoque (pública)
Route::post('/verificar-estoque', [ProdutoController::class, 'verificarEstoque']);

// Rota para logout usando LoginController
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rota extra para login (fora do middleware de autenticação)
Route::get('enviado', [LoginController::class, 'sent']);

// Rota para buscar produtos por categoria (pública ou protegida conforme necessidade)
Route::get('/produtos/categoria/{nome}', [ProdutoController::class, 'produtosPorCategoria'])->name('produtos.categoria');

// Carregar rotas de autenticação padrão
require __DIR__ . '/auth.php';

// Rota de busca
Route::get('/search', [SearchController::class, 'results'])->name('search.results');
