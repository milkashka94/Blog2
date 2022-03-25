@extends('user.layout')
@section('title') Категории @endsection

@section('content')
    <div class="row justify-content-md-center">
        <div class="col col-lg-2"></div>
        <div class="col-md-auto">
            <h1>Список категорий</h1>
        </div>

        <div class="col col-lg-2"></div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-sm-8">
            @foreach($categories as $category)
                <ul>
                    <li><a href="{{route('category', $category->id)}}">{{$category->title}}</a> (постов: {{$category->posts->count()}}) <p>
                </ul>
            @endforeach
        </div></div>
    {{$categories->links()}}


@endsection
