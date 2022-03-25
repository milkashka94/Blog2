@extends('user.layout')
@section('title') Профиль пользователя {{$user->name}} @endsection

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    <div class="row justify-content-md-center">
        <div class="col col-lg-2"></div>
        <div class="col-md-auto">
            <h1>Пользователь {{ $user->name }}</h1>
        </div>

        <div class="col col-lg-2"></div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-sm-8">
            <img src="/storage/{{$user->avatar}}" width="200" height="200"></img>
            <ul>
                <li>Имя: {{$user->name}}</li>
                <li>Роль: {{$user->role->title}}</li>
                <li>Email: {{$user->email}}</li>
                <li>Постов: <a href="{{route('profile.posts.index', $user->name)}}">{{$user->posts->count()}}</a></li>
                <li>Комментов: <a
                        href="{{route('profile.comments.index', $user->name)}}">{{$user->comments->count()}}</a></li>
            </ul>
            @checkpermission('edit-users')
            <a href="{{route('profile.edit', $user->name)}}" class="btn btn-primary">Редактировать</a>
            @endcheck
            <p>
        </div>
    </div>
@endsection
