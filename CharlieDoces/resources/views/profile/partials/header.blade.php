<!-- resources/views/profile/partials/header.blade.php -->

<header>
    <nav class="navegacao">
        <!-- Bloco 1: Linhas decorativas e logo -->
        <div class="nav-top-section">
            <span class="line"></span>
            <a href="{{ url('/home') }}">
                <img src="{{ Vite::asset('resources/img/header/logo.svg') }}" alt="Logo Charlie Loja de Doces">
            </a>
            <span class="line"></span>
        </div>

        <div class="nav-center-section">
            <div class="search-section">
                <form action="{{ route('search.results') }}" method="GET" class="search-box">
                    <input type="text" name="query" placeholder="O QUE VOCÊ ESTÁ PROCURANDO?" class="search-input">
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(89, 31, 18, 1);">
                            <path
                                d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16 9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854 1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z">
                            </path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <div class="store-name-arc">
            <!-- Arco com o nome da loja -->
            <svg width="293.1" height="59.41" viewBox="0 0 293.1 59.41">
                <path id="arcPath" d="M0,59.41 Q146.55,30 293.1,59.41" fill="transparent" />
                <text font-family="Bebas Neue" font-size="48px" fill="#591F12">
                    <textPath href="#arcPath" startOffset="50%" text-anchor="middle">
                        LOJA DE DOCES
                    </textPath>
                </text>
            </svg>
        </div>

        <!-- Placeholder para manter o espaço do logout quando o usuário não está logado -->
        @if (!Auth::check())
            <div class="logout-placeholder"></div>
        @endif

        @if (Auth::check())
            <div class="logout-section">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-icon">
                        <box-icon name='log-out' color='#591f12'></box-icon>
                    </button>
                </form>
            </div>
        @endif

        <!-- Bloco 3: Navegação -->
        <div class="nav-bottom-section">
            <div class="nav-bottom-content">
                <!-- Link para Todos os Produtos -->
                <a href="{{ url('/todos_produtos') }}">Todos os Produtos</a>

                @if (Auth::check())
                    <!-- Saudação com o nome do usuário quando estiver logado -->
                    <a href="{{ route('profile.show') }}">
                        Olá, {{ Auth::user()->USUARIO_NOME }}
                    </a>
                @else
                    <!-- Exibe "Entre ou cadastre-se" quando não estiver logado -->
                    <a href="{{ route('login') }}">
                        Entre ou cadastre-se
                    </a>
                @endif

                <!-- Ícone do carrinho -->
                <a href="{{ Auth::check() ? route('carrinho.exibir') : route('login') }}" class="cart-link">
                    <box-icon name='cart' color='#591f12'></box-icon>
                    Carrinho
                    @if (Auth::check())
                        @php
                            $cartItemCount = \App\Models\Carrinho::where('USUARIO_ID', Auth::id())->sum('ITEM_QTD');
                        @endphp
                        @if ($cartItemCount > 0)
                            <span class="cart-badge">{{ $cartItemCount }}</span>
                        @endif
                    @endif
                </a>
            </div>
        </div>
    </nav>
</header>
