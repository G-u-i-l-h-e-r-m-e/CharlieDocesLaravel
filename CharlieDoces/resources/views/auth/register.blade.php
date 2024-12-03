<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')

@section('title', 'Cadastro')

@section('content')
<div id="cadastro">
    <div class="cadastro-container">
        <div class="cadastro-form">
            <h2>Criar Conta</h2>
            <form method="POST" action="{{ route('cadastro') }}">
                @csrf

                <div>
                    <label for="name">Nome Completo:</label>
                    <input type="text" id="name" name="name" oninput="validateName()" value="{{ old('name') }}" required />
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required />
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="senha">Senha:</label>
                    <input v-model="password" type="password" id="password" name="password" required />
                    <ul v-show="password">
                        <li :class="{ senhaValida: password.length >= 8, senhaNaoValida: password.length < 8 }">
                            Mínimo de 8 caracteres
                        </li>
                        <li :class="{ senhaValida: /[A-Z]/.test(password), senhaNaoValida: !/[A-Z]/.test(password) }">
                            Incluir ao menos uma letra maiúscula
                        </li>
                        <li :class="{ senhaValida: /[0-9]/.test(password), senhaNaoValida: !/[0-9]/.test(password) }">
                            Incluir ao menos um número
                        </li>
                        <li :class="{ senhaValida: caracteresEspeciaisValidos, senhaNaoValida: !caracteresEspeciaisValidos }">
                            Incluir ao menos um caractere especial
                        </li>
                    </ul>

                    @error('password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation">Confirme a Senha:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required />
                    @error('password_confirmation')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" value="{{ old('cpf') }}" required />
                    @error('cpf')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <h3>Endereço Completo</h3>
                <div>
                    <label for="estado">Estado:</label>
                    <select id="estado" name="estado" required>
                        <option value="">Selecione</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado['sigla'] }}">{{ $estado['sigla'] }} - {{ $estado['nome'] }}</option>
                        @endforeach
                    </select>
                    @error('estado')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="cidade">Cidade:</label>
                    <input type="text" id="cidade" name="cidade" value="{{ old('cidade') }}" required />
                    @error('cidade')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="cep">CEP:</label>
                    <input type="text" id="cep" name="cep" value="{{ old('cep') }}" required />
                    @error('cep')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="logradouro">Rua:</label>
                    <input type="text" id="logradouro" name="logradouro" value="{{ old('logradouro') }}" required />
                    @error('logradouro')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="numero">Número:</label>
                    <input type="text" id="numero" name="numero" value="{{ old('numero') }}" required />
                    @error('numero')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="complemento">Complemento:</label>
                    <input type="text" id="complemento" name="complemento" value="{{ old('complemento') }}" />
                    @error('complemento')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="bairro">Bairro:</label>
                    <input type="text" id="bairro" name="bairro" value="{{ old('bairro') }}" required />
                    @error('bairro')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
    @vite(['resources/css/login/cadastro.css'])
@endpush

@push('scripts')
    @vite(['resources/js/login.js'])
@endpush
