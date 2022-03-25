@extends('user.layout')
@section('title') Глваная страница @endsection

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    <div class="row justify-content-md-center">
        <div class="col col-lg-2"></div>
        <div class="col-md-auto">
            <h1>Последние посты</h1>
        </div>

        <div class="col col-lg-2"></div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-sm-8">
            @foreach($posts as $post)
                <div class="card text-center">
                    <div class="card-header">
                        <a href="{{route('category',$post->category->id ?? "0")}}">{{$post->category->title ?? 'Неизвестна'}}</a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a></h5>
                        <center><img src="/storage/{{$post->image}}" width="300" height="300"></center>
                        <p class="card-text">{!! $post->description !!}</p>
                    </div>
                    <div class="card-footer text-muted">
                        (Комментариев: {{$post->comments->count()}})
                        (Просмотров: {{$post->views}})
                        (Автор: <a href="{{route('profile.index', $post->author->name ?? '0')}}">{{$post->author->name ?? 'Неизвестен'}})</a>
                        (Создан: {{\Carbon\Carbon::parse($post->created_at)->format('j F Y H:i')}})
                        @if($post->updated_by != null)
                            <br><i>(Изменен {{$post->updated_at}} пользователем {{$post->editor->name}})</i>
                        @endif
                    </div>
                </div><p>
            @endforeach
            {{$posts->links()}}
        </div></div>


    <div class="row justify-content-md-center">
        <div class="col col-lg-2"></div>
        <div class="col-md-auto">
            <h1>Просматриваемые посты</h1>
        </div>

        <div class="col col-lg-2"></div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-sm-8">
            @foreach($viewed as $post)
                <div class="card text-center">
                    <div class="card-header">
                        <a href="{{route('category',$post->category->id ?? "0")}}">{{$post->category->title ?? 'Неизвестна'}}</a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a></h5>
                        <center><img src="/storage/{{$post->image}}" width="300" height="300"></center>
                        <p class="card-text">{!! $post->description !!}</p>
                    </div>
                    <div class="card-footer text-muted">
                        (Комментариев: {{$post->comments->count()}})
                        (Просмотров: {{$post->views}})
                        (Автор: <a href="{{route('profile.index', $post->author->name ?? '0')}}">{{$post->author->name ?? 'Неизвестен'}})</a>
                        (Создан: {{\Carbon\Carbon::parse($post->created_at)->format('j F Y H:i')}})
                        @if($post->updated_by != null)
                            <br><i>(Изменен {{$post->updated_at}} пользователем {{$post->editor->name}})</i>
                        @endif
                    </div>
                </div><p>
            @endforeach
        </div></div>
    <div class="row justify-content-md-center">
        <div class="col col-lg-2"></div>
        <div class="col-md-auto">
            <h1>Обсуждаемые посты</h1>
        </div>

        <div class="col col-lg-2"></div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-sm-8">
            @foreach($discussed as $post)
                <div class="card text-center">
                    <div class="card-header">
                        <a href="{{route('category',$post->category->id ?? "0")}}">{{$post->category->title ?? 'Неизвестна'}}</a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a></h5>
                        <center><img src="/storage/{{$post->image}}" width="300" height="300"></center>
                        <p class="card-text">{!! $post->description !!}</p>
                    </div>
                    <div class="card-footer text-muted">
                        (Комментариев: {{$post->comments->count()}})
                        (Просмотров: {{$post->views}})
                        (Автор: <a href="{{route('profile.index', $post->author->name ?? '0')}}">{{$post->author->name ?? 'Неизвестен'}})</a>
                        (Создан: {{\Carbon\Carbon::parse($post->created_at)->format('j F Y H:i')}})
                        @if($post->updated_by != null)
                            <br><i>(Изменен {{$post->updated_at}} пользователем {{$post->editor->name}})</i>
                        @endif
                    </div>
                </div><p>
            @endforeach
        </div></div>
@endsection
