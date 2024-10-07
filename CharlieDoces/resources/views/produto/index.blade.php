<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
</head>
<body>

    @foreach($produtos as $produto)
        <li>{{$produto->PRODUTO_NOME}} - ({{$produto->Categoria->CATEGORIA_NOME}}) - {{$produto->PRODUTO_PRECO}}</li>
        <li>Desconto: {{$produto->PRODUTO_DESCONTO}}</li>
        <li>Valor final: {{$produto->PRODUTO_PRECO - $produto->PRODUTO_DESCONTO}}</li>
    @endforeach

</body>
</html>


