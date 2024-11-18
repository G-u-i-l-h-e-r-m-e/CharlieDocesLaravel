<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Carrinho;
use Illuminate\Support\Facades\Auth;

class CarrinhoController extends Controller
{
    // Função para adicionar produto ao carrinho
    public function addCarrinho(Produto $produto)
{
    $usuarioId = Auth::user()->USUARIO_ID;

    $item = Carrinho::where([
        'USUARIO_ID' => $usuarioId,
        'PRODUTO_ID' => $produto->PRODUTO_ID,
    ])->first();

    if ($item) {
        $item->ITEM_QTD += 1;
        $item->save();
    } else {
        $item = Carrinho::create([
            'USUARIO_ID' => $usuarioId,
            'PRODUTO_ID' => $produto->PRODUTO_ID,
            'ITEM_QTD' => 1,
        ]);
    }

    return response()->json([
        'ITEM_QTD' => $item->ITEM_QTD,
        'message' => 'Quantidade atualizada.',
    ]);
}

    // Função para remover produto do carrinho
    public function removeCarrinho(Produto $produto)
    {
        $usuarioId = Auth::user()->USUARIO_ID;
    
        $item = Carrinho::where([
            'USUARIO_ID' => $usuarioId,
            'PRODUTO_ID' => $produto->PRODUTO_ID,
        ])->first();
    
        if ($item) {
            if ($item->ITEM_QTD > 1) {
                $item->ITEM_QTD -= 1;
                $item->save();
            } else {
                $item->delete();
                return response()->json(['ITEM_QTD' => 0, 'message' => 'Item removido.']);
            }
        }
    
        return response()->json([
            'ITEM_QTD' => $item->ITEM_QTD ?? 0,
            'message' => 'Quantidade atualizada.',
        ]);
    }
    
}
