<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Final</title>
    <link rel="stylesheet" href="{{ asset('css/componentes-style/component-card.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/temporario/teste-final.css') }}">
</head>

<body>
    <div class="container">
        <h1>Teste Final</h1>

        <!-- Incluindo o componente carousel-natal -->
        @include('componentes-produtos.carousel-natal', ['produtosNatal' => $produtosNatal])

        <!-- Paginação -->
        <div class="pagination">
            {{ $produtosNatal->links() }}
        </div>
    </div>
</body>

</html>