<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Produto;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();

        // Breadcrumbs
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Categorias', 'url' => route('categorias.index')],
        ];

        return view('categoria.index', ['categorias' => $categorias, 'breadcrumbs' => $breadcrumbs]);
    }

    public function show(Categoria $categoria)
    {
        $produtos = Produto::where('CATEGORIA_ID', $categoria->CATEGORIA_ID)
            ->with([
                'produto_imagens' => function ($query) {
                    $query->orderBy('IMAGEM_ORDEM', 'asc')->limit(1);
                },
                'estoque'
            ])
            ->paginate(9);

        // Breadcrumbs
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Categorias', 'url' => route('categorias.index')],
            ['title' => $categoria->CATEGORIA_NOME, 'url' => route('categorias.show', $categoria->CATEGORIA_ID)],
        ];

        return view('categoria.show', ['categoria' => $categoria, 'produtos' => $produtos, 'breadcrumbs' => $breadcrumbs]);
    }
}
