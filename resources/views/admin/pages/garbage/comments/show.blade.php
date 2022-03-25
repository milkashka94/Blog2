@extends('Admin.layout')
@section('title') Редактировать комментарий @endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редактирование комментария</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная страница</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.comments.index')}}">Комментарии</a></li>
                            <li class="breadcrumb-item">Редактировать</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <form action="{{route('admin.comments.update',$comment->id)}}" method="POST">
                                @csrf
                                @method('patch')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Текст комментария</label>
                                        <input type="text" class="form-control" id="title" name="text" placeholder="Введите заголовок" value="{{$comment->text}}" disabled>
                                        @error('text')
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

        <!-- /.content -->
    </div>
@endsection
