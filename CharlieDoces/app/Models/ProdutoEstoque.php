<?php
// app/Models/ProdutoEstoque.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoEstoque extends Model
{
    use HasFactory;

    protected $table = 'PRODUTO_ESTOQUE';
    protected $primaryKey = 'PRODUTO_ID';
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'PRODUTO_ID',
        'PRODUTO_QTD', // Corrected field name
    ];

    protected $casts = [
        'PRODUTO_ID' => 'integer',
        'PRODUTO_QTD' => 'integer',
    ];

    // Inverse relationship with Produto
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'PRODUTO_ID', 'PRODUTO_ID');
    }
}
