@extends('Admin.layout')
@section('title') Проверка постов @endsection
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
                        <h1 class="m-0">Список постов для проверки</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><a href="{{route('admin.index')}}">Глваная страница</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.posts.index')}}">Посты</a></li>
                            <li class="breadcrumb-item">Модерация</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Content-->
                <div class="col-md-12">

                @if ($posts->count() > 0)
                    <!-- /.card -->
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px" class="text-center">ID</th>
                                        <th class="text-center">Название</th>
                                        <th class="text-center">Категория</th>
                                        <th class="text-center">Автор</th>
                                        <th style="width: 40px" class="text-center">Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td class="text-center">{{$post->id}}</td>
                                            <td class="text-center"><a href ='{{route('admin.posts.moderate.edit', $post->id)}}'>{{$post->title}}</a></td>
                                            <td class="text-center"><a href ='{{route('category', $post->category->id ?? 0)}}'>{{$post->category->title ?? "Неизвестна"}} </a></td>
                                            <td class="text-center"><a href ='{{route('profile.index', $post->user->name ?? 0)}}'>{{$post->user->name ?? "Неизвестен"}} </a></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Действия</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu" style="">
                                                        <a class="dropdown-item"
                                                           href="{{route('admin.posts.moderate.edit', $post->id)}}">Проверить</a>
                                                        <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="border-0 bg-transparent ml-3">
                                                                Отклонить
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
                    @else
                        <div class="alert alert-success alert-dismissible">
                            Постов для проверки нет
                        </div>
                @endif
                <!-- /.card -->
                </div>

                <!-- /Content-->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        <div class="ml-3">
            {{ $posts->links() }}
        </div>
    </div>

@endsection
