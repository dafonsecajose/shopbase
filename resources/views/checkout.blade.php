@extends('layouts.front')

@section('stylesheet')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('content')

    <div class="container">
        <div class="row">
        <div class="col-6">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="creditCard-tab" data-toggle="tab" href="#creditCard" role="tab" aria-controls="creditCard" aria-selected="true">Cartão de Crédito</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="boleto-tab" data-toggle="tab" href="#boleto" role="tab" aria-controls="boleto" aria-selected="false">Boleto</a>
                </li>
            </ul>
            <div class="tab-content pt-5" id="myTabContent">
                <div class="tab-pane fade show active" id="creditCard" role="tabpanel" aria-labelledby="creditCard-tab">
                    <!-- Cartão de Crédito Conteúdo Tab-->
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 msg">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2>Dados para Pagamento</h2>
                                        <hr>
                                    </div>
                                </div>
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label>Nome no Cartão</label>
                                            <input type="text" class="form-control" name="card_name">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label>Número do Cartão <span class="brand"></span></label>
                                            <input type="text" class="form-control" name="card_number">
                                            <input type="hidden" name="card_brand">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label>Mês de Expiração</label>
                                            <input type="text" class="form-control" name="card_month">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label>Ano de Expiração</label>
                                            <input type="text" class="form-control" name="card_year">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label>Cód. de Segurança</label>
                                            <input type="text" class="form-control" name="card_cvv">
                                        </div>
                                        <div class="col-md-12 installments form-group"></div>
                                    </div>
                                        <button class="btn btn-success btn-lg proccessCheckout" data-payment-type="CREDITCARD" >Efetuar Pagamento</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="boleto" role="tabpanel" aria-labelledby="boleto-tab">
                    <div class="row">
                        <div class="col-12">
                            <h2>Pagar com Boleto</h2>
                            <button class="btn btn-success btn-lg proccessCheckout" data-payment-type="BOLETO">Emitir Boleto</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="row">
                                <div class="col-12">
                                    <h3>Endereço de Entrega</h3>
                                    <hr>
                                </div>
                            </div>
                            <div class="alert alert-dark">
                                <div class="row col-12">
                                    <p>
                                        <strong>Rua:</strong> {{$address->street}}, {{$address->house_code}}<br>
                                        <strong>Bairro:</strong> {{$address->neighborhood}} <strong>CEP:</strong> {{formatCEPToHuman($address->zip_code)}}<br>
                                        <strong>Cidade:</strong> {{$address->city}}   <strong>Estado:</strong> {{$address->state}}
                                    </p>
                                        <button type="btn" class="form-control btn btn-danger">Alterar</button>
                                </div>
                            </div>
                            <div class="col-12">
                                <h3>Frete</h3>
                                <hr>
                                <div class="row">
                                    <div class="response">
                                        @foreach($optionsShipping as $service)
                                            <div class="form-check">
                                                <input type="radio" name="ship" id="{{$service['service']}}" value="{{$service['service']}}|{{$service['price']}}|{{$service['deadline']}}" class="form-check-input" @if($service['service'] == '04510') checked @endif >
                                                <label for="{{$service['service']}}" class="form-check-label">{{$service['name']}}. Valor: {{$service['price']}} Prazo: {{$service['deadline']}} dia(s)</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h3>Detalhes da Compra</h3>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Subtotal:</th>
                                                    <td>{{formatNumberToHuman($cardItens)}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Frete:</th>
                                                    <td class="showShipping"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Total:</th>
                                                    <td class="total"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    </div>
@endsection

@section('scripts')
    <script
        src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>


    <script>
        const sessionId = '{{session()->get('pagseguro_session_code')}}';
        const urlThanks = '{{route('checkout.thanks')}}';
        const urlProccess = '{{route("checkout.proccess")}}';
        const csrf = '{{csrf_token()}}';
        const amountTransaction = '{{$cardItens}}';
        const shippingRoute = '{{route('shipping')}}';
        let total =0;
        let brand;

        PagSeguroDirectPayment.setSessionId(sessionId);

        let ship = $('input:radio[name=ship]:checked').val();
        calculateTotal();
        $('input:radio[name=ship]').change(function (){
            ship = $('input:radio[name=ship]:checked').val();
            calculateTotal();
            if(cardNumber.value.length >= 6){
                getInstallments(total, brand);
            }

        });




        function calculateTotal(){
            let shipTest = ship.split('|');
            let shipFloat = shipTest[1].replace(',','.');
            $('.showShipping').text(shipTest[1]) ;
            total = (parseFloat(amountTransaction)+ parseFloat(shipFloat));
            $('.total').text(total.toFixed(2).replace('.', ','));
            total = total.toFixed(2);
        }


    </script>

    <script src="{{asset('js/pagseguro_functions.js')}}"></script>
    <script src="{{asset('js/pagseguro_events.js')}}"></script>
@endsection


