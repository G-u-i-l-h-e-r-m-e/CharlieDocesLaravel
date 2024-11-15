<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto; 
class TesteController extends Controller
{
    public function carregarProdutosCarousel()
    {
        // Buscar produtos da categoria 84 com limite e paginação
        $produtosNatal = Produto::where('CATEGORIA_ID', 66)
            ->where('PRODUTO_ATIVO', 1) // Apenas produtos ativos
            ->paginate(3); // Limitar a 3 produtos por página

        // Retornar a view com os produtos
        return view('componentes-teste.teste-final', compact('produtosNatal'));
    }
}
