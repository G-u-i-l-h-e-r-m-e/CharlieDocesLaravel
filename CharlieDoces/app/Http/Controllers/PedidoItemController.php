<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;

class PedidoItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $pedidos = Pedido::where('USUARIO_ID', $user->USUARIO_ID)->get();
        $pedidoItems = PedidoItem::whereHas('pedido', function ($query) use ($user) {
            $query->where('USUARIO_ID', $user->USUARIO_ID);
        })->get();
        $categorias = Categoria::all();
        $produto = Produto::all();

        return view('historico.index', [
            'pedidoItems' => $pedidoItems,
            'categorias' => $categorias,
            'produto' => $produto,
            'pedidos' => $pedidos
        ]);
    }
}
