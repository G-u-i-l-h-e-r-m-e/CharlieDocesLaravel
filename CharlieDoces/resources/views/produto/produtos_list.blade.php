<!-- resources/views/produto/produtos_list.blade.php -->

@foreach ($produtos as $produto)
    @include('componentes-produtos.component-card', [
        'produto' => $produto,
        'contexto' => $contexto ?? null // Encaminha o contexto recebido
    ])
@endforeach
