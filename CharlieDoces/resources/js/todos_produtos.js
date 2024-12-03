// resources/js/todos_produtos.js

$(document).ready(function () {
    // Recuperar a URL da rota a partir da meta tag
    var filtrarUrl = $('meta[name="route-produtos-filtrar"]').attr('content');

    function carregarProdutos(page = 1, append = false) {
        var categoriaSelecionada = $('input[name="categoria"]:checked').data('categoria') || '';
        var ordenacao = $('#ordenar-produtos').val();

        // Envia a requisição AJAX para filtrar os produtos
        $.ajax({
            url: filtrarUrl, // Usando a variável definida a partir da meta tag
            method: 'GET',
            data: {
                categoria: categoriaSelecionada,
                ordenacao: ordenacao,
                page: page,
            },
            success: function (response) {
                if (append) {
                    // Anexa os novos produtos ao invés de substituir
                    $('#produtos-lista').append(response.produtos_html);
                } else {
                    // Substitui os produtos existentes
                    $('#produtos-lista').html(response.produtos_html);
                }

                // Atualiza os breadcrumbs
                $('.breadcrumb').replaceWith(response.breadcrumbs_html);

                // Atualiza o título da categoria
                $('#titulo-categoria').text(response.titulo_categoria);

                // Atualiza a paginação
                $('#paginacao').html(response.pagination_html);

                // Atualizar os links de paginação para usar AJAX
                $('#paginacao').find('a').on('click', function (e) {
                    e.preventDefault();
                    var url = $(this).attr('href');
                    var page = url.split('page=')[1];
                    carregarProdutos(page, true); // Carregar mais produtos
                });

                // Atualizar o botão "Ver Mais"
                if (response.current_page >= response.last_page) {
                    $('#ver-mais').hide();
                } else {
                    $('#ver-mais').show();
                }
            },
            error: function (xhr, status, error) {
                console.log("Erro na requisição AJAX:", error);
            }
        });
    }

    // Evento de alteração nos radio buttons de categorias
    $('.categoria-radio').on('change', function () {
        carregarProdutos();
    });

    // Evento de alteração no dropdown de ordenação
    $('#ordenar-produtos').on('change', function () {
        carregarProdutos();
    });

    // Inicializar a paginação com AJAX
    $('#paginacao').find('a').on('click', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var page = url.split('page=')[1];
        carregarProdutos(page, true);
    });

    // Evento para o botão "Ver Mais"
    $('#ver-mais').on('click', function () {
        var nextPage = parseInt($('#paginacao').data('current-page')) + 1;
        carregarProdutos(nextPage, true);
    });
});
