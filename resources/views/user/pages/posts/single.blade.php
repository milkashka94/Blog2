@extends('user.layout')
@section('title') {{$post->title}} @endsection

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    <div class="row justify-content-md-center">
        <div class="col col-lg-2"></div>
        <div class="col-md-auto">
            <h1>{{$post->title}}</h1>
        </div>

        <div class="col col-lg-2"></div>
    </div>
    @if($post->is_published)
        <div class="row justify-content-md-center">
            <div class="col-sm-8">
                <div class="card text-center">
                    <div class="card-header">
                        <a href="{{route('category',$post->category->id ?? '0')}}">{{$post->category->title ?? 'Неизвестна'}}</a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a></h5>
                        <center><img src="/storage/{{$post->image}}" width="300" height="300"></center>
                        <p class="card-text">{!! $post->text !!}</p>
                        @checkpermission('update-posts')
                        <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-primary">Редактировать</a>
                        @endcheck
                        @checkpermission('delete-posts')
                        <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-primary mt-2">
                                Удалить
                            </button>
                        </form>
                        @endcheck
                        @foreach($post->tags as $tag)
                            <span class="badge bg-secondary">{{$tag->title}}</span>
                        @endforeach
                    </div>
                    <div class="card-footer text-muted">
                        (Комментариев: {{$post->comments->count()}})
                        (Просмотров: {{$post->views}})
                        (Автор: <a
                            href="{{route('profile.index', $post->author->name ?? '0')}}">{{$post->author->name ?? 'Неизвестен'}}
                            )</a>
                        (Создан: {{\Carbon\Carbon::parse($post->created_at)->format('j F Y H:i')}})
                        @if($post->updated_by != null)
                            <br><i>(Изменен {{$post->updated_at}} пользователем {{$post->editor->name}})</i>
                        @endif
                    </div>

                </div>
                <p>
                @if ($post->comments->count() > 0)
                    <div class="card-footer card-comments" style="display: block;">
                        @foreach($post->comments as $comment)
                            <div class="card-comment">
                                <img class="img-circle img-sm" src="/storage/{{$comment->user->avatar}}"
                                     alt="User Image">
                                <div class="comment-text">
                    <span class="username"><a
                            href="{{route('profile.index', $comment->user->name)}}">{{ $comment->user->name }}</a>
                        <span
                            class="text-muted float-right">{{\Carbon\Carbon::parse($comment->created_at)->format('j F Y H:i')}}
                            @if ($comment->edited_by != null)
                                <i>(изменен пользователем {{$comment->editor->name ?? 'неизвестен'}}) {{\Carbon\Carbon::parse($comment->updated_at)->format('j F Y H:i')}}</i>
                            @endif
                        </span></span>
                                    {{$comment->text}}
                                </div>
                                @checkpermission('update-comments')
                                <a href="{{route('user.comments.edit', $comment->id)}}">Редактировать</a>
                                @endcheck
                                @checkpermission('delete-comments')
                                <form action="{{route('user.comments.delete', $comment->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="border-0 bg-transparent ml-3">
                                        Удалить
                                    </button>
                                </form>
                                @endcheck
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-success alert-dismissible">
                        Комментариев ещё нет
                    </div>
                @endif
                @checkpermission('create-comments')
                <div class="card-footer" style="display: block;">
                    <form action="{{route('user.comments.store', $post->id)}}" method="post">
                        @csrf
                        <img class="img-fluid img-circle img-sm" src="/storage/{{auth()->user()->avatar}}"
                             alt="Alt Text">
                        <div class="img-push">
                            <input type="text" name="text" class="form-control form-control-sm"
                                   placeholder="Введите комментарий...">
                            @error('text')
                            <div class="text-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">
                            Комментировать
                        </button>
                    </form>
                </div>
                @endcheck
            </div>
        </div>
    @else
        <div class="alert alert-warning alert-dismissible">
            Данный пост ещё не прошёл модерацию
        </div>
    @endif
@endsection
