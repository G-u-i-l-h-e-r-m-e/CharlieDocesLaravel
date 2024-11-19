<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Carrinho;
use Illuminate\Support\Facades\Auth;

class CarrinhoController extends Controller
{
    // Função para adicionar produto ao carrinho
    public function addCarrinho(Request $request, Produto $produto)
{
    $usuarioId = Auth::user()->USUARIO_ID;

    \Log::info('Adicionando ao carrinho', ['produto' => $produto->PRODUTO_ID, 'usuario' => $usuarioId]);

    if (!$usuarioId) {
        return response()->json(['message' => 'Usuário não autenticado!'], 401);
    }

    // Busca ou cria um novo item no carrinho
    $item = Carrinho::firstOrNew([
        'USUARIO_ID' => $usuarioId,
        'PRODUTO_ID' => $produto->PRODUTO_ID,
    ]);

    // Atualiza a quantidade do item
    $item->ITEM_QTD = ($item->ITEM_QTD ?? 0) + 1;
    $item->save();

    // Retorna a nova quantidade para o frontend
    return response()->json([
        'ITEM_QTD' => $item->ITEM_QTD,
        'message' => 'Produto adicionado ao carrinho!',
    ]);
}

    // Função para remover produto do carrinho
    public function removeCarrinho(Produto $produto)
    {
        $usuarioId = Auth::id();

        if (!$usuarioId) {
            return response()->json(['message' => 'Usuário não autenticado!'], 401);
        }

        // Buscando o item do carrinho do usuário
        $item = Carrinho::where([
            'USUARIO_ID' => $usuarioId,
            'PRODUTO_ID' => $produto->PRODUTO_ID,
        ])->first();

        // Se o item foi encontrado
        if ($item) {
            // Se a quantidade for maior que 1, apenas diminui a quantidade
            if ($item->ITEM_QTD > 1) {
                $item->ITEM_QTD -= 1;
                $item->save();
            } else {
                // Se a quantidade for 1, remove o item do carrinho
                $item->delete();
                return response()->json(['ITEM_QTD' => 0, 'message' => 'Item removido.']);
            }
        } else {
            // Se o item não existir no carrinho
            return response()->json(['message' => 'Produto não encontrado no carrinho.'], 404);
        }

        // Retorna a nova quantidade do item
        return response()->json([
            'ITEM_QTD' => $item->ITEM_QTD,
            'message' => 'Quantidade atualizada.',
        ]);
    }
}
