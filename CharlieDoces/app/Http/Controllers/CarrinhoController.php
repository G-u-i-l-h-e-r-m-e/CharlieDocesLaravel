<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Carrinho;
use Illuminate\Support\Facades\Auth;

class CarrinhoController extends Controller
{
    public function addCarrinho(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Usuário não autenticado!'], 401);
        }

        $usuarioId = Auth::id();
        $produtoId = $request->input('produto_id');
        $quantidade = $request->input('quantidade', 1);

        $produto = Produto::with('estoque')->find($produtoId);

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado.'], 404);
        }

        $estoque = $produto->estoque;

        if (!$estoque) {
            return response()->json(['message' => 'Estoque não encontrado para este produto.'], 404);
        }

        $estoqueQtd = $estoque->PRODUTO_QTD; // Use the correct attribute

        \Log::info('Stock quantity for produto_id ' . $produtoId . ': ' . $estoqueQtd);

        if ($estoqueQtd < $quantidade) {
            return response()->json(['message' => 'Quantidade solicitada indisponível no estoque.'], 400);
        }

        // Proceed to add the product to the cart
        $item = Carrinho::firstOrNew([
            'USUARIO_ID' => $usuarioId,
            'PRODUTO_ID' => $produtoId,
        ]);

        // Update the item quantity
        $item->ITEM_QTD = ($item->ITEM_QTD ?? 0) + $quantidade;
        $item->save();

        return response()->json([


            'ITEM_QTD' => $item->ITEM_QTD,
            'message' => 'Produto adicionado ao carrinho!',
        ]);
    }

    public function carrinho()
    {
        $items = Carrinho::where('USUARIO_ID', Auth::user()->USUARIO_ID)
            ->with('produto.produto_imagens', 'produto.estoque')
            ->get();

        return view('carrinho.carrinho', ['items' => $items]);
    }

    public function atualizarCarrinho(Request $request, Produto $produto)
    {
        $usuarioId = Auth::user()->USUARIO_ID;
        $novaQuantidade = $request->input('ITEM_QTD');

        // Atualizar a quantidade do item no carrinho
        Carrinho::where([
            'USUARIO_ID' => $usuarioId,
            'PRODUTO_ID' => $produto->PRODUTO_ID
        ])->update(['ITEM_QTD' => $novaQuantidade]);

        return redirect()->route('carrinho.exibir');
    }

    public function removerDoCarrinho(Produto $produto)
    {
        $usuarioId = Auth::user()->USUARIO_ID;

        // Remover o item do carrinho
        Carrinho::where([
            'USUARIO_ID' => $usuarioId,
            'PRODUTO_ID' => $produto->PRODUTO_ID
        ])->delete();

        return redirect()->route('carrinho.exibir');
    }



}
