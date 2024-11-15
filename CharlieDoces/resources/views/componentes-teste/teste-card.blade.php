<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste do Card</title>
    <link rel="stylesheet" href="/css/produto.css"> <!-- Link para o CSS do componente -->
    <style>
        body {
            background-color: #EAEAEA;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>

    <!-- Exibe o card usando o produto passado pela TesteController -->
    @include('componentes-produtos.component-card', ['produto' => $produto])

</body>

</html> 