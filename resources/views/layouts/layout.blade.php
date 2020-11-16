<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png')}}">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <div class="container collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="col-6 navbar-nav mr-auto">
            <li class="nav-item active"> <!--Создание значков навбара сверху-->
                <a class="nav-link" href="/">Главная<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active offset-3">
                <a class="nav-link" href="{{route('post.create')}}">Создать мероприятие<span class="sr-only">(current)</span></a><!--нужно прописывать маршрут для создания-->
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="{{ route('post.index') }}">
            <input class="form-control mr-sm-2" name="search" type="search" placeholder="Найти мерпориятие..." aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
        </form>
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Войти') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Зарегистрироваться') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Профиль') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Выйти') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>

    </div>
</nav>

<div class="container">
    @if($errors->any())
        @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endforeach
    @endif
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @yield('content')
</div>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"
        type="text/javascript" charset="utf-8" >
</script>
<script>
    var editor = CKEDITOR.replace( 'descr' );
    config.fullPage = true;
</script>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=6fb09337-7108-4260-bef2-8668429816a9" type="text/javascript"> </script>
<script src="{{ asset('js/event_reverse_geocode.js')}}" type="text/javascript"> </script>
</body>
</html>
