@extends('Admin.layout')
@section('title') Редактировать тег @endsection
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать тег</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Админ панель</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.tags.index')}}">Теги</a></li>
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

                        <form action="{{route('admin.tags.update', $tag->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Название тега</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{$tag->title}}">
                                    @error('title')
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
