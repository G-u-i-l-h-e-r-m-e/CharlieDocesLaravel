<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card</title>
    <link rel="stylesheet" href="/css/componentes-style/component-card.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src='https://unpkg.com/boxicons@2.1.4/dist/boxicons.js'></script>
</head>

<body>
    <div class="card-container" data-product-id="{{ $produto->PRODUTO_ID }}">
        <div class="card-img-container" data-url="/produto/{{ $produto->PRODUTO_ID }}">
            <!-- Imagens do produto -->
            <div class="carousel-images">
                @if($produto->produto_imagens->isNotEmpty())
                    @foreach($produto->produto_imagens->take(3) as $index => $imagem)
                        <img class="carousel-image {{ $index === 0 ? 'active' : '' }}" src="{{ $imagem->IMAGEM_URL }}"
                            alt="Imagem do Produto" data-index="{{ $index }}">
                    @endforeach
                @else
                    <p>Nenhuma imagem disponível.</p>
                @endif
            </div>

            <!-- Indicadores do carrossel de imagens -->
            <div class="carousel-indicators">
                @for ($i = 0; $i < min(3, $produto->produto_imagens->count()); $i++)
                    <div class="indicator {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}"></div>
                @endfor
            </div>
        </div>

        <!-- Nome do produto com Redirecionamento -->
        <p class="produto-nome" data-url="/produto/{{ $produto->PRODUTO_ID }}">{{ $produto->PRODUTO_NOME }}</p>

        <!-- Preço do produto com Redirecionamento -->
        <div class="preco-container" data-url="/produto/{{ $produto->PRODUTO_ID }}">
            @if($produto->PRODUTO_DESCONTO > 0)
                <span class="preco-original">R${{ $produto->PRODUTO_PRECO }}</span>
                <span class="preco-com-desconto">R${{ $produto->PRODUTO_PRECO - $produto->PRODUTO_DESCONTO }}</span>
            @else
                <span class="preco-final">R${{ $produto->PRODUTO_PRECO }}</span>
            @endif
        </div>

        <!-- Controle de quantidade -->
        <div class="settings-container">
            <button class="buttons-settings">-</button>
            <span class="countItens">1</span>
            <button class="buttons-settings">+</button>
        </div>

        <!-- Botão para adicionar ao carrinho -->
        <button class="add-cart" type="button" data-produto-id="{{ $produto->PRODUTO_ID }}">
            <a href="/carrinho/{{ $produto->PRODUTO_ID }}">Adicionar ao carrinho</a>
        </button>
    </div>


    <!-- Inclua o JavaScript -->
    @vite('resources/js/componentes-produtos/component-card.js')

</body>

</html>