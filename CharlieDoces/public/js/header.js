// Espera até que o DOM esteja completamente carregado
document.addEventListener('DOMContentLoaded', function () {

    // Função para alternar o menu
    const menuToggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');
    
    if (menuToggle && menu) {
        menuToggle.addEventListener('click', function () {
            menu.classList.toggle('active');  // Alterna a classe 'active' para abrir/fechar o menu
        });
    }

    // Função para alternar entre modo claro e escuro (Dark Mode)
    const themeToggle = document.getElementById('theme-toggle');
    
    if (themeToggle) {
        themeToggle.addEventListener('click', function () {
            document.body.classList.toggle('dark-mode');  // Alterna a classe 'dark-mode' no body
        });
    }

    // Função para esconder o cabeçalho ao rolar para baixo e mostrar ao rolar para cima
    let lastScrollTop = 0;
    const header = document.getElementById('header');

    if (header) {
        window.addEventListener('scroll', function () {
            let currentScroll = window.pageYOffset;

            if (currentScroll > lastScrollTop) {
                header.style.top = "-100px";  // Esconde o cabeçalho
            } else {
                header.style.top = "0";  // Mostra o cabeçalho
            }

            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;  // Impede valores negativos
        });
    }

    // Validação do formulário de pesquisa no cabeçalho
    const searchForm = document.getElementById('search-form');
    
    if (searchForm) {
        searchForm.addEventListener('submit', function (event) {
            const searchInput = document.getElementById('search-input').value;
            
            if (searchInput.trim() === '') {
                event.preventDefault();  // Impede o envio do formulário se o campo estiver vazio
                alert('Por favor, insira um termo de pesquisa!');
            }
        });
    }

    // Carregar notificações via AJAX
    const notificationIcon = document.getElementById('notification-icon');
    const notificationList = document.getElementById('notification-list');
    
    if (notificationIcon) {
        notificationIcon.addEventListener('click', function () {
            fetch('/notifications')
                .then(response => response.json())
                .then(data => {
                    if (notificationList) {
                        notificationList.innerHTML = '';  // Limpa a lista de notificações
                        data.notifications.forEach(notification => {
                            const li = document.createElement('li');
                            li.textContent = notification.message;
                            notificationList.appendChild(li);
                        });
                    }
                })
                .catch(error => {
                    console.error('Erro ao carregar as notificações:', error);
                });
        });
    }

    // Exemplo de carregamento condicional de scripts para tela móvel
    if (window.innerWidth < 768) {
        const script = document.createElement('script');
        script.src = '/js/mobile-menu.js';
        document.body.appendChild(script);  // Adiciona um script para dispositivos móveis
    }

});
