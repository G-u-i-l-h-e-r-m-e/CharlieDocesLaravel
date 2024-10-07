<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;


Route::get('/categoria',[CategoriaController::class, 'index']);
Route::get('/categoria/{categoria}',[CategoriaController::class, 'show']);
Route::get('/produtos',[ProdutoController::class, 'index']);