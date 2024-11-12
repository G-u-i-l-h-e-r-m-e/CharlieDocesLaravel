<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;

class HomeController extends Controller
{
    public function index()
    {
        // Carregar produtos e categorias específicas
        $produtos = Produto::all();

        // Exemplo de categorias específicas, você pode ajustar conforme necessário
        $categoriaChocolate = Categoria::with('produtos')->find(66);
        $categoriaNatal = Categoria::with('produtos')->find(84);
        $categoriaTopVendas = Categoria::with('produtos')->find(84);

        // Retornar a view com os dados necessários
        return view('home.index', [
            'produtos' => $produtos,
            'categoriaChocolate' => $categoriaChocolate,
            'categoriaNatal' => $categoriaNatal,
            'categoriaTopVendas' => $categoriaTopVendas
        ]);
    }

    // Se precisar de outros métodos como para listar categorias:
    public function categoria()
    {
        return view('home.index', ['categorias' => Categoria::all()]);
    }

    // Método home para exibir produtos e categorias
    public function home()
    {
        return view('home.index', [
            'produtos' => Produto::all(),
            'categorias' => Categoria::all()
        ]);
    }
}
