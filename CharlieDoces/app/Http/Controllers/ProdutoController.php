<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;


class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::whereIn('PRODUTO_ID', [278, 279, 280])
            ->with([
                'produto_imagens' => function ($query) {
                    $query->orderBy('IMAGEM_ORDEM', 'asc')->limit(1);
                },
                'categoria',
                'estoque'
            ])
            ->get();

        return view('produto.index', ['produtos' => $produtos]);
    }

    public function show(Produto $produto)
    {
        $produto = Produto::with([
            'produto_imagens' => function ($query) {
                $query->orderBy('IMAGEM_ORDEM', 'asc')->limit(1);
            },
            'categoria',
            'estoque'
        ])->findOrFail($produto->PRODUTO_ID);

        $produtosRelacionados = Produto::with([
            'produto_imagens' => function ($query) {
                $query->orderBy('IMAGEM_ORDEM', 'asc')->limit(1);
            },
            'categoria',
            'estoque'
        ])
            ->where('PRODUTO_ID', '!=', $produto->PRODUTO_ID)
            ->get();

        return view('produto.show', [
            'produto' => $produto,
            'produtosRelacionados' => $produtosRelacionados
        ]);
    }

    public function todosProdutos(Request $request)
    {
        $query = $request->input('query');
    
        if ($query) {
            $produtos = Produto::where('PRODUTO_NOME', 'like', '%' . $query . '%')
                ->with([
                    'produto_imagens' => function ($query) {
                        $query->orderBy('IMAGEM_ORDEM', 'asc')->limit(1);
                    },
                    'estoque'
                ])
                ->paginate(9); // Define o número de itens por página
        } else {
            $produtos = Produto::with([
                'produto_imagens' => function ($query) {
                    $query->orderBy('IMAGEM_ORDEM', 'asc')->limit(1);
                },
                'estoque'
            ])
            ->paginate(9); // Define o número de itens por página
        }

        $categorias = Categoria::all();
    
        return view('produto.todos_produtos', compact('produtos','categorias'));
    }
    
    public function buscar(Request $request)
    {
        $termo = $request->input('q');
        $produtos = Produto::where('PRODUTO_NOME', 'LIKE', '%' . $termo . '%')
            ->with('estoque')
            ->get();

        return response()->json($produtos);
    }

    public function verificarEstoque(Request $request)
    {
        // Valida os dados recebidos
        $validated = $request->validate([
            'produto_id' => 'required|integer|exists:PRODUTO,PRODUTO_ID',
            'quantidade' => 'required|integer|min:1',
        ]);

        $produtoId = $validated['produto_id'];
        $quantidade = $validated['quantidade'];

        // Busca o produto e seu estoque
        $produto = Produto::with('estoque')->find($produtoId);

        // Verifica se a quantidade no estoque é suficiente
        if (!$produto || !$produto->estoque || $produto->estoque->PRODUTO_QTD < $quantidade) {
            return response()->json(['estoqueDisponivel' => false], 200);
        }

        // Retorna disponibilidade
        return response()->json(['estoqueDisponivel' => true], 200);
    }

    // Novo método para filtrar produtos por categoria
    public function produtosPorCategoria(Request $request)
{
    $categorias = $request->input('categorias', []);  // Recebe as categorias selecionadas

    if (count($categorias) > 0) {
        // Filtra os produtos pelas categorias selecionadas
        $produtos = Produto::whereHas('categoria', function ($query) use ($categorias) {
            $query->whereIn('CATEGORIA_NOME', $categorias);  // Usando whereIn para múltiplas categorias
        })
        ->with([
            'produto_imagens' => function ($query) {
                $query->orderBy('IMAGEM_ORDEM', 'asc')->limit(1);
            },
            'estoque'
        ])
        ->paginate(9);
    } else {
        // Se nenhuma categoria for selecionada, retorna todos os produtos
        $produtos = Produto::with([
            'produto_imagens' => function ($query) {
                $query->orderBy('IMAGEM_ORDEM', 'asc')->limit(1);
            },
            'estoque'
        ])
        ->paginate(9);
    }

    // Retorna a lista de produtos em formato HTML
    return view('produto.categoria', compact('produtos'));
}



}
