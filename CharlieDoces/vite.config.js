// vite.config.js

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

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
        'resources/css/profile.css',              
        'resources/css/historicoPedidos.css',    
        'resources/css/login/cadastro.css',       
        'resources/css/login/forgotPassword.css',  
        'resources/css/login/login.css',          
        'resources/css/login/password.css',        
        'resources/css/carrinho.css',              
        'resources/css/pagination.css',              
        //'resources/css/bootstrap.css',          
        'resources/css/card-produto-todos-produtos.css',   
        'resources/css/produtoShow.css',
        // JS files
        'resources/js/app.js',
        'resources/js/componentes-produtos/carousel-natal.js',
        'resources/js/componentes-produtos/carousel-chocolate.js',
        'resources/js/componentes-produtos/component-card.js',
        'resources/js/banner.js',
        'resources/js/carrousel-categoria.js',
        'resources/js/categoria.js',
        'resources/js/header.js',
        'resources/js/login.js',                   
        'resources/js/produto.js',
        'resources/js/todos_produtos.js',
        'resources/js/componentes-produtos/carrinho.js', 
        // 'resources/js/AJAX/carrinho.js',           
        'resources/js/bootstrap.js',              
      ],
      refresh: true,
    }),
    
  ],
});