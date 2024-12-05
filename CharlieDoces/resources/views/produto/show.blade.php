<!-- resources/views/produto/show.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produto->PRODUTO_NOME }}</title>
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">

    @vite([
        'resources/css/app.css',
        'resources/css/componentes-style/component-card.css',
        'resources/css/header.css',
        'resources/css/footer.css',
        'resources/css/produtoShow.css',
        'resources/css/componentes-style/carousel-relacionados.css',
        'resources/js/app.js',
        'resources/js/componentes-produtos/component-card.js',
        'resources/js/banner.js',
        'resources/js/componentes-produtos/carousel-natal.js',
        'resources/js/componentes-produtos/carousel-chocolate.js',
        'resources/js/componentes-produtos/carousel-relacionados.js', 
        'resources/js/header.js',
    ])

    <!-- Outros meta tags e links -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
        @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()])

    <!-- Inclui os breadcrumbs -->
    @include('components.breadcrumbs')

    <!-- Container específico para estilização no produtoShow.css -->
    <div class="produto-show-container">
        <!-- Utilizando o componente para exibir os detalhes do produto -->
        @include('componentes-produtos.component-card', [
            'produto' => $produto,
            'contexto' => 'produto_show'
        ])
    </div>

    <!-- Seção de Produtos Relacionados -->
    <div class="home-carousels-container">
        <div class="home-component-title-relacionados animate__animated animate__headShake">
            @include('componentes-produtos.component-title', [
                'titulo' => 'Produtos Relacionados',
                'subtitulo' => 'Produtos similares que você pode gostar',
            ])
        </div>

        @include('componentes-produtos.carousel-relacionados', ['produtosRelacionados' => $produtosRelacionados])
    </div>


        @include('profile.partials.footer')

    <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>


</body>

</html>
