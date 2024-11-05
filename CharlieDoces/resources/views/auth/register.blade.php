<!DOCTYPE html>
<html>

<head>
    <title>Cadastro</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #FFFFFF;
            font-family: Arial, sans-serif;
        }

        .cadastro-container {
            display: flex;
            justify-content: center;
            text-align: start;
            width: 700px;
            height: 700px;
            font-family: 'Poppins', sans-serif;
        }

        .cadastro-container h2 {
            font-size: 32px;
            color: #4A2F25;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .cadastro-container h3 {
            font-size: 32px;
            color: #591F12;
            font-weight: bold;
            margin-bottom: 40px;
            margin-top: 40px;
        }

        .cadastro-container label {
            display: block;
            font-size: 20px;
            color: #8B4513;
            margin-bottom: 8px;
            text-align: left;
        }

        .cadastro-container input[type="date"],
        .cadastro-container input[type="email"],
        .cadastro-container input[type="password"],
        .cadastro-container input[type="text"] {
            width: 698px;
            height: 42px;
            padding: 12px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .cadastro-container button {
            width: 100%;
            padding: 12px;
            font-size: 24px;
            background-color: #cccccc;
            color: #7B7E84;
            border: none;
            border-radius: 8px;
            cursor: not-allowed;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="cadastro-container">
        <form>
            <h2>Criar Conta</h2>
            <label for="nome">Nome Completo:</label>
            <input type="text" id="nome" name="nome" required />

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required />

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required />

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required />

            <label for="dataNascimento">Data de Nascimento:</label>
            <input type="date" id="dataNascimento" name="dataNascimento" required />

            <h3>Endereço Completo</h3>
            <label for="cep">CEP:</label>
            <input type="text" id="cep" name="cep" required />

            <label for="rua">Rua:</label>
            <input type="text" id="rua" name="rua" required />

            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero" required />

            <label for="complemento">Complemento:</label>
            <input type="text" id="complemento" name="complemento" />

            <label for="bairro">Bairro:</label>
            <input type="text" id="bairro" name="bairro" required />

            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" required />

            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado" required />

            <button type="submit">Continuar</button>
        </form>
    </div>
</body>

</html>


{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
