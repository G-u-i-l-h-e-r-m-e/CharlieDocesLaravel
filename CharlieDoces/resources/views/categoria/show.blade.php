<h1>{{$categoria->CATEGORIA_NOME}}</h1>
@foreach($categoria->Produtos as $produto)
<li>{{$produto->PRODUTO_NOME}}</li>
@endforeach