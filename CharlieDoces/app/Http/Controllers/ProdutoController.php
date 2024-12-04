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

        // Breadcrumbs
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Destaques', 'url' => route('home')],
        ];

        return view('produto.index', ['produtos' => $produtos, 'breadcrumbs' => $breadcrumbs]);
    }

    public function show(Produto $produto)
    {
        $produto = Produto::with([
            'produto_imagens' => function ($query) {
                $query->orderBy('IMAGEM_ORDEM', 'asc');
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

        // Breadcrumbs
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Todos os Produtos', 'url' => route('produtos.todos')],
            ['title' => $produto->PRODUTO_NOME, 'url' => route('produto.show', $produto->PRODUTO_ID)],
        ];

        return view('produto.show', [
            'produto' => $produto,
            'produtosRelacionados' => $produtosRelacionados,
            'breadcrumbs' => $breadcrumbs,
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
                ->paginate(9);
        } else {
            $produtos = Produto::with([
                'produto_imagens' => function ($query) {
                    $query->orderBy('IMAGEM_ORDEM', 'asc')->limit(1);
                },
                'estoque'
            ])
                ->orderBy('PRODUTO_PRECO', 'asc') // Ordenar por preço ascendente por padrão
                ->paginate(9);
        }

        $categorias = Categoria::all();

        // Breadcrumbs
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Todos os Produtos', 'url' => route('produtos.todos')],
        ];

        return view('produto.todos_produtos', compact('produtos', 'categorias', 'breadcrumbs'));
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
        $validated = $request->validate([
            'produto_id' => 'required|integer|exists:PRODUTO,PRODUTO_ID',
            'quantidade' => 'required|integer|min:1',
        ]);

        $produtoId = $validated['produto_id'];
        $quantidade = $validated['quantidade'];

        $produto = Produto::with('estoque')->find($produtoId);

        if (!$produto || !$produto->estoque || $produto->estoque->PRODUTO_QTD < $quantidade) {
            return response()->json(['estoqueDisponivel' => false], 200);
        }

        return response()->json(['estoqueDisponivel' => true], 200);
    }

    // Método 'filtrar' 
    public function filtrar(Request $request)
    {
        $categoriaSelecionada = $request->input('categoria', '');
        $ordenacao = $request->input('ordenacao', 'menor_preco');
        $page = $request->input('page', 1);

        if ($categoriaSelecionada) {
            // Buscar a categoria pelo nome
            $categoria = Categoria::where('CATEGORIA_NOME', $categoriaSelecionada)->first();
        }

        // Query base
        $query = Produto::with([
            'produto_imagens' => function ($query) {
                $query->orderBy('IMAGEM_ORDEM', 'asc')->limit(1);
            },
            'estoque'
        ]);

        if (isset($categoria)) {
            // Filtrar os produtos pela categoria
            $query->where('CATEGORIA_ID', $categoria->CATEGORIA_ID);
            $titulo_categoria = $categoria->CATEGORIA_NOME;
        } else {
            // Se nenhuma categoria selecionada, mostrar 'Todos os Produtos'
            $titulo_categoria = 'Todos os Produtos';
        }

        // Aplicar ordenação
        switch ($ordenacao) {
            case 'menor_preco':
                $query->orderBy('PRODUTO_PRECO', 'asc');
                break;
            case 'maior_preco':
                $query->orderBy('PRODUTO_PRECO', 'desc');
                break;
            case 'a_z':
                $query->orderBy('PRODUTO_NOME', 'asc');
                break;
            case 'z_a':
                $query->orderBy('PRODUTO_NOME', 'desc');
                break;
            default:
                $query->orderBy('PRODUTO_PRECO', 'asc');
                break;
        }

        // Paginar os resultados
        $produtos = $query->paginate(9, ['*'], 'page', $page);

        // Breadcrumbs
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Todos os Produtos', 'url' => route('produtos.todos')],
        ];


        if (isset($categoria)) {
            $breadcrumbs[] = ['title' => $categoria->CATEGORIA_NOME, 'url' => '#'];
        }

        // Renderizar os breadcrumbs e os produtos como HTML
        $breadcrumbs_html = view('components.breadcrumbs', compact('breadcrumbs'))->render();
        $produtos_html = view('produto.produtos_list', ['produtos' => $produtos])->render();

        // Renderizar a paginação
        $pagination_html = $produtos->links('pagination::bootstrap-4')->toHtml();

        return response()->json([
            'breadcrumbs_html' => $breadcrumbs_html,
            'produtos_html' => $produtos_html,
            'titulo_categoria' => $titulo_categoria,
            'pagination_html' => $pagination_html,
            'current_page' => $produtos->currentPage(),
            'last_page' => $produtos->lastPage(),
        ]);
    }
}
