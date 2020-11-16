@extends('layouts.layout', ['title'=>'Главная страница'])
@section('content')
    @if(isset($_GET['search']))
        @if(count($posts)>0)
            <h2>Результаты поиска по запросу "<?=$_GET['search']?>"</h2>
            <p class="lead">Всего найдено {{count($posts)}} мероприятий</p>
        @else
            <h2>По запросу "<?=htmlspecialchars($_GET['search'])?>" ничего не найдено</h2>
            <a href="{{route('post.index')}}" class="btn btn-outline-primary">Отобразить все мероприятия</a>
        @endif
    @endif

    <div class="row">
        @foreach($posts as $post) <!--виузально красивый вывод в цикле -->
        <div class="col-6">
            <div class="card">
                <div class="card-header"><h2>{{$post->short_title}}</h2></div>
                <div class="card-body">
                    <div class="card-img" style="background-image: url({{$post->img ?? asset('img/default.jpg')}})"> </div>
                    <div class="card-author">Автор: {{$post->name}} </div>
                    <div class="card-author">Дата проведения: {{$post->actual}}</div>
                    <div class="card-author">Вид спорта: {{$post->category}}</div>
                    <a href="{{route('post.show', ['id'=>$post->post_id])}}" class="btn btn-outline-primary">Посмотреть мероприятие</a> <!--смотрим мероприятие -->
                </div>
             </div>
        </div>
        @endforeach
    </div>

    @if(!isset($_GET['search'])) <!--если есть ключ серч то выводим пагинацию если нет то нет-->
    {{$posts->links()}} <!--пагинация-->
    @endif
@endsection

