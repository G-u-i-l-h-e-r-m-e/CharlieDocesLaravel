<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index(){
        return view('produto.index', ['produtos' => Produto::all()]);
    }

    public function show(Produto $produto){
        return view('produto.show', ['produto' => $produto]);
    }

    public function buscar(Request $request)
    {
        // Recebe o termo de pesquisa
        $termo = $request->input('q');

        // Busca no banco de dados usando o operador LIKE
        $produtos = Produto::where('nome', 'LIKE', '%' . $termo . '%')->get();

        // Retorna os produtos encontrados em formato JSON
        return response()->json($produtos);
    }
}
