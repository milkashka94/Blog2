@extends('user.layout')
@section('title') Просмотр тегов @endsection

@section('content')
    <div class="row justify-content-md-center">
        <div class="col col-lg-2"></div>
        <div class="col-md-auto">
            <h1>Список тегов</h1>
        </div>

        <div class="col col-lg-2"></div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-sm-8">
            @foreach($tags as $tag)
                <ul>
                    <li><a href="{{route('tag', $tag->id)}}">{{$tag->title}}</a> (постов: {{$tag->posts->count()}}) <p>
                </ul>
            @endforeach
        </div></div>
    {{$tags->links()}}


@endsection
