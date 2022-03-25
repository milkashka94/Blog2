<nav class="py-2 bg-light border-bottom">
    <div class="container d-flex flex-wrap">
        <a class="navbar-brand link-dark px-2" href="{{route('index')}}">{{env('APP_NAME')}}</a>
        <ul class="nav me-auto">
            <li class="nav-item"><a class="nav-link link-dark px-2" href="{{route('index')}}">Посты</a></li>
            <li class="nav-item"><a class="nav-link link-dark px-2" href="{{route('categories')}}">Категории</a></li>
            <li class="nav-item"><a class="nav-link link-dark px-2" href="{{route('tags')}}">Теги</a></li>
            <li class="nav-item"><a class="nav-link link-dark px-2" href="{{route('user.comments.list')}}">Комментарии</a></li>
            <li class="nav-item"><a class="nav-link link-dark px-2" href="{{route('user.users.list')}}">Пользователи</a></li>
            <li class="nav-item"><a class="nav-link link-dark px-2" href="{{route('user.posts.offer')}}">Предложить новость</a></li>
            @checkpermission('moderate-posts')
            <li class="nav-item"><a class="nav-link link-dark px-2" href="{{route('admin.index')}}">Админка</a></li>
            @endcheck
        </ul>
        <ul class="nav">
            @if(isset(Auth::user()->id))
                <li class="nav-item"><a class="nav-link link-dark px-2">Привет, {{Auth::user()->name}}</a></li>
                <li class="nav-item"><a href="{{route('logout')}}" class="nav-link link-dark px-2">Выйти</a></li>
            @else
                <li class="nav-item"><a href="{{route('login')}}" class="nav-link link-dark px-2">Войти</a></li>
                <li class="nav-item"><a href="{{route('register')}}" class="nav-link link-dark px-2">Зарегистрироваться</a></li>
            @endif
        </ul>
    </div>
</nav>
