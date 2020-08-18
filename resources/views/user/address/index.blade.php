@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Endereços Cadastrados</h2>
            <hr>
        </div>
    </div>
    <div class="col-12">
        <div class="accordion" id="accordionExample">
            @forelse($addresses as $key => $address)
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <div class="row">
                            <h2 class="mb-0 col-md-10">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#collapseOne{{$key}}" aria-expanded="true"
                                        aria-controls="collapseOne">
                                    Rua: {{$address->street}} Tipo: @if($address->address_type == 'ADDRESS_DELIVERY')
                                        Entrega @else Fatura @endif
                                </button>
                            </h2>
                            <div class=" col-md-2">
                                <div class="row">
                                    <a href="{{route('user.address.edit', ['address' =>$address->id])}}">
                                        <button type="submit" class="btn btn-primary mr-1">Editar</button>
                                    </a>
                                    <form action="{{route('user.address.destroy', ['address' => $address->id])}}"
                                          method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Remover</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="collapseOne{{$key}}" class="collapse @if($key == 0) show @endif"
                         aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <p><strong>Rua:</strong> {{$address->street}}
                                <strong>Numero:</strong> {{$address->house_code}}</p>
                            <p><strong>Bairro:</strong> {{$address->neighborhood}}
                                <strong>Cidade:</strong> {{$address->city}}</p>
                            <p><strong>Estado:</strong> {{$address->state}} <strong>CEP:</strong> {{$address->zip_code}}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning">Nenhum endereço cadastrado!</div>
            @endforelse
        </div>

        @if($addresses->count() > 10)
            <div class="col-12">
                <hr>
                {{$addresses->links()}}
            </div>
        @endif
    </div>

@endsection
