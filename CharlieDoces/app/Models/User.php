<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

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
        'password',
        'remember_token',
    ];


    public function getAuthIdentifierName()
    {
        return 'USUARIO_ID';
    }

    public function getAuthPassword()
    {
        return $this->USUARIO_SENHA;
    }

    // app/Models/User.php

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'USUARIO_ID', 'USUARIO_ID');
    }
}
