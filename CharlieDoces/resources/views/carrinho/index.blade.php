<!-- resources/views/carrinho/index.blade.php -->
@extends('layouts.app')

@section('title', 'Carrinho')

@section('content')
    <!-- Botão Histórico de Compras -->
    <div class="botao-historico-container mb-4">
        <button class="btn btn-secondary botao-historico" onclick="window.location.href='/historico_pedidos'">
            Histórico de compras
        </button>
    </div>

    <div class="carrinho-container">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    {{-- <th scope="col">Id Produto</th> --}}
                    <th scope="col">Produto</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Total</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr data-item-id="{{ $item->id }}">
                        {{-- <td>{{ $item->Produto->PRODUTO_ID }}</td> --}}
                        <td>{{ $item->Produto->PRODUTO_NOME }}</td>
                        <td>{{ 'R$ ' . number_format($item->Produto->PRODUTO_PRECO, 2, ',', '.') }}</td>
                        <td class="campo-quantidade">
                            <div class="d-flex align-items-center">
                                <form
                                    action="{{ route('carrinho.delQuantidadeItens', ['produto' => $item->Produto->PRODUTO_ID]) }}"
                                    method="POST" class="mr-2">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">-</button>
                                </form>
                                <span class="mx-2 item-quantity">{{ $item->ITEM_QTD }}</span>
                                <form
                                    action="{{ route('carrinho.addQuantidadeItens', ['produto' => $item->Produto->PRODUTO_ID]) }}"
                                    method="POST" class="ml-2">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">+</button>
                                </form>
                            </div>
                        </td>
                        <td class="item-total">{{ 'R$ ' . number_format($item->Produto->PRODUTO_PRECO * $item->ITEM_QTD, 2, ',', '.') }}</td>
                        <td>
                            <form
                                action="{{ route('carrinho.deleteCarrinho', ['produto' => $item->Produto->PRODUTO_ID]) }}"
                                method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('styles')
    @vite(['resources/css/carrinho.css'])
@endpush

@push('scripts')
    @vite(['resources/js/carrinho.js'])
@endpush
