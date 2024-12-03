<!-- resources/views/componentes-produtos/carousel-natal.blade.php -->

<div class="carousel-natal-container" data-total-produtos="{{ $produtosNatal->total() }}">

    <div class="carousel-natal-wrapper">
        @if ($produtosNatal->total() > 3)
            <button class="carouselNatal-button left">&#10094;</button>
        @endif

        <div class="carousel-natal-track">
            @php
                $produtosAgrupados = $produtosNatal->chunk(3);
            @endphp

            @foreach ($produtosAgrupados as $index => $grupo)
                <div class="carousel-natal-slide" style="display: {{ $index === 0 ? 'flex' : 'none' }};">
                    @foreach ($grupo as $produto)
                        @include('componentes-produtos.component-card', ['produto' => $produto])
                    @endforeach
                </div>
            @endforeach
        </div>

        @if ($produtosNatal->total() > 3)
            <button class="carouselNatal-button right">&#10095;</button>
        @endif
    </div>
</div>
