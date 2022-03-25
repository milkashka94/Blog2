@extends('Admin.layout')
@section('title') Главная страница @endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Админпанель</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Глваная страница</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$posts}}</h3>
                            <p>Постов</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                        <a href="{{route('admin.posts.index')}}" class="small-box-footer">Просмотр <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$comments}}</h3>
                            <p>Комментариев</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-chatboxes"></i>
                        </div>
                        <a href="{{route('admin.comments.index')}}" class="small-box-footer">Просмотр <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$users}}</h3>
                            <p>Пользователей</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                        <a href="{{route('admin.users.index')}}" class="small-box-footer">Просмотр <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
