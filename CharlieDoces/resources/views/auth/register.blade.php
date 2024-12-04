<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
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
        'resources/js/produto.js',
        'resources/js/todos_produtos.js',
    ])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <section>
        @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()]);
    </section>
    <div class="cadastro-container">
        <div class="cadastro-form">
            <h2>Criar Conta</h2>
            <form method="POST" action="{{ route('cadastro') }}">
                @csrf

                <div>
                    <label for="name">Nome Completo:</label>
                    <input type="text" id="name" name="name" required />
                    @error('name')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required />
                    @error('email')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="senha">Senha:</label>
                    <input type="password" id="password" name="password" required />
                    @error('password')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation">Confirme a Senha:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required />
                    @error('password_confirmation')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" required />
                    @error('cpf')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <h3>Endereço Completo</h3>
                <div>
                    <label for="cep">CEP:</label>
                    <input type="text" id="cep" name="cep" required />
                    @error('cep')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="logradouro">Rua:</label>
                    <input type="text" id="logradouro" name="logradouro" required />
                    @error('logradouro')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="numero">Número:</label>
                    <input type="text" id="numero" name="numero" required />
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
                    <input type="text" id="bairro" name="bairro" required />
                    @error('bairro')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="cidade">Cidade:</label>
                    <input type="text" id="cidade" name="cidade" required />
                    @error('cidade')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="estado">Estado:</label>
                    <input type="text" id="estado" name="estado" required />
                    @error('estado')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </div>
    <section>
        @include('profile.partials.footer');
    </section>
</body>

</html>
