<!-- resources/views/profile/show.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <!-- Incluir os assets compilados pelo Vite -->
    @vite([
        'resources/css/profile.css',               // Novo CSS para o perfil
        'resources/css/app.css',
        'resources/css/header.css',
        'resources/css/footer.css',
        'resources/css/todos_produtos.css',
        'resources/css/pagination.css',
        // JS files (se houver necessidade específica)
        'resources/js/app.js',
        'resources/js/componentes-produtos/component-card.js',
        'resources/js/carrousel-categoria.js',
        'resources/js/categoria.js',
        'resources/js/header.js',
        'resources/js/login.js',
        'resources/js/produto.js',
        'resources/js/todos_produtos.js',
    ])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Incluir jQuery via CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Incluir SweetAlert2 via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()])

    <section class="orientationProfile">
        <div class="container">
            <h1>Perfil do Usuário</h1>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informações Pessoais</h5>
                    <p><strong>Nome:</strong> {{ $user->USUARIO_NOME }}</p>
                    <p><strong>Email:</strong> {{ $user->USUARIO_EMAIL }}</p>
                    <p><strong>CPF:</strong> {{ $user->USUARIO_CPF }}</p>
                    <hr>
                    <h5 class="card-title mt-4">Endereço</h5>
                    @if ($endereco)
                        <p><strong>Nome:</strong> {{ $endereco->ENDERECO_NOME}}</p>
                        <p><strong>Rua:</strong> {{ $endereco->ENDERECO_LOGRADOURO }}</p>
                        <p><strong>Número:</strong> {{ $endereco->ENDERECO_NUMERO }}</p>
                        <p><strong>Complemento:</strong> {{ $endereco->ENDERECO_COMPLEMENTO }}</p>
                        <p><strong>CEP:</strong> {{ $endereco->ENDERECO_CEP }}</p>
                        <p><strong>Cidade:</strong> {{ $endereco->ENDERECO_CIDADE }}</p>
                        <p><strong>Estado:</strong> {{ $endereco->ENDERECO_ESTADO }}</p>
                    @else
                        <p>Sem endereço cadastrado.</p>
                    @endif
                    <button type="button" class="btnEditar mt-3" data-bs-toggle="modal" data-bs-target="#editModal">
                        Editar Informações
                    </button>
                </div>
            </div>
        </div>
        <div>
            @include('historico.index', ['pedidoItems' => $pedidoItems])
        </div>
    </section>
    <!-- Modal para Edição -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Informações</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulário de Edição -->
                    <form id="editProfileForm" action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <section class="orientationModal">
                            <!-- Informações Pessoais e Endereço lado a lado -->
                            <div class="row">
                                <!-- Informações Pessoais -->
                                <div class="col-md-6">
                                    <h5 class="mt-4">Informações Pessoais</h5>
                                    <div class="mb-3">
                                        <label for="USUARIO_NOME" class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="USUARIO_NOME" name="USUARIO_NOME" value="{{ $user->USUARIO_NOME }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="USUARIO_EMAIL" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="USUARIO_EMAIL" name="USUARIO_EMAIL" value="{{ $user->USUARIO_EMAIL }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="USUARIO_CPF" class="form-label">CPF</label>
                                        <input type="text" class="form-control" id="USUARIO_CPF" name="USUARIO_CPF" value="{{ $user->USUARIO_CPF }}" required>
                                    </div>
                                </div>

                                <!-- Endereço -->
                                <div class="col-md-6">
                                    <h5 class="mt-4">Endereço</h5>
                                    @if ($endereco)
                                        <div class="mb-3">
                                            <label for="ENDERECO_LOGRADOURO" class="form-label">Rua</label>
                                            <input type="text" class="form-control" id="ENDERECO_LOGRADOURO" name="ENDERECO_LOGRADOURO" value="{{ $endereco->ENDERECO_LOGRADOURO }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ENDERECO_NUMERO" class="form-label">Número</label>
                                            <input type="text" class="form-control" id="ENDERECO_NUMERO" name="ENDERECO_NUMERO" value="{{ $endereco->ENDERECO_NUMERO }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ENDERECO_COMPLEMENTO" class="form-label">Complemento</label>
                                            <input type="text" class="form-control" id="ENDERECO_COMPLEMENTO" name="ENDERECO_COMPLEMENTO" value="{{ $endereco->ENDERECO_COMPLEMENTO }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="ENDERECO_CEP" class="form-label">CEP</label>
                                            <input type="text" class="form-control" id="ENDERECO_CEP" name="ENDERECO_CEP" value="{{ $endereco->ENDERECO_CEP }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ENDERECO_CIDADE" class="form-label">Cidade</label>
                                            <input type="text" class="form-control" id="ENDERECO_CIDADE" name="ENDERECO_CIDADE" value="{{ $endereco->ENDERECO_CIDADE }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ENDERECO_ESTADO" class="form-label">Estado</label>
                                            <input type="text" class="form-control" id="ENDERECO_ESTADO" name="ENDERECO_ESTADO" value="{{ $endereco->ENDERECO_ESTADO }}" required>
                                        </div>
                                    @else
                                        <p>Sem endereço cadastrado.</p>
                                    @endif
                                </div>
                            </div>
                        </section>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btnEditar">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('profile.partials.footer')
</body>
</html>