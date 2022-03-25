@extends('user.layout')
@section('title') Список пользователей @endsection

@section('content')
    <div class="row justify-content-md-center">
        <div class="col col-lg-2"></div>
        <div class="col-md-auto">
            <h1>Список пользователей</h1>
        </div>
        <div class="col col-lg-2"></div>
    </div>
    <div class="row justify-content-md-center">
        @foreach($roles as $role)
            <a href="{{route('role.users', $role->id)}}">{{$role->title}}</a>
        @endforeach
        <div class="col-sm-8">
            @foreach($users as $user)
                <ul>
                    <li><a href="{{route('profile.index', $user->name)}}">{{$user->name}}</a> ({{$user->role->title}})
                        <p>
                </ul>
            @endforeach
        </div>
    </div>
    {{$users->links()}}

@endsection
