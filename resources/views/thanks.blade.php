@extends('layouts.front')

@section('content')

    <h2 class="alert alert-success">
        Muito Obrigado por sua compra!
    </h2>
    <h3>
        Seu pedido foi processado, código do pedido: {{request()->get('order')}}
    </h3>
    @if(request()->has('b'))
        <a href="{{ request()->get('b') }}" class="btn btn-lg btn-danger" target="_blank">IMPRIMIR BOLETO</a>
    @endif


@endsection
