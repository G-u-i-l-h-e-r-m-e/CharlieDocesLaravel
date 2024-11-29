
<main class="produtos-container" id="produtos-lista">
        @foreach($produtos as $produto)
        <section class="card-produto">
            <div class="carousel">
                <div class="carousel-images">
                    @if($produto->produto_imagens && $produto->produto_imagens->isNotEmpty())
                    @foreach($produto->produto_imagens as $imagem)
                    <img class="imagem-produto" src="{{ $imagem->IMAGEM_URL }}" alt="Imagem do Produto">
                    @endforeach
                    @else
                    <p class="imagem-produto">Nenhuma imagem disponível.</p>
                    @endif
                </div>
            </div>
            <p class="categoria-produto">{{ $produto->categoria->CATEGORIA_NOME }}</p>
            <a class="nome-produto" href="/produto/{{ $produto->PRODUTO_ID }}">{{ $produto->PRODUTO_NOME }}</a>
            <div class="orientacao-preco">
                <span class="preco-produto">
                    <span class="preco-final">R${{ $produto->PRODUTO_PRECO - $produto->PRODUTO_DESCONTO }}</span>
                </span>
            </div>
            <div class="qtd-itens">
                <button class="btn-qtd-itens btn-menos">-</button>
                <span class="count-itens">0</span>
                <button class="btn-qtd-itens btn-mais">+</button>
            </div>
            <button class="btn-add-carrinho">
                <a href="/carrinho/{{ $produto->PRODUTO_ID }}">Adicionar ao carrinho</a>
            </button>
        </section>
        @endforeach
    </main>