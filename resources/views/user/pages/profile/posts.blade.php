@extends('user.layout')
@section('title') Посты пользователя @endsection

@section('content')
    <div class="row justify-content-md-center">
        <div class="col col-lg-2"></div>
        <div class="col-md-auto">
            <h1>Посты пользователя {{$user->name}}</h1>
        </div>

        <div class="col col-lg-2"></div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-sm-8">
            @if ($user->posts->count() > 0)
                @foreach($user->posts as $post)
                    <div class="card text-center">
                        <div class="card-header">
                            {{$post->category->title}}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a>
                            </h5>
                            <center><img src="/storage/{{$post->image}}" width="300" height="300"></center>
                            <p class="card-text">{!! $post->description !!}</p>
                            <a href="{{route('posts.edit', $post->id)}}" class="btn btn-primary">Редактировать</a>
                            <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-primary mt-2">
                                    Удалить
                                </button>
                            </form>
                        </div>
                        <div class="card-footer text-muted">
                            (Комментариев: {{$post->comments->count()}})
                            (Просмотров: {{$post->views}})
                            (Автор: <a href="{{route('profile.index', $post->author->name ?? '0')}}">{{$post->author->name ?? 'Неизвестен'}})</a> {{$post->created_at}}
                            (Создан: {{\Carbon\Carbon::parse($post->created_at)->format('j F Y H:i')}})
                            @if($post->updated_by != null)
                                <br><i>(Изменен {{$post->updated_at}} пользователем {{$post->editor->name}})</i>
                            @endif
                        </div>
                    </div><p>
                @endforeach
            @else
                <div class="alert alert-success alert-dismissible">
                    {{$user->name}} пока не добавлял публикации
                </div>
            @endif
        </div>
    </div>
@endsection
