<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto_imagem;

class ProdutoImagemController extends Controller
{
     public function index(){
        return view('produto_imagem.index',['imagem' => Produto_imagem::All()]);
    }
}
