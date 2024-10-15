<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <main>
        <section>
            @include('profile.partials.header')
        </section>

        <section>
            @include('profile.partials.carrousel-categoria')
        </section>

        <section>
            @include('produto.index', ['produtos' => $produtos])
        </section>

        <section>
            @include('profile.partials.banner')
        </section>
        
        <section>
            @include('profile.partials.footer')
        </section>
    </main>
</body>
</html>
