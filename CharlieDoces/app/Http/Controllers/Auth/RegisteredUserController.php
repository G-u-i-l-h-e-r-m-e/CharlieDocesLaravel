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
use Illuminate\Support\Facades\Validator;
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'regex:/^[^\d]*$/'],
            'email' => ['required', 'string', 'email', 'unique:USUARIO,USUARIO_EMAIL'],
            'password' => ['required', 'string', 'min:8', 'confirmed', Rules\Password::defaults()],
            'cpf' => ['required', 'string', 'max:11', 'unique:USUARIO,USUARIO_CPF', 'confirmed'],
            'bairro' => ['required', 'string'],
            'logradouro' => ['required', 'string'],
            'estado' => ['required', 'string'],
            'cidade' => ['required', 'string'],
            'cep' => ['required', 'string', 'max:7'],
            'logradouro' => ['required', 'string'],
            'numero' => ['required', 'string'],
            'complemento' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

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

        return redirect()->route('home');
    }

    
}
