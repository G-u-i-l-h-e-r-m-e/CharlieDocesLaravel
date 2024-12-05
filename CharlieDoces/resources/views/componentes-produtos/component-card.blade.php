<!-- resources/views/componentes-produtos/component-card.blade.php -->

@php
    // Determina o contexto de uso do componente
    $isTodosProdutos = isset($contexto) && $contexto === 'todos_produtos';
    $isProdutoShow = isset($contexto) && $contexto === 'produto_show';
@endphp

<div class="card-container {{ $isTodosProdutos ? 'todos-produtos' : ($isProdutoShow ? 'produto-show' : '') }}"
    data-product-id="{{ $produto->PRODUTO_ID }}">
    
    <!-- Imagens do produto (Comum a todos os contextos) -->
    <div class="card-img-container">
        <div class="carousel-images">
            @if($produto->produto_imagens && $produto->produto_imagens->isNotEmpty())
                @foreach($produto->produto_imagens->take(3) as $index => $imagem)
                    <img class="carousel-image {{ $index === 0 ? 'active' : '' }}" src="{{ $imagem->IMAGEM_URL }}"
                        alt="Imagem do Produto" data-index="{{ $index }}">
                @endforeach
            @else
                <p class="imagemProduto">Nenhuma imagem disponível.</p>
            @endif
        </div>

        <!-- Indicadores do carrossel de imagens -->
        <div class="carousel-indicators">
            @for ($i = 0; $i < min(3, $produto->produto_imagens->count()); $i++)
                <div class="indicator {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}"></div>
            @endfor
        </div>
    </div>

    @if ($isProdutoShow)
        <!-- Conteúdo específico para o contexto 'produto_show' -->
        <div class="orientation-show-produts">
            <!-- Nome do produto -->
            <p class="produto-nome">{{ $produto->PRODUTO_NOME }}</p>
            
            <!-- Descrição do produto -->
            <p class="produto-desc">{{ $produto->PRODUTO_DESC }}</p>

            <div class="specific-structure">
                <!-- Preço do produto -->
                <div class="preco-container">
                    @if($produto->PRODUTO_DESCONTO > 0)
                        <span class="preco-original">
                            <span class="simbolo">R$</span>
                            {{ number_format($produto->PRODUTO_PRECO, 2, ',', '.') }}
                        </span>
                        <span class="preco-com-desconto">
                            <span class="simbolo">R$</span>
                            {{ number_format($produto->PRODUTO_PRECO - $produto->PRODUTO_DESCONTO, 2, ',', '.') }}
                        </span>
                    @else
                        <span class="preco-final">
                            <span class="simbolo">R$</span>
                            {{ number_format($produto->PRODUTO_PRECO, 2, ',', '.') }}
                        </span>
                    @endif
                </div>

                <!-- Controle de quantidade -->
                <div class="settings-container">
                    <button class="buttons-settings">-</button>
                    <span class="countItens">1</span>
                    <button class="buttons-settings">+</button>
                </div>
            </div>

            <!-- Botão para adicionar ao carrinho -->
            <button class="add-to-cart-btn" type="button" data-produto-id="{{ $produto->PRODUTO_ID }}">
                <span class="cart-button-text">Adicionar ao carrinho</span>
                <span class="cart-button-icon" style="display: none;">
                    <box-icon name='block' color='#d94a4a'></box-icon>
                </span>
            </button>
        </div>
    @elseif ($isTodosProdutos)
        <!-- Conteúdo específico para o contexto 'todos_produtos' -->
        <!-- Nome do produto com Redirecionamento -->
        <p class="produto-nome" data-url="/produto/{{ $produto->PRODUTO_ID }}">{{ $produto->PRODUTO_NOME }}</p>

        <div class="specific-structure">
            <!-- Preço do produto com Redirecionamento -->
            <div class="preco-container" data-url="/produto/{{ $produto->PRODUTO_ID }}">
                @if($produto->PRODUTO_DESCONTO > 0)
                    <span class="preco-original">
                        <span class="simbolo">R$</span>
                        {{ number_format($produto->PRODUTO_PRECO, 2, ',', '.') }}
                    </span>
                    <span class="preco-com-desconto">
                        <span class="simbolo">R$</span>
                        {{ number_format($produto->PRODUTO_PRECO - $produto->PRODUTO_DESCONTO, 2, ',', '.') }}
                    </span>
                @else
                    <span class="preco-final">
                        <span class="simbolo">R$</span>
                        {{ number_format($produto->PRODUTO_PRECO, 2, ',', '.') }}
                    </span>
                @endif
            </div>

            <!-- Controle de quantidade -->
            <div class="settings-container">
                <button class="buttons-settings">-</button>
                <span class="countItens">1</span>
                <button class="buttons-settings">+</button>
            </div>
        </div>

        <!-- Botão para adicionar ao carrinho -->
        <button class="add-to-cart-btn" type="button" data-produto-id="{{ $produto->PRODUTO_ID }}">
            <span class="cart-button-text">Adicionar ao carrinho</span>
            <span class="cart-button-icon" style="display: none;">
                <box-icon name='block' color='#d94a4a'></box-icon>
            </span>
        </button>
    @else
        <!-- Conteúdo para outros contextos -->
        <!-- Nome do produto com Redirecionamento -->
        <p class="produto-nome" data-url="/produto/{{ $produto->PRODUTO_ID }}">{{ $produto->PRODUTO_NOME }}</p>

        <!-- Preço do produto com Redirecionamento (sem o wrapper específico) -->
        <div class="preco-container" data-url="/produto/{{ $produto->PRODUTO_ID }}">
            @if($produto->PRODUTO_DESCONTO > 0)
                <span class="preco-original">
                    <span class="simbolo">R$</span>
                    {{ number_format($produto->PRODUTO_PRECO, 2, ',', '.') }}
                </span>
                <span class="preco-com-desconto">
                    <span class="simbolo">R$</span>
                    {{ number_format($produto->PRODUTO_PRECO - $produto->PRODUTO_DESCONTO, 2, ',', '.') }}
                </span>
            @else
                <span class="preco-final">
                    <span class="simbolo">R$</span>
                    {{ number_format($produto->PRODUTO_PRECO, 2, ',', '.') }}
                </span>
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
                <box-icon name='block' color='#d94a4a'></box-icon>
            </span>
        </button>
    @endif
</div>
