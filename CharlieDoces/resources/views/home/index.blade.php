<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/css/home.css">
</head>
<body>
    <main class="background">
        <section>
            @include('profile.partials.header',['categorias' => \App\Models\Categoria::all()]);
        </section>
        
        <section>
            @include('profile.partials.banner');
        </section>
        
        <section>
            @include('profile.partials.carrousel-categoria');
        </section>

        <section>
            @include('produto.index', ['produtos' => $produtos]);
        </section>

       
        <section>
            @include('profile.partials.footer');
        </section>
    </main>
</body>
</html>
