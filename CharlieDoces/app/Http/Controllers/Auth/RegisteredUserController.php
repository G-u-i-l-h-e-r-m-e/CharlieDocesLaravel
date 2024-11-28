<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Endereco;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validação dos dados do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:USUARIO,USUARIO_EMAIL',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'cpf' => 'required|string|max:11|unique:USUARIO,USUARIO_CPF',
            'bairro' => 'required|string|max:255',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|integer',
            'complemento' => 'nullable|string|max:255',
            'cep' => 'required|string|max:10',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
        ]);

        // Criação do usuário
        $user = User::create([
            'USUARIO_NOME' => $request->name,
            'USUARIO_EMAIL' => $request->email,
            'USUARIO_SENHA' => Hash::make($request->password),
            'USUARIO_CPF' => $request->cpf,
        ]);

        // Criação do endereço
        Endereco::create([
            'ENDERECO_NOME' => $request->bairro,
            'USUARIO_ID' => $user->USUARIO_ID,
            'ENDERECO_LOGRADOURO' => $request->logradouro,
            'ENDERECO_NUMERO' => $request->numero,
            'ENDERECO_COMPLEMENTO' => $request->complemento,
            'ENDERECO_CEP' => $request->cep,
            'ENDERECO_CIDADE' => $request->cidade,
            'ENDERECO_ESTADO' => $request->estado,
        ]);

        // Disparar evento de registro
        event(new Registered($user));

        // Autenticar o usuário
        Auth::login($user);

        // Redirecionar para a página inicial ou outra página desejada
        return redirect()->route('home');
    }
}