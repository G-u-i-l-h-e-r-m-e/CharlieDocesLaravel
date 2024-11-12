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
       
        $produtos = Produto::all();

       
        $categoriaChocolate = Categoria::with('produtos')->find(66);

        $categoriaNatal = Categoria::with('produtos')->find(84);

        $categoriaTopVendas = Categoria::with('produtos')->find(84);

        
        return view('home.index', ['produtos' => $produtos, 'categoriaChocolate' => $categoriaChocolate, 'categoriaNatal' => $categoriaNatal, 'categoriaTopVendas' => $categoriaTopVendas]);
    }
}
