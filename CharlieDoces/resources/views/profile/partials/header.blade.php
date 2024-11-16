<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charlie Loja de Doces</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
</head>

<body>
    <header>
        <nav>
            <!-- Bloco 1: Linhas decorativas e logo -->
            <div class="logo-section">
                <span class="line"></span>
                <a href="{{ url('/') }}">
                    <img src="{{ asset('img/header/logo.svg') }}" alt="Logo Charlie Loja de Doces">
                </a>
                <span class="line"></span>
            </div>

            <!-- Bloco 2: Campo de pesquisa e nome da loja -->
            <div class="header-search">
                <div class="search-section">
                    <div class="search-box">
                        <input type="text" placeholder="O QUE VOCÊ ESTÁ PROCURANDO?" class="search-input">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(89, 31, 18, 1);">
                                <path d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16 9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854 1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z"></path>
                            </svg>
                        </button>
                    </div>

                    <img src="{{ asset('img/header/name-img.svg') }}" alt="Nome da Loja">
                    <div>
                        <p class="ney">neymar</p>
                    </div>
                </div>
            </div>

            <!-- Bloco 3: Navegação -->
            <div class="nav-section">
                <a href="/todos_produtos">Todos os Produtos</a>
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                style="fill: rgba(89, 31, 18, 1);">
                                <path
                                    d="M12 2A10.13 10.13 0 0 0 2 12a10 10 0 0 0 4 7.92V20h.1a9.7 9.7 0 0 0 11.8 0h.1v-.08A10 10 0 0 0 22 12 10.13 10.13 0 0 0 12 2zM8.07 18.93A3 3 0 0 1 11 16.57h2a3 3 0 0 1 2.93 2.36 7.75 7.75 0 0 1-7.86 0zm9.54-1.29A5 5 0 0 0 13 14.57h-2a5 5 0 0 0-4.61 3.07A8 8 0 0 1 4 12a8.1 8.1 0 0 1 8-8 8.1 8.1 0 0 1 8 8 8 8 0 0 1-2.39 5.64z">
                                </path>
                                <path
                                    d="M12 6a3.91 3.91 0 0 0-4 4 3.91 3.91 0 0 0 4 4 3.91 3.91 0 0 0 4-4 3.91 3.91 0 0 0-4-4zm0 6a1.91 1.91 0 0 1-2-2 1.91 1.91 0 0 1 2-2 1.91 1.91 0 0 1 2 2 1.91 1.91 0 0 1-2 2z">
                                </path>
                            </svg>
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ url('/login') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(89, 31, 18, 1);">
                            <path d="M12 2A10.13 10.13 0 0 0 2 12a10 10 0 0 0 4 7.92V20h.1a9.7 9.7 0 0 0 11.8 0h.1v-.08A10 10 0 0 0 22 12 10.13 10.13 0 0 0 12 2zM8.07 18.93A3 3 0 0 1 11 16.57h2a3 3 0 0 1 2.93 2.36 7.75 7.75 0 0 1-7.86 0zm9.54-1.29A5 5 0 0 0 13 14.57h-2a5 5 0 0 0-4.61 3.07A8 8 0 0 1 4 12a8.1 8.1 0 0 1 8-8 8.1 8.1 0 0 1 8 8 8 8 0 0 1-2.39 5.64z"></path>
                            <path d="M12 6a3.91 3.91 0 0 0-4 4 3.91 3.91 0 0 0 4 4 3.91 3.91 0 0 0 4-4 3.91 3.91 0 0 0-4-4zm0 6a1.91 1.91 0 0 1-2-2 1.91 1.91 0 0 1-2-2 1.91 1.91 0 0 1-2 2z"></path>
                        </svg>
                        Entre ou cadastre-se
                    </a>
                @endauth
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(89, 31, 18, 1);">
                        <path
                            d="M21.822 7.431A1 1 0 0 0 21 7H7.333L6.179 4.23A1.994 1.994 0 0 0 4.333 3H2v2h2.333l4.744 11.385A1 1 0 0 0 10 17h8c.417 0 .79-.259.937-.648l3-8a1 1 0 0 0-.115-.921zM17.307 15h-6.64l-2.5-6h11.39l-2.25 6z">
                        </path>
                        <circle cx="10.5" cy="19.5" r="1.5"></circle>
                        <circle cx="17.5" cy="19.5" r="1.5"></circle>
                    </svg>
                    Carrinho
                </a>
            </div>
        </nav>
    </header>
</body>

</html>
