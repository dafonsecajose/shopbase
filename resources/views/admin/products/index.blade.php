@extends('layouts.app')

@section('content')

    <h2>Lista de Produtos</h2>
    <a href="{{route('admin.products.create')}}" class="btn btn-lg btn-success">Criar Produto</a>
    <hr>

    @if($products->count())
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>R$ {{number_format($product->price, 2, ',', '.')}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('admin.products.edit', ['product' => $product->id])}}">
                                <button type="submit" class="btn btn-sm btn-primary m-1">EDITAR</button>
                            </a>
                            <form action="{{route('admin.products.destroy', ['product' => $product->id])}}"
                                  method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger m-1">REMOVER</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            @else
            <h3 class="alert alert-warning">Você não possui nenhum produto cadastrado!</h3>
            @endif
            </tbody>
        </table>


        {{$products->links()}}

@endsection
