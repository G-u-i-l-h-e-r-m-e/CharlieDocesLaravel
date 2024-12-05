<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Pedido extends Model
{
    use HasFactory;
    protected $table = 'PEDIDO';
    protected $primaryKey = 'PEDIDO_ID';
    public $timestamps = false;
    protected $fillable = [
        'USUARIO_ID',
        'ENDERECO_ID',
        'STATUS_ID',
        'PEDIDO_DATA',
    ];
    public function itens()
    {
        return $this->hasMany(PedidoItem::class, 'PEDIDO_ID', 'PEDIDO_ID');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'USUARIO_ID', 'USUARIO_ID');
    }
    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'ENDERECO_ID', 'ENDERECO_ID');
    }

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

    public function status() {
        return $this->belongsTo(Status::class, 'STATUS_ID', 'STATUS_ID');
    }
}