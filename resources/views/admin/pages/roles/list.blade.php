@extends('Admin.layout')
@section('title') Список ролей @endsection
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
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Роли</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная страница</a></li>
                            <li class="breadcrumb-item">Роли</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <a href="{{route('admin.roles.create')}}" class="btn btn-primary mb-2">Добавить</a><p>
            <div class="container-fluid">
                <!-- Content-->
                <div class="col-md-12">
                @if($roles->count() > 0)
                    <!-- /.card -->
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px" class="text-center">ID</th>
                                        <th class="text-center">Название</th>
                                        <th style="width: 40px" class="text-center">Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td class="text-center">{{$role->id}}</td>
                                            <td class="text-center">{{$role->title}}</td>
                                            <td class="text-center"><div class="btn-group">
                                                    <button type="button" class="btn btn-info">Действия</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu" style="">
                                                        <a class="dropdown-item" href="{{ route('admin.roles.edit', $role->id) }}">Редактировать</a>
                                                        <form action="{{route('admin.roles.destroy', $role->id)}}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="border-0 bg-transparent ml-3">
                                                                Удалить
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    @else
                        <div class="alert alert-success alert-dismissible">
                            Категории ещё не добавлены
                        </div>
                    @endif
                </div>
                <!-- /Content-->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        <div class="ml-3">
            {{ $roles->links() }}
        </div>
        <!-- /.content-wrapper -->
    </div>
@endsection
