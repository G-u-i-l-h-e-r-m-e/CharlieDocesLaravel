<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $table = "PRODUTO";
    protected  $primaryKey = "PRODUTO_ID";
    public $timestamps = false;

    public function Categoria(){
        return $this->belongsTo(Categoria::class, "CATEGORIA_ID", "CATEGORIA_ID");
    }

    public function Produto_imagem(){
        return $this->hasMany(Produto_imagem::class, "PRODUTO_ID", "PRODUTO_ID");
    }
}
