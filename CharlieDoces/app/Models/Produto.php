<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = "PRODUTO";
    protected $primaryKey = "PRODUTO_ID";
    public $timestamps = false;

    protected $fillable = [
        'PRODUTO_NOME',
        'PRODUTO_DESC',
        'PRODUTO_PRECO',
        'PRODUTO_DESCONTO',
        'CATEGORIA_ID',
        'PRODUTO_ATIVO',
    ];

    // Relacionamento com a tabela de categorias
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, "CATEGORIA_ID", "CATEGORIA_ID");
    }

    // Relacionamento com as imagens do produto
    public function produto_imagens()
    {
        return $this->hasMany(Produto_imagem::class, "PRODUTO_ID", "PRODUTO_ID");
    }

    // Relacionamento com o estoque do produto
    public function estoque()
    {
        return $this->hasOne(ProdutoEstoque::class, 'PRODUTO_ID', 'PRODUTO_ID');
    }

    public function produtosPorCategoria($categoriaNome)
    {
        $produtos = Produto::whereHas('categoria', function ($query) use ($categoriaNome) {
            $query->where('CATEGORIA_NOME', $categoriaNome);
        })
            ->with([
                'produto_imagens' => function ($query) {
                    $query->orderBy('IMAGEM_ORDEM', 'asc')->limit(1);
                },
                'estoque'
            ])
            ->get();

        return view('produto.index', ['produtos' => $produtos]);
    }
}

