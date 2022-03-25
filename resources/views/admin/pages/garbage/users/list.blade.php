@extends('Admin.layout')
@section('title') Удаленные пользователи @endsection
@section('content')
    <div class="content-wrapper">
        <div class="container mt-2">
            <div class="row">
                <div class="col-12">

                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Удаленные пользователи</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная страница</a></li>
                            <li class="breadcrumb-item">Корзина</li>
                            <li class="breadcrumb-item">Пользователи</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Content-->
                <div class="col-md-12">

                    <!-- /.card -->
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 10px" class="text-center">ID</th>
                                    <th class="text-center">Логин</th>
                                    <th class="text-center">E-mail</th>
                                    <th class="text-center">Роль</th>
                                    <th class="text-center">Регистрация</th>
                                    <th style="width: 40px" class="text-center">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td class="text-center">{{$user->id}}</td>
                                        <td class="text-center"><a
                                                href="{{route('admin.garbage.users.show', $user->id)}}">{{$user->name}}</a></td>
                                        <td class="text-center">{{$user->email}}</td>
                                        <td class="text-center">{{$user->role->title}}</td>
                                        <td class="text-center">{{$user->created_at}}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info">Действия</button>
                                                <button type="button" class="btn btn-info dropdown-toggle dropdown-icon"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu" style="">
                                                    <a class="dropdown-item"
                                                       href="{{ route('admin.garbage.users.edit', $user->id) }}">Редактировать</a>
                                                    <a class="dropdown-item"
                                                       href="{{ route('admin.garbage.users.restore', $user->id) }}">Восстановить</a>
                                                    <form action="{{route('admin.garbage.users.destroy', $user->id)}}"
                                                          method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="border-0 bg-transparent ml-3">
                                                            Удалить
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /Content-->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        <div class="ml-3">
            {{ $users->links() }}
        </div>
    </div>
@endsection
