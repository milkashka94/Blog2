@extends('Admin.layout')
@section('title') Создать пользователя @endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Создать пользователя</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Админ панель</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Пользователи</a></li>
                            <li class="breadcrumb-item">Создать</li>
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

                            <form action="{{route('admin.users.store')}}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Логин</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Введите логин">
                                        @error('name')
                                        <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">E-mail</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               placeholder="Введите email">
                                        @error('email')
                                        <div class="text-danger"> {{ $message }} </div>
                                        @enderror
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
                                                <option value="{{$role->id}}">{{$role->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                        <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                    @endcheck
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Создать</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
