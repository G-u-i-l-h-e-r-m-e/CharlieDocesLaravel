
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/login/cadastro.css">
    <link rel="icon" href="{{ asset('img/header/logo.svg') }}" sizes="64x64" type="image/svg">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        span {
            color: red;
        }
    </style>
    <!-- Scripts -->
    @vite([
        'resources/css/app.css',
        'resources/css/login/cadastro.css',
        'resources/css/header.css',
        'resources/css/footer.css',
        'resources/css/todos_produtos.css',
        'resources/css/card-produto-todos-produtos.css',
        // JS files
        'resources/js/app.js',
        'resources/js/header.js',
        'resources/js/login.js',
        'resources/js/login/cadastro.js',
        'resources/js/produto.js',
        'resources/js/todos_produtos.js',
    ])
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <section>
        @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()]);
    </section>
    <div id="cadastro">
        <div class="cadastro-container">
            <div class="cadastro-form">
                <h2>Criar Conta</h2>
                <form method="POST" action="{{ route('cadastro') }}">
                    @csrf
                    <div>
                        <label for="name">Nome Completo:</label>
                        <input type="text" id="name" name="name" oninput="validateName()" />
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" />
                        @error('email')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="senha">Senha:</label>
                        <input v-model="password" type="password" id="password" name="password" />
                        <ul v-show="password">
                            <li :class="{ senhaValida: password.length >= 8, senhaNaoValida: password.length < 8 }">
                                Mínimo de 8 caracteres</li>
                            <li
                                :class="{ senhaValida: /[A-Z]/.test(password), senhaNaoValida: !/[A-Z]/.test(password) }">
                                Incluir ao menos uma letra maiúscula</li>
                            <li
                                :class="{ senhaValida: /[0-9]/.test(password), senhaNaoValida: !/[0-9]/.test(password) }">
                                Incluir ao menos um número</li>
                            <li
                                :class="{ senhaValida: caracteresEspeciaisValidos, senhaNaoValida: !caracteresEspeciaisValidos }">
                                Incluir ao menos um caractere especial</li>
                        </ul>
                        @error('password')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation">Confirme a Senha:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" />
                        @error('password_confirmation')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="cpf">CPF:</label>
                        <input type="text" id="cpf" name="cpf" />
                        @error('cpf')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <h3>Endereço Completo</h3>
                    
                    <div>
                        <label for="cep">CEP:</label>
                        <input type="text" id="cep" name="cep" />
                        @error('cep')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="logradouro">Rua:</label>
                        <input type="text" id="logradouro" name="logradouro" />
                        @error('logradouro')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="numero">Número:</label>
                        <input type="text" id="numero" name="numero" />
                        @error('numero')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="complemento">Complemento:</label>
                        <input type="text" id="complemento" name="complemento" />
                        @error('complemento')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                    </div>
                    <div>
                        <label for="bairro">Bairro:</label>
                        <input type="text" id="bairro" name="bairro" />
                        @error('bairro')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="cidade">Cidade:</label>
                        <input type="text" id="cidade" name="cidade" />
                        @error('cidade')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="estado">Estado:</label>
                        <select id="estado" name="estado">
                            <option></option>
                            <option v-for="estado in estados" :key="estado.sigla" :value="estado.sigla">
                                @{{ estado.sigla }} - @{{ estado.nome }}</option>
                        </select>
                        @error('estado')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <button type="submit">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
    <section>
        @include('profile.partials.footer');
    </section>

    <script src="js/login/cadastro.js"></script>
</body>

</html>
