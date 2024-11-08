
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueceu a senha</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
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

        .forgotpassword-container {
            display: flex;
            justify-content: center;
            text-align: start;
            width: 700px;
            height: 700px;
            font-family: 'Poppins', sans-serif;
        }

        .forgotpassword-container h2 {
            font-size: 32px;
            color: #4A2F25;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .forgotpassword-container label {
            display: block;
            font-size: 24px;
            color: #8B4513;
            margin-bottom: 8px;
            text-align: left;
        }

        .forgotpassword-container input[type="text"] {
            width: 698px;
            height: 52px;
            padding: 12px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .forgotpassword-container button {
            width: 100%;
            padding: 12px;
            font-size: 24px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .forgotpassword-container button:hover {
            background-color: #45A049;
        }

        .forgotpassword-container p {
            font-weight: 500;
            font-size: 24px;
            line-height: 30px;
            margin-bottom: 5px;
            color: #591F12;
        }
    </style>
</head>

<body>
    <div class="forgotpassword-container">
        <form>
            <h2>Esqueceu a senha</h2>
            <label for="email-cpf">Forneça o endereço de e-mail da sua conta para receber um e-mail de redefinição de
                senha</label>
            <input type="text" id="email" name="email" placeholder="exemplo@exemplo.com.br">
            <a href="/enviado">
                <button type="button">Enviar</button>
            </a>
        </form>
    </div>
</body>

</html>

{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
