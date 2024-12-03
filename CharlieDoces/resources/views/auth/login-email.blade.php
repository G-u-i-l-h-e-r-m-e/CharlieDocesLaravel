<!-- resources/views/auth/login-emai.blade.php -->
@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="login-container">
        <div class="login-form">
            <h2>Entrar ou Criar Conta</h2>
            <form id="login-form" class="login-form" method="POST" action="{{ route('email') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email ou CPF</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="exemplo@exemplo.com.br ou XXX.XXX.XXX-XX"
                        value="{{ old('email') }}" required>
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    @vite(['resources/css/login/login.css'])
@endpush

@push('scripts')
    @vite(['resources/js/login-emai.js']) <!-- Se existir, caso contrário, use login.js -->
@endpush
