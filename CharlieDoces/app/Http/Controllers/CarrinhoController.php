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

        $estoqueQtd = $estoque->PRODUTO_QTD;

        \Log::info('Quantidade em estoque para produto_id ' . $produtoId . ': ' . $estoqueQtd);

        if ($estoqueQtd < $quantidade) {
            return response()->json(['message' => 'Quantidade solicitada indisponível no estoque.'], 400);
        }

        // Verifica se o item já está no carrinho
        $item = Carrinho::where([
            'USUARIO_ID' => $usuarioId,
            'PRODUTO_ID' => $produtoId,
        ])->first();

        if ($item) {
            // Atualiza a quantidade usando o Query Builder
            Carrinho::where([
                'USUARIO_ID' => $usuarioId,
                'PRODUTO_ID' => $produtoId,
            ])->update([
                'ITEM_QTD' => $item->ITEM_QTD + $quantidade,
            ]);

            $item->ITEM_QTD += $quantidade;
        } else {
            // Cria um novo registro
            $item = new Carrinho();
            $item->USUARIO_ID = $usuarioId;
            $item->PRODUTO_ID = $produtoId;
            $item->ITEM_QTD = $quantidade;
            $item->save();
        }

        // Obtém a quantidade total de itens no carrinho
        $totalItems = Carrinho::where('USUARIO_ID', $usuarioId)->sum('ITEM_QTD');

        return response()->json([
            'ITEM_QTD'   => $item->ITEM_QTD,
            'message'    => 'Produto adicionado ao carrinho!',
            'totalItems' => $totalItems,
        ]);
    }

    // Método para exibir o carrinho
    public function carrinho()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $usuarioId = Auth::id();

        // Exibe 10 produtos por página
    $items = Carrinho::where('USUARIO_ID', $usuarioId)
    ->with('produto.produto_imagens', 'produto.estoque')
    ->paginate(6); // 6 itens por página

        return view('carrinho.carrinho', ['items' => $items]);
    }

    // Método para atualizar a quantidade de um item no carrinho
    public function atualizarCarrinho(Request $request, Produto $produto)
    {
        $usuarioId = Auth::id();
        $novaQuantidade = $request->input('ITEM_QTD');

        // Atualizar a quantidade do item no carrinho
        Carrinho::where([
            'USUARIO_ID' => $usuarioId,
            'PRODUTO_ID' => $produto->PRODUTO_ID
        ])->update(['ITEM_QTD' => $novaQuantidade]);

        return redirect()->route('carrinho.exibir');
    }

    // Método para remover um item do carrinho
    public function removerDoCarrinho(Produto $produto)
    {
        $usuarioId = Auth::id();

        // Remover o item do carrinho
        Carrinho::where([
            'USUARIO_ID' => $usuarioId,
            'PRODUTO_ID' => $produto->PRODUTO_ID
        ])->delete();

        return redirect()->route('carrinho.exibir');
    }
}