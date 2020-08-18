@extends('layouts.front')

@section('content')
    <h2>Cadastrar Endereço</h2>
    <hr>
    <form action="{{route('user.address.store')}}" method="post">
        @csrf
        <div class="form-group form-inline">
            <label for="zip_code">CEP:</label>
            <input type="text" class="form-control form-contro-lg ml-2 mr-2 @error('zip_code') is-invalid @enderror"
                   name="zip_code"
                   id="zip_code" value="{{old('zip_code')}}">
            @error('zip_code')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
            <button class="btn btn-success" type="button" id="btnCep">Buscar</button>
        </div>
        <div class="form-group">
            <label for="street">Nome da rua:</label>
            <input type="text" class="form-control form-contro-lg @error('street') is-invalid @enderror" name="street"
                   id="street" value="{{old('street')}}">
            @error('street')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="neighborhood">Bairro:</label>
            <input type="text" class="form-control form-contro-lg @error('neighborhood') is-invalid @enderror"
                   name="neighborhood"
                   id="neighborhood" value="{{old('neighborhood')}}">
            @error('neighborhood')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <label for="house_code">Numero:</label>
                <input type="text" class="form-control form-contro-lg @error('house_code') is-invalid @enderror"
                       name="house_code"
                       id="house_code" value="{{old('house_code')}}">
                @error('house_code')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-5">
                <label for="city">Cidade:</label>
                <input type="text" class="form-control form-contro-lg @error('city') is-invalid @enderror"
                       name="city"
                       id="city" value="{{old('city')}}">
                @error('city')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="state">Estado:</label>
                <input type="text" class="form-control form-contro-lg @error('state') is-invalid @enderror"
                       name="state"
                       id="state" value="{{old('state')}}">
                @error('state')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="address_type">Tipo:</label>
            <select name="address_type" id="address_type" class="form-control form-control-lg">
                <option value="ADDRESS_DELIVERY">Entrega</option>
                <option value="ADDRESS_INVOICE">Fatura</option>
            </select>
            @error('address_type')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group text-center">
            <button class="btn btn-lg btn-success">Cadastrar</button>
        </div>
    </form>

@endsection

@section('scripts')
    <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>

    <script>
        $('#btnCep').on("click", function () {
            let cep = $('#zip_code').val().replace(/([^\d])+/gim, '');

            let url = 'https://viacep.com.br/ws/' + cep + '/json';
            $.ajax({
                url: url,
                type: "get",
                dataType: "json",

                success:function (data){
                    $('#street').val(data.logradouro);
                    $('#neighborhood').val(data.bairro);
                    $('#city').val(data.localidade);
                    $('#state').val(data.uf);
                }
            })
        });
    </script>
@endsection
