@extends('layouts.app')

@section('content')

    <h1>Lista de Categorias</h1>
    <a href="{{route('admin.categories.create')}}" class="btn btn-lg btn-success">Criar Categoria</a>
    <hr>
    @if($categories->count())
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td width="15%">
                    <div class="btn-group">
                        <a href="{{route('admin.categories.edit', ['category' => $category->id])}}"
                           ><button type="submit" class="btn btn-sm btn-primary m-1">EDITAR</button></a>
                        <form action="{{route('admin.categories.destroy', ['category' => $category->id])}}"
                              method="post">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-sm btn-danger m-1">REMOVER</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
        @else
            <h3 class="alert alert-warning">Você não possui nenhum categoria cadastrada!</h3>
        @endif
    </table>

{{$categories->links()}}
@endsection

