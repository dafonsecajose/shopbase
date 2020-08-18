@extends('layouts.front')

@section('content')

    <div class="front row">
        @foreach($products as $key => $product)
            <div class="col-md-4">
                <div class="card" style="width: 98%;">
                    @if($product->photos->count())
                        <img src="{{asset('storage/'. $product->thumb )}}" alt="" class="card-img-top">
                    @else
                        <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top">
                    @endif
                    <div class="card-body">
                        <h2 class="card-title">{{$product->name}}</h2>
                        <p class="card-text">
                            {{$product->resume}}
                        </p>
                        <h3>R$ {{number_format($product->price, 2, ',','.')}}</h3>
                        <a href="{{route('product.single', ['slug' => $product->slug])}}" class="btn btn-success">
                            Ver Produto
                        </a>
                    </div>
                </div>
            </div>
            @if(($key + 1) % 3 == 0) </div>
    <div class="front row"> @endif
        @endforeach
    </div>

        {{$products->links()}}

@endsection
