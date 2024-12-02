<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    use HasFactory;

    protected $table = "CARRINHO_ITEM";
    protected $fillable = ['USUARIO_ID', 'PRODUTO_ID', 'ITEM_QTD'];
    protected $primaryKey = 'PRODUTO_ID';
    public $timestamps = false;

    // Informa que a tabela não possui chave primária padrão
    protected $primaryKey = null;
    public $incrementing = false;

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'PRODUTO_ID', 'PRODUTO_ID');
    }
}
