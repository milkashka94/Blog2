@extends('user.layout')
@section('title') Комментарии пользователя @endsection

@section('content')
    <div class="row justify-content-md-center">
        <div class="col col-lg-2"></div>
        <div class="col-md-auto">
            <h1>Комментарии пользователя {{$user->name}}</h1>
        </div>

        <div class="col col-lg-2"></div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-sm-8">
            @if ($user->comments->count() > 0)
                <div class="card-footer card-comments" style="display: block;">
                    @foreach($user->comments as $comment)
                        <div class="card-comment">
                            <img class="img-circle img-sm" src="/storage/{{$user->avatar}}" alt="User Image">
                            <div class="comment-text">
                    <span class="username"><a href="{{route('profile.index', $user->name)}}">{{ $user->name }}</a>
                        <span class="text-muted float-right">{{$comment->created_at}}</span></span>
                                {{$comment->text}}
                            </div>
                            <a href="{{route('user.comments.edit', $comment->id)}}">Редактировать</a>
                            <form action="{{route('user.comments.delete', $comment->id)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="border-0 bg-transparent ml-3">
                                    Удалить
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-success alert-dismissible">
                    {{$user->name}} пока не оставлял комментариев
                </div>
            @endif
        </div>
    </div>
@endsection
