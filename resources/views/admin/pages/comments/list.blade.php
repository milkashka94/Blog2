@extends('Admin.layout')
@section('title') Список комментариев @endsection
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
                        <h1 class="m-0">Комментарии</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная страница</a></li>
                            <li class="breadcrumb-item">Комментарии</li>
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

                @if ($comments->count() > 0)
                    <!-- /.card -->
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px" class="text-center">ID</th>
                                        <th class="text-center">Текст</th>
                                        <th class="text-center">Пост</th>
                                        <th class="text-center">Автор</th>
                                        <th style="width: 40px" class="text-center">Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($comments as $comment)
                                        <tr>
                                            <td class="text-center">{{$comment->id}}</td>
                                            <td class="text-center" width="300">{{$comment->text}}</td>
                                            <td class="text-center" width="300"><a href="{{route('posts.show', $comment->post->id ?? "0")}}">{{$comment->post->title ?? "Неизвестен"}}</a></td>
                                            <td class="text-center">@if (isset($comment->user->name)){{$comment->user->name}}@else
                                                    <i>Неизвестный</i> @endif</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Действия</button>
                                                    <button type="button"
                                                            class="btn btn-info dropdown-toggle dropdown-icon"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu" style="">
                                                        @checkpermission('update-comments')
                                                        <a class="dropdown-item"
                                                           href="{{ route('admin.comments.edit', $comment->id) }}">Редактировать</a>
                                                        @endcheck
                                                        @checkpermission('update-comments')
                                                        <form action="{{route('admin.comments.destroy', $comment->id)}}"
                                                              method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="border-0 bg-transparent ml-3">
                                                                Удалить
                                                            </button>
                                                        </form>
                                                        @endcheck
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
                    @else
                        <div class="alert alert-success alert-dismissible">
                            Комментариев ещё нет
                        </div>
                    @endif
                </div>
                <!-- /Content-->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        <div class="ml-3">
            {{ $comments->links() }}
        </div>
        <!-- /.content-wrapper -->
    </div>
@endsection
