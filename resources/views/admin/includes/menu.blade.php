<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
            <a href="{{route('admin.index')}}" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Глваная
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Посты
                    <i class="fas fa-angle-left right"></i>
                    @if($moderation_posts)
                    <span class="badge badge-info right">{{$moderation_posts}}</span>
                    @endif
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('admin.posts.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Список</p>
                    </a>
                </li>
                @checkpermission('creation-posts')
                <li class="nav-item">
                    <a href="{{route('admin.posts.create')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Создать</p>
                    </a>
                </li>
                @endcheck
                @checkpermission('moderate-posts')
                <li class="nav-item">
                    <a href="{{route('admin.posts.moderate.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>На проверке</p>
                        @if($moderation_posts)
                            <span class="badge badge-info right">{{$moderation_posts}}</span>
                        @endif
                    </a>
                </li>
                @endcheck
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.categories.index')}}" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Категории
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.tags.index')}}" class="nav-link">
                <i class="nav-icon fas fa-tags"></i>
                <p>
                    Теги
                </p>
            </a>
        </li>
        @checkpermission('update-comments')
        <li class="nav-item">
            <a href="{{route('admin.comments.index')}}" class="nav-link">
                <i class="nav-icon far fa-comment-dots"></i>
                <p>
                    Комментарии
                </p>
            </a>
        </li>
        @endcheck
        @checkpermission('edit-users')
        <li class="nav-item">
            <a href="{{route('admin.users.index')}}" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    Пользователи
                </p>
            </a>
        </li>
        @endcheck
        @checkpermission('roles-management')
        <li class="nav-item">
            <a href="{{route('admin.roles.index')}}" class="nav-link">
                <i class="nav-icon far fa-address-card"></i>
                <p>
                    Роли
                </p>
            </a>
        </li>
        @endcheck
        @checkpermission('basket-access')
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-trash-alt"></i>
                <p>
                    Корзина
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('admin.garbage.posts.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Посты</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.garbage.comments.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Комментарии</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.garbage.users.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Пользователи</p>
                    </a>
                </li>
            </ul>
        </li>
        @endcheck
    </ul>
</nav>
<!-- /.sidebar-menu -->
