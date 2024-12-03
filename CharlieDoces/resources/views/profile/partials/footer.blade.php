<!-- resources/views/profile/partials/footer.blade.php -->

<footer class="footer">
    <div class="footer-content">
        <img src="{{ Vite::asset('resources/img/footer/Charlie_logo.png') }}" alt="Logo Charlie Doces" class="logo1">
        <div class="footer-links">
            <a href="{{ url('/home') }}">Home</a>
            <a href="{{ url('/todos_produtos') }}">Página de Produtos</a>
            <a href="{{ Auth::check() ? url('/carrinho') : url('/login') }}">Carrinho</a>
            <a href="{{ Auth::check() ? url('/profile') : url('/login') }}">Perfil</a>
        </div>
    </div>
</footer>
