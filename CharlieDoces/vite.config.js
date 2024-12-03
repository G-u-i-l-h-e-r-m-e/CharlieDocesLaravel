// vite.config.js

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'; // Se estiver usando Vue.js

export default defineConfig({
  plugins: [
    laravel({
      input: [
        // CSS files
        'resources/css/app.css',
        'resources/css/home-style.css',
        'resources/css/banner.css',
        'resources/css/componentes-style/carousel-natal.css',
        'resources/css/componentes-style/carousel-chocolate.css',
        'resources/css/componentes-style/carousel-mais-vendidos.css',
        'resources/css/componentes-style/component-card.css',
        'resources/css/componentes-style/content-title.css',
        'resources/css/header.css',
        'resources/css/footer.css',
        'resources/css/todos_produtos.css',
        'resources/css/profile.css',               // Novo CSS para o perfil
        'resources/css/historicoPedidos.css',      // Novo CSS para histórico de pedidos
        'resources/css/login/cadastro.css',        // Novo CSS para cadastro
        'resources/css/login/forgotPassword.css',  // Novo CSS para forgot password
        'resources/css/login/login.css',           // Novo CSS para login
        'resources/css/login/password.css',        // Novo CSS para password
        'resources/css/carrinho.css',              // Novo CSS para carrinho
        'resources/css/bootstrap.css',             // Importando Bootstrap CSS via Vite
        // JS files
        'resources/js/app.js',
        'resources/js/componentes-produtos/carousel-natal.js',
        'resources/js/componentes-produtos/carousel-chocolate.js',
        'resources/js/componentes-produtos/component-card.js',
        'resources/js/banner.js',
        'resources/js/carrousel-categoria.js',
        'resources/js/categoria.js',
        'resources/js/header.js',
        'resources/js/login.js',                    // Novo JS para login
        'resources/js/produto.js',
        'resources/js/todos_produtos.js',
        'resources/js/componentes-produtos/carrinho.js', // Novo JS para carrinho
        'resources/js/AJAX/carrinho.js',           // JS AJAX para carrinho
        'resources/js/bootstrap.js',               // Importando Bootstrap JS via Vite
      ],
      refresh: true,
    }),
    
  ],
});
