<!-- resources/views/componentes-produtos/carousel-relacionados.blade.php -->

<div class="carousel-relacionados-container" data-total-produtos="{{ $produtosRelacionados->count() }}">
    <div class="carousel-relacionados-wrapper">
        @if ($produtosRelacionados->count() > 3)
            <button class="carouselRelacionados-button left">&#10094;</button>
        @endif

        <div class="carousel-relacionados-track">
            @php
                $produtosAgrupados = $produtosRelacionados->chunk(3);
            @endphp

            @foreach ($produtosAgrupados as $index => $grupo)
                <div class="carousel-relacionados-slide" style="display: {{ $index === 0 ? 'flex' : 'none' }};">
                    @foreach ($grupo as $produto)
                        @include('componentes-produtos.component-card', [
                            'produto' => $produto,
                            'contexto' => 'todos_produtos' // ou outro contexto apropriado
                        ])
                    @endforeach
                </div>
            @endforeach
        </div>

        @if ($produtosRelacionados->count() > 3)
            <button class="carouselRelacionados-button right">&#10095;</button>
        @endif
    </div>
</div>
