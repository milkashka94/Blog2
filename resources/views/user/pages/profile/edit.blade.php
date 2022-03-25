@extends('user.layout')
@section('title') Редактирование пользователя @endsection

@section('content')
    <div class="row justify-content-md-center">
        <div class="col col-lg-2"></div>
        <div class="col-md-auto">
            <h1>Редактировать пользователя</h1>
        </div>

        <div class="col col-lg-2"></div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-sm-8">
            <div class="card text-center">
                <div class="card-header">
                    Редактирование пользователя
                </div>
                <div class="card-body">
                    <form action="{{route('profile.update', $user->name)}}" method="POST" enctype='multipart/form-data'>
                        @csrf
                        @method('patch')
                        <label for="name">Логин</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                        @error('name')
                        <div class="text-danger"> {{ $message }} </div>
                        @enderror
                        <p>
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
                        @error('email')
                        <div class="text-danger"> {{ $message }} </div>
                        @enderror
                        <p>
                            <label for="password">Пароль</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль">
                        @error('password')
                        <div class="text-danger"> {{ $message }} </div>
                        @enderror
                        <div class="form-group">
                            <label for="avatar">Аватар</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="avatar">
                                    <label class="custom-file-label" for="exampleInputFile">Выберите изображение</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Обзор</span>
                                </div>
                            </div>
                        </div>
                        <img src="/storage/{{$user->avatar}}" width="200" height="200" class="mt-3"><p>
                            @if (($user->avatar) != 'images/avatars/noavatar.png')
                                <input type="checkbox" class="form-check-input" name='deleteimg' id="deleteimg">
                                <label class="form-check-label" for="exampleCheck2">Удалить</label>
                        @endif
                        <p>
                            <button type="submit" class="btn btn-primary mt-3">Редактировать</button>
                    </form>
                </div>
            </div><p>
        </div></div>
@endsection
