<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\Produto;
use App\Models\Categoria;

class HomeController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
       
        $produtos = Produto::all();

       
        $categoriaChocolate = Categoria::with('produtos')->find(66);

        $categoriaNatal = Categoria::with('produtos')->find(84);

        $categoriaTopVendas = Categoria::with('produtos')->find(84);

        
        return view('home.index', ['produtos' => $produtos, 'categoriaChocolate' => $categoriaChocolate, 'categoriaNatal' => $categoriaNatal, 'categoriaTopVendas' => $categoriaTopVendas]);
=======
        return view('home.index', ['produtos' => Produto::All()]);
    }

    public function categoria()
    {
        return view('home.index', ['categorias' => Categoria::All()]);
    }

    public function home()
    {
        return view('home.index', [
            'produtos' => Produto::all(),
            'categorias' => Categoria::all()
        ]);
>>>>>>> 4fb1552c8a6409db0076942619d502e1134b77c3
    }
}
