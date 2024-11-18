<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    use HasFactory;

    protected $table = "CARRINHO_ITEM"; // Nome da tabela
    protected $fillable = ['USUARIO_ID', 'PRODUTO_ID', 'ITEM_QTD'];
    public $timestamps = false;

    // Desabilita a expectativa de chave primária padrão
    public $incrementing = false;
    protected $primaryKey = null;

    public function Produto()
    {
        return $this->belongsTo(Produto::class, 'PRODUTO_ID');
    }
}
