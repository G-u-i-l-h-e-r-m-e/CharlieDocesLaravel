<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="/css/header.css">
    <!-- Fonte Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <!-- Seção do Header com busca e logo -->
        <section>
            <!-- Área de busca -->
            <div class="search">
                <input type="text" placeholder="O que você procura?" id="search-input">
                <!-- Resultados de busca exibidos dinamicamente -->
                <div class="search-results" id="search-results"></div>
            </div>

            <!-- Logo -->
            <img src="/img/header/Charlie_logo_ofc 4.svg" alt="Logo loja de doces">

            <!-- Opções de usuário -->
            <nav class="header-componentes">
                <div class="user-options">
                    <img src="/img/header/logo.svg" alt="Usuário">
                    <a href="#">Entre ou <br>Cadastre-se</a>
                </div>

                <div class="user-options">
                    <img src="/img/header/carrinho.svg" alt="Carrinho">
                    <a href="#">Carrinho de <br>Compras</a>
                </div>
            </nav>
        </section>

        <!-- Menu de navegação principal -->
        <nav class="header-options">
            <ul>
                <li class="dropdown">
                    <a href="#" class="dropdownTitulo">Ver todas as Categorias</a>
                    <!-- Este menu será preenchido dinamicamente -->
                    <div class="dropdown-menu">
                        <!-- Exemplo de categorias fictícias, a serem substituídas dinamicamente -->
                        @foreach($categorias as $categoria)
                        <a href="/categoria/{{$categoria->CATEGORIA_ID}}">{{$categoria->CATEGORIA_NOME}}</a>
                        @endforeach
                    </div>
                </li>
                <li><a href="#" class="dropdownTitulo">Mais Vendidos</a></li>
                <li><a href="#" class="dropdownTitulo">Novidades</a></li>
                <li><a href="#" class="dropdownTitulo">Promoções</a></li>
                <li><a href="#" class="dropdownTitulo">Preferências</a></li>
            </ul>
        </nav>
    </header>

    <script src="/js/header.js"></script>
</body>

</html>