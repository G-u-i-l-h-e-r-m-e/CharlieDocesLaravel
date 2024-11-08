<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Endereco extends Model
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'ENDERECO';
    public $timestamps = false;
    protected $primaryKey = 'ENDERECO_ID';

    protected $fillable = [
        'ENDERECO_NOME',
        'USUARIO_ID',
        'ENDERECO_LOGRADOURO',
        'ENDERECO_NUMERO',
        'ENDERECO_COMPLEMENTO',
        'ENDERECO_CEP',
        'ENDERECO_CIDADE',
        'ENDERECO_ESTADO',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, foreignKey: 'USUARIO_ID');
    }
}