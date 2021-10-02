<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>
<body>
    <div id="app" class="footerFixed">
        {{-- Header --}}
        <nav class="navbar navbar-expand-md navy-background shadow-sm fixed-top py-2">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="{{ route('home') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item d-flex align-items-center">
                                <a href="{{ route('ensemble.create') }}" class="nav-link text-white">Create an ensemble</a>
                            </li>

                            <li class="nav-item d-flex align-items-center">
                                <a href="{{ route('post.create') }}" class="nav-link text-white">Create a post</a>
                            </li>

                            <li class="nav-item d-flex align-items-center">
                                <a href="{{ route('chat') }}" class="nav-link text-white">Chat</a>
                            </li>

                            <li class="nav-item d-flex align-items-center">
                                <a href="{{ route('notification.notifications') }}" class="nav-link text-white">
                                    <i class="far fa-bell fa-lg"></i>
                                    <span class="badge badge-pill badge-danger">
                                        @if($num_of_unread_notifications > 0)
                                            {{ $num_of_unread_notifications }}
                                        @endif
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item d-flex align-items-center dropdown">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img class="rounded-circle bg-white" src="{{ asset('storage/'.Auth::user()->avatar) }}" alt="avatar" style="width:25px">
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.show', Auth::user()->id) }}">
                                        Profile
                                    </a>

                                    <a class="dropdown-item" href="{{ route('post.list') }}" class="nav-link">
                                        My posts
                                    </a>

                                    <a class="dropdown-item" href="{{ route('ensemble.myEnsembles') }}" class="nav-link">
                                        My ensembles
                                    </a>

                                    <a class="dropdown-item" href="{{ route('post.favoritePost') }}">
                                        Favorite posts
                                    </a>

                                    @foreach(Auth::user()->roles as $role)
                                        @if($role->slug == 'admin')
                                            <a class="dropdown-item" href="{{ route('admin.home', Auth::user()) }}">
                                                Admin
                                            </a>
                                        @endif
                                    @endforeach
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="mb-3" style="margin-top: 70px; min-height: 100vh;">
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="container-fluid text-white bg-dark w-100 p-3">
            <div class="row mb-2">
                <h5 class="col-md-4 text-center m-0">
                    <a href="{{ route('home') }}" class="text-white">{{ config('app.name') }}</a>
                </h5>
                <div class="col-md-4 text-center">
                    <a href="#" class="text-white"><i class="fab fa-facebook mx-2"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram mx-2"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-twitter mx-2"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-youtube mx-2"></i></a>
                </div>
                <div class="col-md-4 text-center">
                    <a href="{{ route('inquiry.create') }}" class="text-white">Contact us <i class="far fa-paper-plane"></i></a>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="small">© 2021 Copyright: Hayato Yokomiya</div>
            </div>
        </footer>
    </div>

    @yield('js')
</body>
</html>
