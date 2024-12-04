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
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\AcompanharController;
use App\Http\Controllers\PedidoItemController;
use App\Http\Controllers\StatusController;

// Redirecionar raiz para home
// Rota de teste
Route::get('/teste-carousel', [TesteController::class, 'carregarProdutosCarousel'])->name('teste.carousel');

Route::get('/', function () {
    return redirect('/home');
});
// Rotas protegidas por autenticação

// Rotas Públicas
Route::group([], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/todos_produtos', [ProdutoController::class, 'todosProdutos'])->name('produtos.todos');
    Route::get('/produto/{produto}', [ProdutoController::class, 'show'])->name('produto.show');
    Route::get('/categoria', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categoria/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');
    Route::get('/produtos/categoria/{nome}', [ProdutoController::class, 'filtrar'])->name('produtos.categoria');
// Rotas protegidas por autenticação
Route::get('/', [HomeController::class, 'index']);

    // Rota para o método 'filtrar' no controlador
    Route::get('/produtos/filtrar', [ProdutoController::class, 'filtrar'])->name('produtos.filtrar');

    Route::post('/verificar-estoque', [ProdutoController::class, 'verificarEstoque']);
    Route::get('/search', [SearchController::class, 'results'])->name('search.results');

    // Rota para exibir o histórico de pedidos (opcional, dependendo da estrutura)
    // Pode ser acessada via ProfileController@show
    // Route::get('/historico', [PedidoItemController::class, 'index'])->name('historico.index');
});

// Rotas Protegidas por Autenticação
Route::middleware('auth')->group(function () {
    // Rotas para carrinho
    Route::get('carrinho/{produto}', [CarrinhoController::class, 'addCarrinho']);
    Route::get('carrinho', [CarrinhoController::class, 'carrinho']);
    Route::get('carrinho', [CarrinhoController::class, 'carrinho'])->name('carrinho.exibir');
    Route::post('carrinho/atualizar/{produto}', [CarrinhoController::class, 'atualizarCarrinho'])->name('carrinho.atualizar');
    Route::post('carrinho/remover/{produto}', [CarrinhoController::class, 'removerDoCarrinho'])->name('carrinho.remover');
    Route::post('/carrinho/adicionar', [CarrinhoController::class, 'addCarrinho'])->name('carrinho.adicionar');
   

    Route::post('/pedido/finalizar', [PedidoController::class, 'finalizarPedido'])->name('pedido.finalizar');

    // Rotas para perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show'); // Nova rota para exibir o perfil
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rota para Histórico de Pedidos
    Route::get('/historico_pedidos', [PedidoItemController::class, 'index'])->name('historico_pedidos.index');
});

// Rotas públicas
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/todos_produtos', [ProdutoController::class, 'todosProdutos'])->name('produtos.todos');
// Rotas de Autenticação
require __DIR__ . '/auth.php';
// Route::get('/acompanhar_pedido', [AcompanharController::class, 'index']);

Route::get('/status', [StatusController::class, 'index']);

// Rota para histórico de pedidos
Route::get('/historico_pedidos', [PedidoController::class, 'index']);

Route::get('/historico_pedidos', [PedidoItemController::class, 'index']);



// Rotas públicas
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/todos_produtos', [ProdutoController::class, 'todosProdutos'])->name('produtos.todos');

// Rota para verificar o estoque (pública)
Route::post('/verificar-estoque', [ProdutoController::class, 'verificarEstoque']);

// Rota extra para login (fora do middleware de autenticação)
Route::get('enviado', [LoginController::class, 'sent']);






