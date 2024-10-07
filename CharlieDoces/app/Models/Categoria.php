<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $table = "CATEGORIA";
    protected $primaryKey = "CATEGORIA_ID";

    public function Produtos(){
        return $this->hasMany(Produto::class, "CATEGORIA_ID", "CATEGORIA_ID");
    }
}
