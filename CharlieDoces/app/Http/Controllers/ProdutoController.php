<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index()
    {
        // Carrega as relações 'produto_imagens' e 'categoria' junto com os produtos
        $produtos = Produto::with('produto_imagens', 'categoria')->get();
        return view('produto.index', ['produtos' => $produtos]);
    }

    public function show(Produto $produto)
    {
        // Carregar o produto atual com suas imagens e categoria
        $produto = Produto::with('produto_imagens', 'categoria')->findOrFail($produto->PRODUTO_ID);
        
        // Buscar todos os produtos, exceto o atual
        $produtosRelacionados = Produto::with('produto_imagens', 'categoria')
                                       ->where('PRODUTO_ID', '!=', $produto->PRODUTO_ID) // Evitar que o próprio produto seja exibido
                                       ->get();
        
        return view('produto.show', [
            'produto' => $produto,
            'produtosRelacionados' => $produtosRelacionados
        ]);
    }
}
