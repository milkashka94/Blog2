@extends('Admin.layout')
@section('title') Проверка поста @endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Проверить пост</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><a href="{{route('admin.index')}}">Глваная страница</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.posts.index')}}">Посты</a></li>
                            <li class="breadcrumb-item">Проверить</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">

                            <form action="{{route('admin.posts.moderate.update',$post->id)}}" method="POST" enctype='multipart/form-data'>
                                @csrf
                                @method('patch')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Заголовок</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}" disabled>
                                        @error('title')
                                        <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Категория</label>
                                        <select class="form-control" name="category_id" disabled>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}"
                                                    {{ $category->id == $post->category->id  ? ' selected' : '' }}
                                                >{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Кратая новость</label><p>
                                            <textarea id="description" name="description" disabled>{!! $post->description !!}</textarea>
                                        @error('description')
                                        <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Полный текст</label><p>
                                            <textarea id="text" name="text" disabled>{!! $post->text !!}</textarea>
                                        @error('content')
                                        <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Теги</label>
                                            <div class="select2-purple">
                                                <select name='tags[]' class="select2 select2-hidden-accessible" multiple="" data-placeholder="Выбор тегов" data-dropdown-css-class="select2-purple" style="width: 100%;" data-select2-id="15" tabindex="-1" aria-hidden="true" disabled>
                                                    @foreach($tags as $k => $v)
                                                        <option value="{{ $k }}" @if(in_array($k, $post->tags->pluck('id')->all())) selected @endif>{{ $v }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="ml-2">Обложка</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                            <label class="custom-file-label" for="exampleInputFile">Выберите изображение</label>
                                        </div>
                                    </div>
                                    <img src="/storage/{{$post->image}}" width="300" height="200" class="mt-3"><br>
                                    @if (($post->image) != 'images/no_image.png')
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name='deleteimg' id="deleteimg">
                                            <label class="form-check-label" for="exampleCheck2">Удалить</label>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Утвердить</button>
                                    <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-primary">Редактировать</a>
                                </div>

                            </form>
                            <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    Отклонить
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

@endsection
