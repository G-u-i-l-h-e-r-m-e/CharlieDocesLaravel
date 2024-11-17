<!-- resources/views/componentes-produtos/carousel-mais-vendidos.blade.php -->

<div class="carousel-mais-vendidos">
    <div class="tituloHome">
        <h2 class="tituloMaisVendidos">Top Vendas</h2>
        <h2 class="subtituloMaisVendidos">Conheça o pódio de
            preferidos e experimente as escolhas que fazem sucesso.</h2>
    </div>

    <div class="carousel-track">
        @foreach ($produtosMaisVendidos as $produto)
            @include('componentes-produtos.component-card', ['produto' => $produto])
        @endforeach
    </div>

    <div class="podium-container">
        <div class="container-positions">
            <div class="segundo-lugar">
                <span>#2</span>
            </div>
            <div class="primeiro-lugar">
                <span>#1</span>
            </div>
            <div class="terceiro-lugar">
                <span>#3</span>
            </div>
        </div>
        <div class="base"></div>
    </div>
</div>