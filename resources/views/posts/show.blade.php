@extends('layouts.layout', ['title'=>"Мероприятие №$post->post_id. $post->title"])
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h2>{{$post->title}}</h2></div>
                <div class="card-body">
                    <div class="card-img card-img__max" style="background-image: url({{$post->img ?? asset('img/default.jpg')}})"> </div>
                    <div class="card-author">Автор: {{$post->name}} </div>
                    <div class="card-author">Дата проведения: {{ $post->actual}}</div>
                    <div class="card-descr">Регламент и правила проведения мероприятия: {!!$post->descr!!} </div>
                    <div class="card-descr">Мероприятие находится по адресу: </div>
                    <div class="card-descr">
                        <div id="map" style="width: 500px; height: 500px;"></div>
                    </div>
                     <div class="card-date">Мероприятие создано: {{$post->created_at->diffForHumans()}} </div>
                    <p>Cписок участиников :</p>
                    <a href="#">Никита</a>
{{--                    | <a href="#">Принять заявку</a> | <a href="#">Отклонить заявку</a> | Выберете занятое место <select name="select">--}}
{{--                        <option>По умолчанию</option>--}}
{{--                        <option>1</option>--}}
{{--                        <option>2</option>--}}
{{--                        <option>3</option>--}}
{{--                        <option>4</option>--}}
{{--                        <option>5</option>--}}
{{--                    </select>--}}
                    <br><br>
                    <a href="#">Ирина</a>
{{--                    | <a href="#">Принять заявку</a> | <a href="#">Отклонить заявку</a> | Выберете занятое место <select name="select">--}}
{{--                        <option>По умолчанию</option>--}}
{{--                        <option>1</option>--}}
{{--                        <option>2</option>--}}
{{--                        <option>3</option>--}}
{{--                        <option>4</option>--}}
{{--                        <option>5</option>--}}
{{--                    </select>--}}
                    <br><br>
                    <a href="#">Владимир</a>
{{--                    | <a href="#">Принять заявку</a> | <a href="#">Отклонить заявку</a> |  Выберете занятое место <select name="select">--}}
{{--                        <option>По умолчанию</option>--}}
{{--                        <option>1</option>--}}
{{--                        <option>2</option>--}}
{{--                        <option>3</option>--}}
{{--                        <option>4</option>--}}
{{--                        <option>5</option>--}}
{{--                    </select>--}}
                    <br><br>
                    <a href="#">Юрий</a>
{{--                    | <a href="#">Принять заявку</a> | <a href="#">Отклонить заявку</a> | Выберете занятое место <select name="select">--}}
{{--                        <option>По умолчанию</option>--}}
{{--                        <option>1</option>--}}
{{--                        <option>2</option>--}}
{{--                        <option>3</option>--}}
{{--                        <option>4</option>--}}
{{--                        <option>5</option>--}}
{{--                    </select>--}}
                    <br><br>
                    <p></p>
                    <div class="card-btn">
                        <a href="{{route('post.index')}}" class="btn btn-outline-primary">На главную</a>
                        @auth
                            @if(Auth::user()->id == $post->author_id)
                        <a href="{{route('post.edit', ['id'=>$post->post_id])}}" class="btn btn-outline-success">Редактировать</a>
                        <form action="{{route('post.destroy', ['id'=>$post->post_id])}}" method="post" onsubmit="if(confirm('Точно удалить мероприятие?'))
                            { return true } else { return false }">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-outline-danger" value="Удалить">
                            @elseif(Auth::user()->id != $post->author_id)
                                <a href="{{ route('post.edit', ['id'=>$post->post_id]) }}" class="btn btn-outline-dark">Отправить заявку</a>
                        </form>
                    </div>
                            @endif
                        @endauth
                    </div>
                </div>
             </div>
        </div>
@endsection

