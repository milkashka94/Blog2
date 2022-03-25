@extends('user.layout')
@section('title') Редактировать комментарий @endsection

@section('content')

    <div class="row justify-content-md-center">
        <div class="col col-lg-2"></div>
        <div class="col-md-auto">
            <h1>Редактировать комментарий</h1>
        </div>

        <div class="col col-lg-2"></div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-sm-8">
            <div class="card text-center">
                <div class="card-header">
                    Редактирование комментария
                </div>
                <div class="card-body">
                    <form action="{{route('user.comments.update', $comment->id)}}" method="POST">
                        @csrf
                        @method('patch')
                        <label for="title">Текст</label>
                        <input type="text" class="form-control" id="title" name="text" placeholder="Введите заголовок" value="{{$comment->text}}">
                        <p>
                            <button type="submit" class="btn btn-primary mt-3">Редактировать</button>
                    </form>

                </div>
            </div><p>
        </div></div>

@endsection
