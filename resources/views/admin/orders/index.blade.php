@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Pedidos Recebidos</h2>
            <hr>
        </div>
    </div>
    <div class="col-12">
        <div class="accordion" id="accordionExample">
            @forelse($orders as $key => $order)
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                Pedido n : {{$order->reference}}
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne{{$key}}" class="collapse @if($key == 0) show @endif" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>

                                @foreach($order->itens as $item)

                                    <li>
                                        {{$item->product['name']}} | R$ {{number_format($item['price'] * $item['amount'], 2, ',', '.')}}
                                        <br>
                                        Quantidade pedida: {{$item['amount']}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning">Nenhum pedido recebido!</div>
            @endforelse
        </div>

        @if($orders->count() > 10)
        <div class="col-12">
            <hr>
            {{$orders->links()}}
        </div>
        @endif
    </div>

@endsection

