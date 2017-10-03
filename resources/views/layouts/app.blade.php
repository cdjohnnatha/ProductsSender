<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiwJ8VLRYRIG_5kUNgNFlELaJTjBWt-Hw&libraries=places"></script>--}}
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZFQPhIqrB4KK8tY9O0uC0oajn1ZD0xRQ&libraries=places"></script>

  <title>{{ config('app.name', 'Holyship') }}</title>

  <!-- Bootstrap -->
  <link href="{{asset('css/layout/vendor.bundle.css')}}" rel="stylesheet">
  <link href="{{asset('css/layout/app.bundle.css')}}" rel="stylesheet">
  <link href="{{asset('css/layout/theme-a.css')}}" rel="stylesheet">

</head>
<body>
<section id="app">
  @if (Auth::guest())
    <section id="app_wrapper">
      <header id="app_topnavbar-wrapper">
        <nav role="navigation" class="navbar topnavbar">
          <section class="nav-wrapper">
            <ul class="nav navbar-nav pull-right right-menu">
              <li class="app_menu-open">
                <a href="javascript:void(0)" data-toggle-state="app_sidebar-left-open" data-key="leftSideBar">
                  <i class="zmdi zmdi-menu"></i>
                </a>
              </li>
              <!-- Authentication Links -->
              <li><a href="{{ route('login') }}">Login</a></li>
              <li><a href="{{ Route('register.create') }}">Register</a></li>
            </ul>
          </section>
        </nav>
      </header>
      <section id="content_outer_wrapper" style="padding-bottom: 0;">
        <div id="content_wrapper" class="">
          <div id="content" class="container-fluid">
            <div class="content-body">
              @yield('content')
            </div>
          </div>
        </div>
      </section>
    </section>
  @else
    @include('layouts._template')
  @endif


</section>
<script src="{{ asset('js/app.js') }}"></script>

<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-46627904-1', 'authenticgoods.co');
    ga('send', 'pageview');
</script>
<script src="{{ asset('js/layout/vendor.bundle.js') }}"></script>
<script src="{{ asset('js/layout/app.bundle.js') }}"></script>
<script src="{{ asset('js/layout/alerts.js') }}"></script>

@if(Session::has('success'))
  <script>alertify.success("{{ Session::get('status')}}");</script>
@endif

@if(Session::has('warning'))
  <script>alertify.warn("{{ Session::get('status')}}");</script>
@endif

@if(Session::has('error'))
  <script>alertify.error("{{ Session::get('status')}}");</script>
@endif

@if(Session::has('info'))
  <script>alertify.info("{{ Session::get('status')}}");</script>
@endif


@yield('footerJS')
</body>
</html>
