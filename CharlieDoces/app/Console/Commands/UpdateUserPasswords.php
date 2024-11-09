<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateUserPasswords extends Command
{
    protected $signature = 'update:user-passwords';
    protected $description = 'Atualiza as senhas dos usuários para usar o algoritmo Bcrypt';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            // Verifique se a senha já está criptografada
            if (!Hash::needsRehash($user->USUARIO_SENHA)) {
                continue;
            }

            // Atualize a senha para usar Bcrypt
            $user->USUARIO_SENHA = Hash::make($user->USUARIO_SENHA);
            $user->save();

            $this->info("Senha do usuário {$user->USUARIO_EMAIL} atualizada.");
        }

        $this->info('Senhas dos usuários atualizadas com sucesso.');
    }
}