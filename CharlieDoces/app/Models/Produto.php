<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $table = "PRODUTO";

    public function Categoria(){
        return $this->belongsTo(Categoria::class, "CATEGORIA_ID", "CATEGORIA_ID");
    }
}
