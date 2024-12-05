<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PedidoItem;
use Illuminate\Support\Facades\Auth;

class PedidoItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the user's pedido items.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }

        $pedidoItems = PedidoItem::whereHas('pedido', function ($query) use ($user) {
            $query->where('USUARIO_ID', $user->USUARIO_ID);
        })->paginate(6);

        // Renderizar apenas os itens de pedido para resposta AJAX
        $pedidoItems_html = view('historico.partials.pedido_items', ['pedidoItems' => $pedidoItems])->render();
        $breadcrumbs_html = ''; // Ajuste se utilizar breadcrumbs
        $titulo_categoria = 'Histórico de Pedidos';
        $pagination_html = $pedidoItems->links('pagination::bootstrap-4')->toHtml();

        return response()->json([
            'pedidoItems_html' => $pedidoItems_html,
            'breadcrumbs_html' => $breadcrumbs_html,
            'titulo_categoria' => $titulo_categoria,
            'pagination_html' => $pagination_html,
            'current_page' => $pedidoItems->currentPage(),
            'last_page' => $pedidoItems->lastPage(),
        ]);
    }
}