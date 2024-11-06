<x-cadastrousuario-layout>
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden md:max-w-md">
            <div class="md:flex">
                <div class="w-full p-3 px-6 py-10">
                    <h2 class="text-2xl font-bold text-center">Criar Conta</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nome -->
                        <div class="mt-4">
                            <x-input-label for="nome" :value="__('Nome')" />
                            <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus />
                            <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Senha -->
                        <div class="mt-4">
                            <x-text-input id="senha" class="block mt-1 w-full" type="password" name="senha" :value="old('senha')" required />
                            <x-input-label for="senha" :value="__('Senha')" />
                            <x-input-error :messages="$errors->get('senha')" class="mt-2" />
                        </div>

                        <!-- CPF -->
                        <div class="mt-4">
                            <x-input-label for="cpf" :value="__('CPF')" />
                            <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')" required  />
                            <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
                        </div>

                        <!-- Data de nascimento -->
                        <div class="mt-4">
                            <x-text-input id="dataNascimento" class="block mt-1 w-full" type="date" name="dataNascimento" :value="old('dataNascimento')" required />
                            <x-input-label for="dataNascimento" :value="__('Data de nascimento')" />
                            <x-input-error :messages="$errors->get('dataNascimento')" class="mt-2" />
                        </div>

                        <!-- CEP -->
                        <div class="mt-4">
                            <x-input-label for="cep" :value="__('CEP')" />
                            <x-text-input id="cep" class="block mt-1 w-full" type="text" name="cep" :value="old('cep')" required />
                            <x-input-error :messages="$errors->get('cep')" class="mt-2" />
                        </div>

                        <!-- Rua -->
                        <div class="mt-4">
                            <x-input-label for="rua" :value="__('Rua')" />
                            <x-text-input id="rua" class="block mt-1 w-full" type="text" name="rua" :value="old('rua')" required />
                            <x-input-error :messages="$errors->get('rua')" class="mt-2" />
                        </div>

                        <!-- Numero -->
                        <div class="mt-4">
                            <x-input-label for="numero" :value="__('Numero')" />
                            <x-text-input id="numero" class="block mt-1 w-full" type="number" name="numero" :value="old('numero')" required />
                            <x-input-error :messages="$errors->get('numero')" class="mt-2" />
                        </div>

                        <!-- Complemento -->
                        <div class="mt-4">
                            <x-input-label for="complemento" :value="__('Complemento')" />
                            <x-text-input id="complemento" class="block mt-1 w-full" type="text" name="complemento" :value="old('complemento')" required />
                            <x-input-error :messages="$errors->get('complemento')" class="mt-2" />
                        </div>

                        <!-- Bairro -->
                        <div class="mt-4">
                            <x-input-label for="bairro" :value="__('Bairro')" />
                            <x-text-input id="bairro" class="block mt-1 w-full" type="text" name="bairro" :value="old('bairro')" required />
                            <x-input-error :messages="$errors->get('bairro')" class="mt-2" />
                        </div>

                        <!-- Cidade -->
                        <div class="mt-4">
                            <x-input-label for="cidade" :value="__('Complemento')" />
                            <x-text-input id="cidade" class="block mt-1 w-full" type="text" name="cidade" :value="old('cidade')" required />
                            <x-input-error :messages="$errors->get('cidade')" class="mt-2" />
                        </div>

                        <!-- Estado -->
                        <div class="mt-4">
                            <x-input-label for="estado" :value="__('Estado')" />
                            <x-text-input id="estado" class="block mt-1 w-full" type="text" name="estado" :value="old('estado')" required />
                            <x-input-error :messages="$errors->get('estado')" class="mt-2" />
                        </div>
                        <x-primary-button class="ml-4">
                            {{ __('Registrar') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-cadastrousuario-layout>
{{-- <div class="flex items-center justify-end mt-4">
    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
        {{ __('Já tem uma conta?') }}
    </a>

</div> --}}