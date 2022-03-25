@extends('user.layout')
@section('title') Предложить пост @endsection

@section('content')

    <div class="row justify-content-md-center">
        <div class="col col-lg-2"></div>
        <div class="col-md-auto">
            <h1>Предложить пост</h1>
        </div>

        <div class="col col-lg-2"></div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-sm-8">
            <div class="card text-center">
                <div class="card-header">
                    Создание поста
                </div>
                <div class="card-body">
                    <form action="{{route('user.posts.store')}}" method="POST" enctype='multipart/form-data'>
                        @csrf
                        <label for="title">Заголовок</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Введите заголовок">
                        @error('title')
                        <div class="text-danger"> {{ $message }} </div>
                        @enderror
                        <p>
                            <label for="description">Описание</label>
                            <textarea id="description" name="description"></textarea>
                        @error('description')
                        <div class="text-danger"> {{ $message }} </div>
                        @enderror
                        <p>
                            <label for="text">Полная новость</label>
                            <textarea id="text" name="text"></textarea>
                        @error('text')
                        <div class="text-danger"> {{ $message }} </div>
                        @enderror
                        <p>
                            <label for="category_id">Категория</label>
                            <select class="form-control" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        @error('category_id')
                        <div class="text-danger"> {{ $message }} </div>
                        @enderror
                        <p>
                            <label>Теги</label>
                        <div class="select2-purple">
                            <select name='tags[]' class="select2 select2-hidden-accessible" multiple=""
                                    data-placeholder="Выбор тегов" data-dropdown-css-class="select2-purple"
                                    style="width: 100%;" data-select2-id="15" tabindex="-1" aria-hidden="true">
                                @foreach($tags as $k => $v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                            @error('tags')
                            <div class="text-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                        <p>
                        <div class="form-group">
                            <label for="image">Обложка</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                    <label class="custom-file-label" for="exampleInputFile">Выберите изображение</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Обзор</span>
                                </div>
                            </div>
                            @error('image')
                            <div class="text-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                        <p>
                            <button type="submit" class="btn btn-primary mt-3">Создать</button>
                    </form>
                </div>
            </div>
            <p>
        </div>
    </div>
@endsection
