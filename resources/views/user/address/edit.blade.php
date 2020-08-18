@extends('layouts.front')

@section('content')
    <h2>Cadastrar Endereço</h2>
    <hr>
    <form action="{{route('user.address.update',['address' => $address->id])}}"  method="post">
        @csrf
        @method('PUT')
        <div class="form-group form-inline">
            <label for="zip_code">CEP:</label>
            <input type="text" class="form-control form-contro-lg ml-2 mr-2 @error('zip_code') is-invalid @enderror"
                   name="zip_code"
                   id="zip_code" value="{{$address->zip_code}}">
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
                   id="street" value="{{$address->street}}">
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
                   id="neighborhood" value="{{$address->neighborhood}}">
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
                       id="house_code" value="{{$address->house_code}}">
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
                       id="city" value="{{$address->city}}">
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
                       id="state" value="{{$address->state}}">
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
                <option value="ADDRESS_DELIVERY" @if($address->address_type == 'ADDRESS_DELIVERY') selected @endif>Entrega</option>
                <option value="ADDRESS_INVOICE" @if($address->address_type == 'ADDRESS_INVOICE') selected @endif>Fatura</option>
            </select>
            @error('address_type')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group text-center">
            <button class="btn btn-lg btn-success">Editar</button>
        </div>
    </form>

@endsection

