@extends('Admin.layout')
@section('title') Редактировать пользователя @endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редактировать пользователя</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Админ панель</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Пользователи</a></li>
                            <li class="breadcrumb-item">Редактировать</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">

                            <form action="{{route('admin.users.update', $user->id)}}" method="POST" enctype='multipart/form-data'>
                                @csrf
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Логин</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{$user->name}}">
                                        @error('name')
                                        <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                        @if (session()->has('unique_login'))
                                            <div class="text-danger"> Логин не уникален </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">E-mail</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{$user->email}}">
                                        @error('email')
                                        <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                        @if (session()->has('unique_email'))
                                            <div class="text-danger"> Email не уникален </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Пароль</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                               placeholder="Введите пароль">
                                        @error('password')
                                        <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                    @checkpermission('roles-management')
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Роль</label>
                                        <select class="form-control" name="role_id">
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}" {{ $role->id == $user->role->id ? ' selected' : ''}}>{{$role->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                        <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                    @endcheck
                                    <div class="form-group">
                                        <label for="avatar">Аватар</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile" name="avatar">
                                                <label class="custom-file-label" for="exampleInputFile">Выберите изображение</label>
                                            </div>
                                        </div>
                                        <center><img src="/storage/{{$user->avatar}}" width="200" height="200" class="mt-3"><p>
                                            @if (($user->avatar) != 'images/avatars/noavatar.png')
                                                <input type="checkbox" class="form-check-input" name='deleteimg' id="deleteimg">
                                                <label class="form-check-label" for="exampleCheck2">Удалить</label></center>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Редактировать</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
