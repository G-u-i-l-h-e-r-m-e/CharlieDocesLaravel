<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index()
    {
        // Filtra para exibir apenas os 3 produtos desejados (com IDs específicos)
        $produtos = Produto::whereIn('PRODUTO_ID', [278, 279, 280])
                           ->with(['produto_imagens' => function ($query) {
                               $query->orderBy('IMAGEM_ORDEM', 'asc')->limit(1);
                           }, 'categoria'])
                           ->get();

        return view('produto.index', ['produtos' => $produtos]);
    }

    public function show(Produto $produto)
    {
        $produto = Produto::with(['produto_imagens' => function ($query) {
            $query->orderBy('IMAGEM_ORDEM', 'asc')->limit(1);
        }, 'categoria'])->findOrFail($produto->PRODUTO_ID);

        $produtosRelacionados = Produto::with(['produto_imagens' => function ($query) {
            $query->orderBy('IMAGEM_ORDEM', 'asc')->limit(1);
        }, 'categoria'])
                                       ->where('PRODUTO_ID', '!=', $produto->PRODUTO_ID)
                                       ->get();

        return view('produto.show', [
            'produto' => $produto,
            'produtosRelacionados' => $produtosRelacionados
        ]);
    }

    public function todosProdutos(Request $request)
    {
        $query = $request->input('query'); // Recebe o termo de pesquisa

        if ($query) {
            // Filtra produtos pelo nome usando o termo de pesquisa
            $produtos = Produto::where('PRODUTO_NOME', 'like', '%' . $query . '%')
                                ->with(['produto_imagens' => function ($query) {
                                    $query->orderBy('IMAGEM_ORDEM', 'asc')->limit(1);
                                }])->get();
        } else {
            // Exibe todos os produtos se não houver termo de pesquisa
            $produtos = Produto::with(['produto_imagens' => function ($query) {
                $query->orderBy('IMAGEM_ORDEM', 'asc')->limit(1);
            }])->get();
        }

        return view('categoria.show', compact('produtos'));
    }

    public function buscar(Request $request)
    {
        $termo = $request->input('q');
        $produtos = Produto::where('nome', 'LIKE', '%' . $termo . '%')->get();

        return response()->json($produtos);
    }
}
