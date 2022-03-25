@extends('user.layout')
@section('title') Список комментариев @endsection

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    <div class="row justify-content-md-center">
        <div class="col col-lg-2"></div>
        <div class="col-md-auto">
            <h1>Список комментериев</h1>
        </div>

        <div class="col col-lg-2"></div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-sm-8">
            @foreach($comments as $comment)
                <ul>
                    <li><a href="{{route('posts.show', $comment->post->id)}}">{{$comment->post->title}}</a>
                        <p>
                        {{$comment->text}}<p>
                            @checkpermission('update-comments')
                            <a href="{{route('user.comments.edit', $comment->id)}}" class="btn btn-primary">Редактировать</a>
                            @endcheck
                            @checkpermission('delete-comments')
                        <form action="{{route('user.comments.delete', $comment->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                Удалить
                            </button>
                        </form>
                        @endcheck
                </ul>
            @endforeach
        </div>
    </div>
    {{$comments->links()}}
@endsection
