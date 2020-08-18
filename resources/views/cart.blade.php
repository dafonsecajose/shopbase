@extends('layouts.front')

@section('content')


    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-7">
            <div class="col-12">
                <h2>Carrinho de compras</h2>
                <hr>
            </div>
            <div class="col-12">
                @if($cart)
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Subtotal</th>
                            <th>Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $total = 0; @endphp
                        @foreach($cart as $cartItem)
                            <tr @if(isset($cartItem['erro'])) class="bg-warning" @endif>
                                <td>{{$cartItem['name']}}</td>
                                <td>R$ {{number_format($cartItem['price'], 2, ',', '.')}}</td>
                                <td>{{$cartItem['amount']}}

                                @php
                                    $subtotal = $cartItem['price'] * $cartItem['amount'];
                                    $total += $subtotal;
                                @endphp
                                <td>R$ {{number_format($subtotal, 2, ',', '.')}}</td>
                                <td>
                                    <a href="{{route('cart.remove', ['slug' => $cartItem['slug']])}}"
                                       class="btn btn-sm btn-danger">REMOVER</a>
                                </td>
                            </tr>
                            @if(isset($cartItem['erro']))
                                <tr class="bg-warning">
                                    <td colspan="5">{{$cartItem['erro']}}</td>
                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td colspan="3">Total</td>
                            <td colspan="2">R$ {{number_format($total, 2, ',', '.')}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <hr>
                    <div class="col-md-12">
                        <a href="{{route('checkout.index')}}" class="btn btn-lg btn-success float-right">Concluir
                            Compra</a>
                        <a href="{{route('cart.cancel')}}" class="btn btn-lg btn-danger float-left">Cancelar</a>
                    </div>
                @else
                    <div class="alert alert-warning">Carrinho vazio...</div>
                @endif
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-5">
            @if(session()->get('shipping'))
            <div class="col-12">
                <h2>Simule o Frete</h2>
                <hr>
            </div>
            <div class="col-12">

                <form action="" method="post">
                    <div class="form-group form-inline ">
                        <form id="shipping" action="" method="post">
                            @csrf
                            <div class="form-inline">
                                <label for="zip_code">CEP:</label>
                                <input type="text" class="form-control form-control-lg m-2" name="sCepDestino"
                                       id="zip_code">
                                <input name="nVlPeso" type="hidden" value="{{$shippingConfig['weight']}}">
                                <input name="nVlComprimento" type="hidden" value="{{$shippingConfig['depth']}}">
                                <input name="nVlAltura" type="hidden" value="{{$shippingConfig['height']}}">
                                <input name="nVlLargura" type="hidden" value="{{$shippingConfig['width']}}">
                                <button type="button" class="btn btn-success btn-lg" id="calcular">Simular</button>
                            </div>
                            <div class="response col-12">
                            </div>
                    </div>
                </form>
               @endif

            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script>
        let route = '{{route('shipping')}}';
        let csrf = '{{csrf_token()}}';
    </script>
    <script src="{{asset('js/shipping.js')}}"></script>
@endsection
