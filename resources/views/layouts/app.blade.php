<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Advert</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css', 'build') }}" rel="stylesheet">
</head>
<body id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                       Advert
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @foreach (array_slice($menuPages, 0, 3) as $page)
                            <li><a class="nav-link" href="{{ route('page', page_path($page)) }}">{{ $page->getMenuTitle() }}</a></li>
                        @endforeach
                        @if ($morePages = array_slice($menuPages, 3))
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    More... <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach ($morePages as $page)
                                        <a class="dropdown-item" href="{{ route('page', page_path($page)) }}">{{ $page->getMenuTitle() }}</a>
                                    @endforeach
                                </div>
                            </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="" href="{{ route('admin.home') }}">Admin</a> </li>
                                    <li>   <a class="" href="{{ route('cabinet.home') }}">Cabinet</a> </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        @section('search')
            @include('layouts.partials.search', ['category' => null, 'route' => route('adverts.index')])
        @show


    <main class="app-content py-3">
        <div class="container">
            @include('layouts.partials.flash')
            @yield('content')
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="border-top pt-3">
                <p>&copy; {{ date('Y') }} - Adverts</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js', 'build') }}"></script>
    @yield('scripts')
</body>
</html>
