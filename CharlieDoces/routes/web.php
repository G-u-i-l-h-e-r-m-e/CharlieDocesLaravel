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
    Route::get('carrinho/{produto}', [CarrinhoController::class, 'addCarrinho']);
    Route::get('carrinho', [CarrinhoController::class, 'carrinho']);
});

<<<<<<< HEAD
Route::get('/categoria', [CategoriaController::class,'index']);
Route::get('/categoria/{categoria}', [CategoriaController::class,'show']);
Route::get('/produtos', [ProdutoController::class,'index']);
=======
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('enviado', [LoginController::class, 'sent']);

Route::get('/categoria', [CategoriaController::class, 'index']);
Route::get('/categoria/{categoria}', [CategoriaController::class, 'show']); //passado categoria como parâmetro 
Route::get('/produtos', [ProdutoController::class, 'index']);
>>>>>>> 4fb1552c8a6409db0076942619d502e1134b77c3
Route::get('produto/{produto}', [ProdutoController::class, 'show']);

Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
