@extends('layouts.layout', ['title'=>"Создать новое мероприятие"])
@section('content')
    <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <h3>Создать мерпориятие</h3>
        @include('posts.parts.form')

        <input type="submit" value="Создать мероприятие" class="btn btn-outline-success">
{{--        <h3>Отобразить профиль </h3>--}}
{{--        @include('posts.parts.profile')--}}

{{--        <input type="submit" value="Отобразить профиль" class="btn btn-outline-success">--}}
    </form>
@endsection
