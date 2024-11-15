<?php

namespace App\Http\Controllers;

use App\Models\Produto;

class TesteController extends Controller
{
    public function testeCard()
    {
        // Busca o produto com ID 278
        $produto = Produto::find(278);

        // Verifica se o produto foi encontrado
        if (!$produto) {
            return "Produto com ID 278 não encontrado.";
        }

        // Retorna a view de teste com o produto
        return view('componentes-teste.teste-card', compact('produto'));
    }
}
