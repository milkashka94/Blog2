@extends('user.layout')
@section('title') Просмотр тега @endsection

@section('content')
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
                        {{$post->title}}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a></h5>
                        <center><img src="/storage/{{$post->image}}" width="300" height="300"></center>
                        <p class="card-text">{!! $post->description !!}</p>
                    </div>
                    <div class="card-footer text-muted">
                        (Автор: <a href="{{route('profile.index', $post->author->name ?? '0')}}">{{$post->author->name ?? 'Неизвестен'}})</a> {{$post->created_at}}
                    </div>
                </div><p>
            @endforeach
        </div></div>
    {{$posts->links()}}


@endsection
