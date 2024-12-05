<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CarrinhoController,
    ProdutoController,
    CategoriaController,
    ProfileController,
    HomeController,
    LoginController,
    SearchController,
    TesteController,
    PedidoController,
    PedidoItemController
};

// Redirecionar raiz para home
Route::get('/', function () {
    return redirect('/home');
});

// Rotas Públicas
Route::group([], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/todos_produtos', [ProdutoController::class, 'todosProdutos'])->name('produtos.todos');
    Route::get('/produto/{produto}', [ProdutoController::class, 'show'])->name('produto.show');
    Route::get('/categoria', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categoria/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');
    Route::get('/produtos/categoria/{nome}', [ProdutoController::class, 'filtrar'])->name('produtos.categoria');


    // Rota para o método 'filtrar' no controlador
    Route::get('/produtos/filtrar', [ProdutoController::class, 'filtrar'])->name('produtos.filtrar');

    Route::post('/verificar-estoque', [ProdutoController::class, 'verificarEstoque']);
    Route::get('/search', [SearchController::class, 'results'])->name('search.results');


});

// Rotas Protegidas por Autenticação
Route::middleware('auth')->group(function () {
    // Rotas para carrinho
    Route::get('carrinho', [CarrinhoController::class, 'carrinho'])->name('carrinho.exibir');
    Route::post('carrinho/atualizar/{produto}', [CarrinhoController::class, 'atualizarCarrinho'])->name('carrinho.atualizar');
    Route::post('carrinho/remover/{produto}', [CarrinhoController::class, 'removerDoCarrinho'])->name('carrinho.remover');
    Route::post('/carrinho/adicionar', [CarrinhoController::class, 'addCarrinho'])->name('carrinho.adicionar');
    Route::post('/pedido/finalizar', [PedidoController::class, 'finalizarPedido'])->name('pedido.finalizar');

    // Rotas para perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show'); // Nova rota para exibir o perfil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rota para Histórico de Pedidos
    Route::get('/historico_pedidos', [PedidoItemController::class, 'index'])->name('historico_pedidos.index');
});

// Rotas de Autenticação
require __DIR__ . '/auth.php';

// Rota para logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rota extra para login (fora do middleware de autenticação)
Route::get('enviado', [LoginController::class, 'sent']);
