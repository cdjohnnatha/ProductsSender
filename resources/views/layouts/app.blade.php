<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/common/common.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            @if(auth()->guard('web')->user())
                                <notification-bar :data_id="{{Auth::user()->id}}"></notification-bar>
                            @endif
                            <li>
                                <a href="#" class="btn-lg">
                                    <span class="glyphicon  glyphicon-question-sign"></span>
                                </a>
                            </li>
                            <li class="dropdown" id="optionsDropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span class="glyphicon glyphicon-triangle-bottom"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="">Perfil</a></li>
                                    <li><a id="edit" href="{{route('user.edit', Auth::user()->id)}}">Edit</a></li>
                                    <li>
                                        {{Form::open(['method' => 'DELETE', 'url'=> route('user.destroy', Auth::user()->id), 'style' => 'display:inline'])}}
                                            <button id="delete" type="submit" class="remove-button-border padding-list">Delete</button>
                                        {{Form::close()}}
                                    </li>
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
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @if(auth()->guard('admin')->user())
            @include('layouts._lateral_nav')
        @elseif(auth()->guard('web')->user())
            <user-menu :data_id="{{Auth::user()->id}}"></user-menu>
        @endif
        @if(auth()->guard('admin')->user() || auth()->guard('web')->user())
            <section class="container col-sm-offset-1">
                <div class="col-sm-11 col-sm-offset-1">
                    <div class="panel panel-default">
                        @yield('content')
                    </div>
                </div>
            </section>
        @else
            @yield('content')
        @endif
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
