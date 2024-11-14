<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class SearchController extends Controller
{
    public function results(Request $request)
    {
        $query = $request->input('query');
        
        // Redireciona para a página de produtos com o termo de pesquisa como parâmetro
        return redirect()->route('produtos.todos', ['query' => $query]);
    }
    

    }
