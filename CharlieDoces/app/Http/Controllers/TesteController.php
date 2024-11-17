<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class TesteController extends Controller
{
    public function testeFinal()
    {
        // Recupera os produtos com IDs específicos na ordem desejada
        $produtosChocolate = Produto::where('CATEGORIA_ID', 66)
            ->where('PRODUTO_ATIVO', 1)
            ->whereIn('PRODUTO_ID', [281, 282, 283])
            ->orderByRaw("FIELD(PRODUTO_ID, 281, 282, 283)")
            ->get();

        return view('componentes-teste.teste-final', compact('produtosChocolate'));
    }

}
