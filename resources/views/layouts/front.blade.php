<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Shop Template</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <style>
        .front.row {
            margin-bottom: 40px;
        }
    </style>
    @yield('stylesheet')
</head>
<body style="margin-top: 5em;">
<header>
    <div class="fixed-top">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{route('home')}}"><img src="/docs/4.4/assets/brand/bootstrap-solid.svg"
                                                                  width="30"
                                                                  height="30"
                                                                  class="d-inline-block align-top" alt="">
                ShopBase</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item @if(request()->is('/')) active @endif">
                        <a class="nav-link" href="{{route('home')}}">Home</a>
                    </li>
                    @foreach($categories as $category)
                        <li class="nav-item @if(request()->is('category/' . $category->slug)) active @endif">
                            <a class="nav-link" href="{{route('category.single' , ['slug' => $category->slug])}}">{{$category->name}}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto">
                        @auth
                            <li class="nav-item @if(request()->is('my-orders')) active @endif">
                                <a href="{{route('user.orders')}}" class="nav-link">Meus Pedidos</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link"
                                   onclick="event.preventDefault(); document.querySelector('form.logout').submit();">Sair</a>
                                <form action="{{route('logout')}}" class="logout ds-none" method="post">
                                    @csrf
                                </form>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link">{{auth()->user()->name}}</span>
                            </li>
                        @endauth
                        <li class="nav-item">
                            <a href="{{route('cart.index')}}" class="nav-link">
                                @if(session()->has('cart'))
                                    <span
                                        class="badge badge-danger">{{array_sum(array_column(session()->get('cart'), 'amount'))}}</span>
                                @endif
                                <i class="fa fa-shopping-cart fa-2x"></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>


<div class="container">
    @include('flash::message')
    @yield('content')

</div>

<!-- JavaScrip -->
<script src="{{asset('js/app.js')}}"></script>
@yield('scripts')
</body>
</html>
