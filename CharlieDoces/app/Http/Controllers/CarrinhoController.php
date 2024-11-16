<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Carrinho;
use Illuminate\Support\Facades\Auth;

class CarrinhoController extends Controller
{
    public function addCarrinho(Produto $produto){
        $item = Carrinho::where(
                ['USUARIO_ID' => Auth::user()->USUARIO_ID, 'PRODUTO_ID' => $produto->PRODUTO_ID]
        )->first();

        if($item){
            Carrinho::where(['USUARIO_ID' => Auth::user()->USUARIO_ID, 'PRODUTO_ID' => $produto->PRODUTO_ID])->update([
                'ITEM_QTD' => $item->ITEM_QTD + 1
            ]);
        }else{
            Carrinho::create([
                'USUARIO_ID' => Auth::user()->USUARIO_ID,
                'PRODUTO_ID' => $produto->PRODUTO_ID, 
                'ITEM_QTD' => 1
            ]);
        }
    }

    public function carrinho(){
        $items = Carrinho::where(['USUARIO_ID' => Auth::user()->USUARIO_ID])->get();
        return view('carrinho.carrinho', ['items' => $items]);
    }
    
}
