<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('js/all.js') }}" ></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body  style="background: url({{asset('images/core-images/bg.png')}}) fixed">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark-full shadow-sm navbar-fixed-top">
            <div class="container">
                <a class="navbar-brand text-main" href="{{ url('/') }}">
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
                        <li class="nav-item mr-2">
                            <a class="btn btn-main" href="{{ route('cars.create') }}"> 
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                </svg>
                                Elan yerləşdir
                            </a>
                        </li>
                        <li class="nav-item mr-2 @if (Route::currentRouteName()==='cars.bookmarks') active @endif">
                            <a class="nav-link" href="{{ route('cars.bookmarks') }}"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                  </svg>  Seçilmişlər
                                
                            </a>
                        </li>
                        @guest
                            <li class="nav-item mr-2 @if (Route::currentRouteName()==='login')
                            active
                        @endif">
                                <a class="nav-link " href="{{ route('login') }}">Daxil ol</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item mr-2 @if (Route::currentRouteName()==='register')
                                active
                            @endif">
                                    <a class="nav-link" href="{{ route('register') }}">Qeydiyyat</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    @if (Auth::user()->isAdmin())
                                        <a class="dropdown-item" href="{{ route('admin.cars') }}">
                                            Avtomobillər
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.users') }}">
                                            İstifadəçilər
                                        </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('user.cars.index') }}">
                                        Elanlarım
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Çıxış
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('landing')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
