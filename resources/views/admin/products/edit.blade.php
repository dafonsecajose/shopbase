@extends('layouts.app')

@section('content')
    <h2>Cadastro Produto</h2>
    <hr>
    <form action="#" method="post">
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control form-control-lg" name="resume" id="name">
        </div>
        <div class="form-group">
            <label for="resume">Descrição Destaque:</label>
            <input type="text" class="form-control form-control-lg" name="resume" id="resume">
        </div>
        <div class="form-row">
            <div class="form-group  col-md-6">
                <label for="weight">Peso:</label>
                <input type="number" class="form-control form-control-lg" name="weight" id="weight">
            </div>
            <div class="form-group  col-md-6">
                <label for="price">Preço:</label>
                <input type="number" class="form-control form-control-lg" name="price" id="price">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="height">Altura:(cm)</label>
                <input type="number" class="form-control form-control-lg" name="height" id="height">
            </div>
            <div class="form-group col-md-4">
                <label for="width">Largura:(cm)</label>
                <input type="number" class="form-control form-control-lg" name="width" id="width">
            </div>
            <div class="form-group col-md-4">
                <label for="depth">Profundidade:(cm)</label>
                <input type="number" class="form-control form-control-lg" name="depth" id="depth">
            </div>
        </div>
        <div class="form-group">
            <label for="description">Descrição Detalhada</label>
            <textarea name="description"
                      id="description" cols="30"
                      rows="3"
                      class="form-control form-control-lg"></textarea>
        </div>
{{--        <div class="form-group">--}}
{{--            <label for="image">Imagens</label>--}}
{{--            <input type="file" name="images" id="image" class="form-control form-control-lg">--}}
{{--        </div>--}}
        <div class="form-group text-center">
            <button class="btn btn-lg btn-success m-1">Cadastrar</button>
            <button class="btn btn-lg btn-danger m-1">Limpar</button>
        </div>
    </form>
@endsection

@section('scripts')
    <script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>
    <script>
        $('#price').maskMoney({prefix: '', allowNegative:false, thousands: '.', decimal: ','});
@endsection
