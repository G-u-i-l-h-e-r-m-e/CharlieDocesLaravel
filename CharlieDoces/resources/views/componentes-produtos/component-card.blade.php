<div class="card-container" data-product-id="{{ $produto->PRODUTO_ID }}">
    <div class="card-img-container">
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
    <button class="add-to-cart-btn" type="button" data-produto-id="{{ $produto->PRODUTO_ID }}">
        <span class="cart-button-text">Adicionar ao carrinho</span>
        <span class="cart-button-icon" style="display: none;">
            <box-icon name='block' color='#d94a4a'></box-icon></span>
    </button>

</div>