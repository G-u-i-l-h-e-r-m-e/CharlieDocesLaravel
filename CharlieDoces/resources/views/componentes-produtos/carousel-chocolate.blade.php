<div class="carousel-chocolate-container">

    <div class="carousel-chocolate-wrapper">

        <div class="desconto">
            <div class="desconto-content">
                <div>
                    <p>Desconto de</p>
                </div>
                <div class="badge">
                    <i class='bx bxs-badge' style="color: #fedb37;"></i>
                    <span>5%</span>
                </div>
            </div>

            <div class="desconto-content">
                <div>
                    <p>Desconto de</p>
                </div>
                <div class="badge">
                    <i class='bx bxs-badge'></i>
                    <span>10%</span>
                </div>

            </div>

            <div class="desconto-content">
                <div>
                    <p>Desconto de</p>
                </div>
                <div class="badge">
                    <i class='bx bxs-badge' style="color: #fedb37;"></i>
                    <span>15%</span>
                </div>
            </div>
        </div>


        <div class="carousel-chocolate-track">
            @if(isset($produtosChocolate) && $produtosChocolate->isNotEmpty())
                @foreach ($produtosChocolate as $produto)
                    @include('componentes-produtos.component-card', ['produto' => $produto])
                @endforeach
            @else
                <p>Nenhum produto disponível no momento.</p>
            @endif
        </div>
    </div>

</div>