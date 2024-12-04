<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('img/header/logo.svg') }}" sizes="64x64" type="image/svg">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/login/login.css'])

</head>

<body>
    @extends('layouts.app')

    @section('title', 'Login')

    @section('content')
        @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()]);
        <div class="login-container">
            <div class="login-form">
                <h2>Entrar ou Criar Conta</h2>
                <form id="login-form" class="login-form" method="POST" action="{{ route('email') }}">
                    @csrf
                    <div>
                        <label for="email">Email ou CPF</label>
                        <input type="text" id="email" name="email"
                            placeholder="exemplo@exemplo.com.br ou XXX.XXX.XXX-XX" value="{{ old('email') }}">
                        @error('email')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <button type="submit">Entrar</button>
                    </div>
            </div>
            </form>
        </div>
        @include('profile.partials.footer');

        @push('styles')
            @vite(['resources/css/login/login.css'])
        @endpush

        @push('scripts')
            @vite(['resources/js/login-emai.js']) <!-- Se existir, caso contrário, use login.js -->
        @endpush
    </body>

    </html>
