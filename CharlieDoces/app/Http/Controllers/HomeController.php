<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Carrinho;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Carregar produtos e categorias específicas
        $produtos = Produto::all();

        // Exemplo de categorias específicas
        $categoriaChocolate = Categoria::with('produtos')->find(66);
        $categoriaNatal = Categoria::with('produtos')->find(84);
        $categoriaTopVendas = Categoria::with('produtos')->find(84);

        // Verificar se o usuário está logado e carregar os itens do carrinho
        $items = [];
        if (Auth::check()) {
            // Obtém os itens do carrinho para o usuário logado
            $items = Carrinho::where('USUARIO_ID', Auth::user()->USUARIO_ID)->get();
        }

        // Retornar a view com todos os dados necessários
        return view('home.index', [
            'produtos' => $produtos,
            'categoriaChocolate' => $categoriaChocolate,
            'categoriaNatal' => $categoriaNatal,
            'categoriaTopVendas' => $categoriaTopVendas,
            'items' => $items // Passa os itens do carrinho
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
