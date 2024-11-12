<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'USUARIO';
    protected $primaryKey = 'USUARIO_ID';
    public $timestamps = false;
    protected $fillable = [
        'USUARIO_NOME',
        'USUARIO_EMAIL',
        'USUARIO_SENHA',
        'USUARIO_CPF',
    ];

    protected $hidden = [
        'USUARIO_SENHA',
        'remember_token',
    ];

    // Especificar o nome da coluna que deve ser usada para autenticação
    public function getAuthIdentifierName()
    {
        return 'USUARIO_EMAIL';
    }

    // Especificar o nome da coluna que deve ser usada para a senha
    public function getAuthPassword()
    {
        return $this->USUARIO_SENHA;
    }

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'USUARIO_ID');
    }
}
