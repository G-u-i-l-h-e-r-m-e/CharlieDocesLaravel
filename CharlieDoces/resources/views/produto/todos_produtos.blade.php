<!-- resources/views/produto/todos_produtos.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Meta tags e título -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos os Produtos</title>

    <!-- Boxicons -->
    <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>

    <!-- Meta tag CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Meta tag para a rota 'produtos.filtrar' -->
    <meta name="route-produtos-filtrar" content="{{ route('produtos.filtrar') }}">

    <!-- Incluir os assets compilados pelo Vite -->
    @vite([
    // CSS files
    'resources/css/app.css',
    'resources/css/componentes-style/component-card.css',
    'resources/css/header.css',
    'resources/css/footer.css',
    'resources/css/todos_produtos.css',
    // JS files
    'resources/js/app.js',
    'resources/js/componentes-produtos/component-card.js',
    'resources/js/carrousel-categoria.js',
    'resources/js/categoria.js',
    'resources/js/header.js',
    'resources/js/login.js',
    'resources/js/produto.js',
    'resources/js/todos_produtos.js',
])

    <!-- Incluir jQuery via CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Incluir SweetAlert2 via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="produtos-page">
    <!-- Inclui o header -->
    <section>
        @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()])
    </section>

    <!-- Inclui os breadcrumbs -->
    @include('components.breadcrumbs')

    <section class="orientationMain">
        <aside>
            <section class="filtro">
                <h3>Categorias</h3>
                <label>
                    <input type="radio" name="categoria" class="categoria-radio" data-categoria="" checked>
                    Todos os Produtos
                </label><br>
                @foreach($categorias as $categoria)
                    <label>
                        <input type="radio" name="categoria" class="categoria-radio"
                            data-categoria="{{ $categoria->CATEGORIA_NOME }}">
                        {{ $categoria->CATEGORIA_NOME }}
                    </label><br>
                @endforeach
            </section>
        </aside>

        <section class="container-produtos-title-filter">
            <h2 id="titulo-categoria">Todos os Produtos</h2>

            <!-- Filtro de ordenação -->
            <div class="filtro-ordenacao">
                <p>Filtrar produto por:</p>
                <select id="ordenar-produtos">
                    <option value="menor_preco">Menor Preço</option>
                    <option value="maior_preco">Maior Preço</option>
                    <option value="a_z">A - Z</option>
                    <option value="z_a">Z - A</option>
                </select>
            </div>

            <main class="produtos-container" id="produtos-lista">
                @include('produto.produtos_list', ['produtos' => $produtos])
            </main>
        </section>

    </section>
    <section id="paginacao" data-current-page="{{ $produtos->currentPage() }}">
        {{ $produtos->links('pagination::bootstrap-4') }}
        <button id="ver-mais" type="button">Ver Mais</button>
    </section>

    <!-- Inclui o footer -->
    <section>
        @include('profile.partials.footer')
    </section>
</body>

</html>