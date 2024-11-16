<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
class TesteController extends Controller
{
    public function carregarProdutosCarousel()
    {
        // Filtrar produtos pela categoria usando o relacionamento
        $produtosNatal = Produto::whereHas('categoria', function ($query) {
            $query->where('CATEGORIA_NOME', 'natal');
        })->paginate(3);

        return view('componentes-produtos.carousel-natal', compact('produtosNatal'));
    }



}