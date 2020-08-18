@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-6">
            @if($product->photos->count())
                <img src="{{asset('storage/' . $product->first()->photos)}}" alt="" class="card-img-top thumb">
                <div class="row" style="margin-top: 20px">
                    @foreach($product->photos as $photo)
                        <div class="col-4">
                            <img src="{{asset('storage/' .$photo->image)}}" alt="" class="img-fluid img-small">
                        </div>
                    @endforeach
                </div>
            @else
                <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top thumb">
            @endif
        </div>
        <div class="col-6">
            <div class="col-md-12">
                <h2>{{$product->name}}</h2>
                <p>
                    {{$product->description}}
                </p>
                <h3>
                    R$ {{number_format($product->price, 2, ',','.')}}
                </h3>
                <p>Quantidade: {{$product->amount}}</p>
            </div>

            <div class="product-add col-md-12">
                <hr>
                @if($product->amount > 0)
                    <form action="{{route('cart.add')}}" method="post">
                        @csrf
                        <input type="hidden" name="product[name]" value="{{$product->name}}">
                        <input type="hidden" name="product[price]" value="{{$product->price}}">
                        <input type="hidden" name="product[slug]" value="{{$product->slug}}">
                        <div class="form-group">
                            <label for="amount">Quantidade</label>
                            <div class="row">
                                <button type="button" class="btn btn-primary col-md-1" id="remove"
                                        onclick="calculator(-1)">-
                                </button>
                                <input type="hidden" id="quantity" name="product[amount]" class="form-control col-md-2">
                                <div id="amount" class="col-md-2 mt-2">1</div>
                                <button type="button" class="btn btn-primary col-md-1" id="addi"
                                        onclick="calculator(+1)">+
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-danger">Comprar</button>

                    </form>
                @else
                    <h3>Produto indisponível.</h3>
                @endif
            </div>
            <div class="col-12">
                <hr>
                <h5>Simular o Frete</h5>
                <form action="" method="post">
                    <div class="form-group form-inline ">
                        <form id="shipping" action="" method="post">

                            <div class="form-inline">
                                <label for="zip_code">CEP:</label>
                                <input type="text" class="form-control form-control-lg m-2" name="sCepDestino"
                                       id="zip_code">
                                <input name="nVlPeso" type="hidden" value="{{$product->weight}}">
                                <input name="nVlComprimento" type="hidden" value="{{$product->depth}}">
                                <input name="nVlAltura" type="hidden" value="{{$product->height}}">
                                <input name="nVlLargura" type="hidden" value="{{$product->width}}">
                                <button type="button" class="btn btn-success btn-lg" id="calcular">Simular</button>
                            </div>
                        </form>
                        <div class="response col-12">
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <hr>

            {{$product->description}}
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        let amount = 1;
        let btnRemove = document.querySelector('button.remove');
        let btnAdd = document.querySelector('button.add');
        let route = '{{route('shipping')}}';
        let csrf = '{{csrf_token()}}';

        $('#quantity').val(amount);
        let total = {{$product->amount}};

        function calculator($valor) {
            amount += ($valor);
            if (amount > 1) {
                $('#remove').attr('disabled', false)
            } else {
                $('#remove').attr('disabled', true);
            }
            if (amount < total) {
                $('#addi').attr('disabled', false);

            } else {
                $('#addi').attr('disabled', true)
            }
            $('#amount').text(amount);
            $("#quantity").val(amount);

            console.log($('#quantity').val());
        }

        let thumb = document.querySelector('img.thumb');
        let imgSmall = document.querySelector('img.img-small');

        imgSmall.forEach(function (e) {
            e.addEventListener('click', function () {
                imgThumb.src = e.src;
            });
        });
    </script>
 <script src="{{asset('js/shipping.js')}}"></script>
@endsection

