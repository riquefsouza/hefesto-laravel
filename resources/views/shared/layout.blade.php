<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title>HFS Hefesto - @yield('title')</title>

    <link rel="stylesheet" href="/static/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="/static/bootstrap-5.0.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/static/css/system.css" />
    <link rel="stylesheet" href="/static/dataTables-1.10.24/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="/static/css/hfsframework-tree.css" />

    <script src="/static/popper-2.9.2/umd/popper.min.js"></script>
    <script src="/static/bootstrap-5.0.1/js/bootstrap.min.js"></script>
    <script src="/static/jquery-3.6.0/js/jquery-3.6.0.min.js"></script>
    <script src="/static/dataTables-1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="/static/dataTables-1.10.24/js/dataTables.bootstrap5.min.js"></script>
    <script src="/static/js/hfsframework/hfsframework-system-util.js"></script>

</head>
<body>

    @if ($userLogged->Active)

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" id="anchorHomePage" href="~/home"
                   style="float: left; height: 50px; padding: 5px 5px; font-size: 14px; text-decoration:none">
                    <span>{{ $messages["main.framework"] }}</span><br>
                    <span>{{ $messages["main.app.title"] }}</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">

                            @foreach ($menu as $menuItem)
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $menu->description }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li>
                                        @foreach ($submenu as $menu->SubMenus)
                                            <a class="dropdown-item" href="{{ route($submenu->url) }}">
                                                {{ $submenu->Description }}
                                            </a>
                                        @endforeach
                                    </li>
                                </ul>
                            @endforeach

                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/logout') }}">
                                <span class="icon text-white-50">
                                    <i class="fa fa-door-open"></i>
                                </span>
                                Sair
                            </a>
                        </li>

                    </ul>

                    <div class="d-flex">
                        <span class="icon text-white-50">
                            <i class="fas fa-user fa-sm"></i>
                            {{ $userLogged->Login }}
                        </span>
                    </div>

                </div>
            </div>
        </nav>

    @endif

    @include('shared.alertMessages', ['alertMessage' => 'alertMessage'])

    <div>
        <main role="main">
            @yield('content')
        </main>
    </div>

</body>
</html>
