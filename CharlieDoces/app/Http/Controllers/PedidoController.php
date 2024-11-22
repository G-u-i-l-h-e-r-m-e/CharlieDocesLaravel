<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrinho;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\ProdutoEstoque;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PedidoController extends Controller
{
    public function finalizarPedido(Request $request)
    {
        $usuarioId = Auth::id();

        // Iniciar transação
        DB::beginTransaction();

        try {
            // Obter itens do carrinho do usuário
            $items = Carrinho::where('USUARIO_ID', $usuarioId)->get();

            if ($items->isEmpty()) {
                return redirect()->back()->with('error', 'Seu carrinho está vazio.');
            }

            // Criar novo pedido
            $pedido = new Pedido();
            $pedido->USUARIO_ID = $usuarioId;
            $pedido->ENDERECO_ID = Auth::user()->endereco->ENDERECO_ID ?? null;
            $pedido->STATUS_ID = 1; // Por exemplo, 1 = "Pendente"
            $pedido->PEDIDO_DATA = now();
            $pedido->save();

            Log::info('Pedido criado: ', ['PEDIDO_ID' => $pedido->PEDIDO_ID]);

            // Criar itens do pedido e atualizar estoque
            foreach ($items as $item) {
                // Verificar se há estoque suficiente
                $estoque = ProdutoEstoque::where('PRODUTO_ID', $item->PRODUTO_ID)->first();

                if (!$estoque || $estoque->PRODUTO_QTD < $item->ITEM_QTD) {
                    // Reverter transação e retornar erro
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Estoque insuficiente para o produto: ' . $item->produto->PRODUTO_NOME);
                }

                // Diminuir o estoque
                $estoque->PRODUTO_QTD -= $item->ITEM_QTD;
                $estoque->save();

                Log::info('Estoque atualizado para produto: ', ['PRODUTO_ID' => $item->PRODUTO_ID, 'PRODUTO_QTD' => $estoque->PRODUTO_QTD]);

                // Criar item do pedido
                $pedidoItem = new PedidoItem();
                $pedidoItem->PEDIDO_ID = $pedido->PEDIDO_ID;
                $pedidoItem->PRODUTO_ID = $item->PRODUTO_ID;
                $pedidoItem->ITEM_QTD = $item->ITEM_QTD;
                $pedidoItem->ITEM_PRECO = $item->produto->PRODUTO_PRECO - $item->produto->PRODUTO_DESCONTO;
                $pedidoItem->save();

                Log::info('Item do pedido criado: ', ['PEDIDO_ITEM_ID' => $pedidoItem->PEDIDO_ITEM_ID ?? 'N/A', 'PEDIDO_ID' => $pedido->PEDIDO_ID, 'PRODUTO_ID' => $item->PRODUTO_ID]);
            }

            // Limpar o carrinho do usuário
            Carrinho::where('USUARIO_ID', $usuarioId)->delete();

            // Confirmar transação
            DB::commit();

            return redirect()->route('home')->with('success', 'Pedido realizado com sucesso!');

        } catch (\Exception $e) {
            // Reverter transação em caso de erro
            DB::rollBack();
            Log::error('Erro ao finalizar o pedido: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao finalizar o pedido. Tente novamente.');
        }
    }
}
