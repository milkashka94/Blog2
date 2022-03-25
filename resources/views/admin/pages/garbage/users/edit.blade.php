@extends('Admin.layout')
@section('title') Редактировать @endsection
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
                            <li class="breadcrumb-item">Корзина</li>
                            <li class="breadcrumb-item">Пользователи</li>
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

                            <form action="{{route('admin.garbage.users.update', $user->id)}}" method="POST">
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
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Роль</label>
                                        <select class="form-control" name="role_id">
                                            @foreach($roles as $role)
                                                <option
                                                    value="{{$role->id}}" {{ $role->id == $user->role->id ? ' selected' : ''}}>{{$role->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                        <div class="text-danger"> {{ $message }} </div>
                                        @enderror
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
