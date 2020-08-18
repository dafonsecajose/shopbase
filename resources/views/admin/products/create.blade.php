@extends('layouts.app')

@section('content')
    <h2>Cadastro Produto</h2>
    <hr>
    <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name"
                   id="name" value="{{old('name')}}">
            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="resume">Descrição Destaque:</label>
            <input type="text" class="form-control form-control-lg  @error('resume') is-invalid @enderror" name="resume"
                   id="resume" value="{{old('resume')}}">
            @error('resume')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-row">
            <div class="form-group  col-md-6">
                <label for="weight">Peso:</label>
                <input type="number" class="form-control form-control-lg @error('name') is-invalid @enderror"
                       name="weight" id="weight" step=".10" value="{{old('weight')}}">
                @error('weight')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group  col-md-6">
                <label for="price">Preço:</label>
                <input type="number" class="form-control form-control-lg @error('price') is-invalid @enderror"
                       name="price" id="price" step=".10" value="{{old('price')}}">
                @error('price')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="height">Altura:(cm)</label>
                <input type="number" class="form-control form-control-lg @error('height') is-invalid @enderror"
                       name="height" id="height" step=".10" value="{{old('height')}}">
                @error('height')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="width">Largura:(cm)</label>
                <input type="number" class="form-control form-control-lg @error('width') is-invalid @enderror"
                       name="width" id="width" step=".10" value="{{old('width')}}">
                @error('width')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="depth">Profundidade:(cm)</label>
                <input type="number" class="form-control form-control-lg @error('depth') is-invalid @enderror"
                       name="depth" id="depth" step=".10" value="{{old('depth')}}">
                @error('depth')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="amount">Quantidade:</label>
                <input type="number" class="form-control form-control-lg @error('depth') is-invalid @enderror"
                       name="amount" id="amount" value="{{old('amount')}}">
                @error('amount')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="categories">Categorias:</label>
            <select name="categories[]" class="form-control form-control-lg" multiple>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Descrição Detalhada</label>
            <textarea name="description"
                      id="description" cols="30"
                      rows="3"
                      class="form-control form-control-lg @error('name') is-invalid @enderror">  {{old('description')}}</textarea>
            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="image">Imagens</label>
            <input type="file" name="images[]" id="image"
                   class="form-control form-control-lg @error('images.*') is-invalid @enderror" multiple>
            @error('images')
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
    <script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>
    <script>
        $('#price').maskMoney({prefix: '', allowNegative: false, thousands: '.', decimal: ','});
    </script>
@endsection
