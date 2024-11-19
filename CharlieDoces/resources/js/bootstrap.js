// resources/js/bootstrap.js

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

console.log('Token CSRF encontrado:', token ? token.content : 'Nenhum token encontrado');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token não encontrado: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
