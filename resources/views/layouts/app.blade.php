<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="dns-prefetch" href="//fonts.bunny.net">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet" type="text/css" >
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">    
    <script src="{{ asset('js/source.js') }}"></script>

    


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Authentication Links -->

        <div class="container-fluid">

            <div class="row flex-nowrap">
                @guest
        
                @else
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-white">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white ">
                        <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <span class="fs-5 d-none d-sm-inline">Menu</span>
                        </a>
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                            <!-- Authentication Links -->
                            <?php 
                                //obtener rol
                                $user = \Auth::user();
                                $roles = $user->getRoleNames();
                                $role = $roles[0];
                            ?>

                            <li class="nav-item">
                                <a href="{{route('home')}}" class="nav-link align-middle px-0">
                                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                                </a>
                            </li>
                                @if($role == 'admin')
                                <li>
                                    <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                        <i class="fs-4 bi bi-tools"></i>
                                         <span class="ms-1 d-none d-sm-inline">Material</span> </a>
                                    <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                        <li class="w-100">
                                            <a href="{{ route('materialNuevo') }}" class="nav-link px-0"> <span class="d-none d-sm-inline"> Material </span>Nuevo</a>
                                        </li>
                                        
                                        <li>
                                            <a href="{{route('ListarMaterial')}}" class="nav-link px-0"> <span class="d-none d-sm-inline"> Material </span>Todo</a>
                                        </li>
                                    </ul>
                                </li>
                                @endif
                            <li>
                                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                    <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Prestamos</span></a>
                                <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                    <li class="w-100">
                                        <a href="{{ route('pedidoNuevo') }}" class="nav-link px-0"> <span class="d-none d-sm-inline">Prestamo</span> Nuevo</a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li>
                                <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="nav-link px-0 align-middle" >

                                    <i class="fs-4 bi bi-box-arrow-in-right"></i> <span class="ms-1 d-none d-sm-inline">Cerrar sesion</span> </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            </li>
                            
                        </ul>
                        <hr>
                        
                    </div>
                </div>
                @endguest
                <main class="col py-4">

                    @yield('content')

                </main>
            </div>
        </div>
        





        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
