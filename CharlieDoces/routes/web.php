<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarrinhoController;
use Illuminate\Support\Facades\Route;

// Rota inicial
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rotas para exibição de produtos e categorias
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
Route::get('/produto/{produto}', [ProdutoController::class, 'show'])->name('produto.show');
Route::get('/categoria', [CategoriaController::class, 'index'])->name('categoria.index');
Route::get('/categoria/{categoria}', [CategoriaController::class, 'show'])->name('categoria.show');

// Rotas de carrinho (protegidas para usuários autenticados)
Route::middleware(['auth'])->group(function () {
    Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
    Route::get('/carrinho/add/{produto}', [CarrinhoController::class, 'addCarrinho'])->name('carrinho.add');
});

// Rotas de autenticação
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rotas para o perfil do usuário (protegidas para usuários autenticados)
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [ProfileController::class, 'index'])->name('perfil');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Middleware adicional para rotas verificadas
Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home.verified');

// Carrega as rotas de autenticação padrão do Laravel (registro, recuperação de senha, etc.)
require __DIR__.'/auth.php';

Route::get('/produtos/buscar', [ProdutoController::class, 'buscar'])->name('produtos.buscar');
