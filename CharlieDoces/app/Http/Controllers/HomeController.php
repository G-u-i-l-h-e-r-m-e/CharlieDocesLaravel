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
        // Carregar produtos da categoria "Natal" com paginação
        $produtosNatal = Produto::whereHas('categoria', function ($query) {
            $query->where('CATEGORIA_NOME', 'natal');
        })->paginate(3);

        // Carregar produtos de chocolate com paginação
        $produtosChocolate = Produto::where('CATEGORIA_ID', 66)
            ->where('PRODUTO_ATIVO', 1)
            ->whereIn('PRODUTO_ID', [281, 282, 283])
            ->orderByRaw("FIELD(PRODUTO_ID, 281, 282, 283)")
            ->paginate(3);

        // Recupera os produtos mais vendidos (Top 3) com as imagens
        $produtosMaisVendidos = Produto::with('produto_imagens') // Carrega as imagens relacionadas
            ->join('PEDIDO_ITEM', 'PRODUTO.PRODUTO_ID', '=', 'PEDIDO_ITEM.PRODUTO_ID')
            ->select('PRODUTO.*', \DB::raw('SUM(PEDIDO_ITEM.ITEM_QTD) AS total_vendido'))
            ->groupBy('PRODUTO.PRODUTO_ID') 
            ->orderByDesc('total_vendido')
            ->limit(3)
            ->get();
        
        // Recuperar na ordem correta
        $produtosMaisVendidos = $produtosMaisVendidos->sortBy(function ($produto, $key) {
            if ($key == 1) return 0; // Segundo mais vendido
            if ($key == 0) return 1; // Mais vendido
            return 2;                // Terceiro mais vendido
        })->values(); // Reindexa os índices da coleção

        // Carregar todos os produtos
        $produtos = Produto::all();

        // Carregar categorias específicas
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
            'produtosNatal' => $produtosNatal,
            'produtosChocolate' => $produtosChocolate,
            'produtosMaisVendidos' => $produtosMaisVendidos, 
            'produtos' => $produtos,
            'categoriaChocolate' => $categoriaChocolate,
            'categoriaNatal' => $categoriaNatal,
            'categoriaTopVendas' => $categoriaTopVendas,
            'items' => $items // Passa os itens do carrinho
        ]);
    }

    // Método para listar categorias
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
