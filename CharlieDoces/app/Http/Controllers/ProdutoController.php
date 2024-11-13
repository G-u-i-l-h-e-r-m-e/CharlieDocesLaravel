<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index()
    {
        // Filtra para exibir apenas os 3 produtos desejados (com IDs específicos)
        $produtos = Produto::whereIn('PRODUTO_ID', [278, 279, 280]) // IDs dos produtos que você quer
                           ->with(['produto_imagens' => function ($query) {
                               // Ordena as imagens pela ordem e pega a primeira
                               $query->orderBy('IMAGEM_ORDEM', 'asc')->limit(1);
                           }, 'categoria']) // Inclui categorias, se necessário
                           ->get();

        // Retorna a view com os produtos e as imagens associadas
        return view('produto.index', ['produtos' => $produtos]);
    }

    public function show(Produto $produto)
    {
        // Carregar o produto atual com suas imagens e categoria
        $produto = Produto::with(['produto_imagens' => function ($query) {
            $query->orderBy('IMAGEM_ORDEM', 'asc')->limit(1);
        }, 'categoria'])->findOrFail($produto->PRODUTO_ID);

        // Buscar todos os produtos, exceto o atual
        $produtosRelacionados = Produto::with(['produto_imagens' => function ($query) {
            $query->orderBy('IMAGEM_ORDEM', 'asc')->limit(1);
        }, 'categoria'])
                                       ->where('PRODUTO_ID', '!=', $produto->PRODUTO_ID) // Evitar que o próprio produto seja exibido
                                       ->get();

        return view('produto.show', [
            'produto' => $produto,
            'produtosRelacionados' => $produtosRelacionados
        ]);
    }

    public function todosProdutos()
    {
        // Carrega todos os produtos com suas imagens (ordenadas pela ordem da imagem)
        $produtos = Produto::with(['produto_imagens' => function ($query) {
            $query->orderBy('IMAGEM_ORDEM', 'asc')->limit(1);
        }])->get();

        return view('produto.todos_produtos', compact('produtos'));
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

