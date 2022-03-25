@extends('Admin.layout')
@section('title') Редактировать роль @endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редактировать роль</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Админ панель</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.roles.index')}}">Роли</a></li>
                            <li class="breadcrumb-item">Редактировать</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">

                            <form action="{{route('admin.roles.update', $role->id)}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Название роли</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{$role->title}}">
                                        @error('title')
                                        <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Права:</label><p>
                                            @foreach($permissions as $k => $v)
                                                <input class="form-check-input ml-1" type="checkbox" id="permissions" value="{{$k}}" name="permissions[]" @if(in_array($k, $role->permissions->pluck('id')->all())) checked @endif>
                                                <label class="form-check-label ml-4">{{$v}}</label><br>
                                        @endforeach
                                        @error('permissions')
                                        <div class="text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Редактировать</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
