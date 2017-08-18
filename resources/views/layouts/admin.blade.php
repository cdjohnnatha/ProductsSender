<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiwJ8VLRYRIG_5kUNgNFlELaJTjBWt-Hw&libraries=places"></script>--}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZFQPhIqrB4KK8tY9O0uC0oajn1ZD0xRQ&libraries=places"></script>

    <title>{{ config('app.name', 'Holyship') }}</title>

  <!-- Bootstrap -->
  <link href="{{asset('css/layout/vendor.bundle.css')}}" rel="stylesheet">
  <link href="{{asset('css/layout/app.bundle.css')}}" rel="stylesheet">
  <link href="{{asset('css/layout/theme-a.css')}}" rel="stylesheet">

</head>
<body>
    <div id="app">

      <div id="app_wrapper">
        <header id="app_topnavbar-wrapper">
          <nav role="navigation" class="navbar topnavbar">
            @include('layouts.nav-menu._top_nav')
            <form role="search" action="" class="navbar-form" id="navbar_form">
              <div class="form-group">
                <input type="text" placeholder="Search and press enter..." class="form-control" id="navbar_search" autocomplete="off">
                <i data-navsearch-close class="zmdi zmdi-close close-search"></i>
              </div>
              <button type="submit" class="hidden btn btn-default">Submit</button>
            </form>
          </nav>
        </header>
        @include('layouts.nav-menu._aside_left')
        <section id="content_outer_wrapper" class="">
          <div id="content_wrapper" class="rightnav_v2">
            <div id="header_wrapper" class="header-sm">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12">
                    <header id="header">
                      <h1>
                        @yield('panel_header')
                      </h1>
                    </header>
                  </div>
                </div>
              </div>
              <ul class="card-actions icons lg alt-actions right-top">
                <li>
                  <a href="javascript:void(0)" class="drawer-trigger" data-drawer="toggle-right">
                    <i class="zmdi zmdi-menu"></i>
                  </a>
                </li>
              </ul>
            </div>
            <div class="tabpanel tab-header">
              <ul class="nav nav-tabs p-l-20">
                <li class="active" role="presentation"><a href="#dashboard1" data-toggle="tab">Dashboard v1</a></li>
                <li role="presentation"><a href="#dashboard2" data-toggle="tab">Dashboard v2</a></li>
              </ul>
            </div>
            <div id="content" class="container-fluid">
              <div class="content-body">
                @yield('content')
              </div>
            </div>
            <!-- ENDS $content -->
            @include('layouts.nav-menu._aside_right')
          </div>
          <footer id="footer_wrapper">
            @include('layouts.nav-menu._footer')
          </footer>
        </section>
        <aside id="app_sidebar-right">
          <div class="sidebar-inner sidebar-overlay">
            @include('layouts.nav-menu._tab_aside_right')
          </div>
        </aside>
        <section id="chat_compose_wrapper">
          <div class="tippy-top">
            <div class="recipient">Allison Grayce</div>
            <ul class="card-actions icons  right-top">
              <li>
                <a href="javascript:void(0)">
                  <i class="zmdi zmdi-videocam"></i>
                </a>
              </li>
              <li class="dropdown">
                <a href="javascript:void(0)" data-toggle="dropdown" aria-expanded="false">
                  <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu btn-primary dropdown-menu-right">
                  <li>
                    <a href="javascript:void(0)">Option One</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Option Two</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Option Three</a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="javascript:void(0)" data-chat="close">
                  <i class="zmdi zmdi-close"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class='chat-wrapper scrollbar'>
            <div class='chat-message scrollbar'>
              <div class='chat-message chat-message-recipient'>
                <img class='chat-image chat-image-default' src="{{asset('img/profiles/05.jpg')}}" />
                <div class='chat-message-wrapper'>
                  <div class='chat-message-content'>
                    <p>Hey Mike, we have funding for our new project!</p>
                  </div>
                  <div class='chat-details'>
                    <span class='today small'></span>
                  </div>
                </div>
              </div>
              <div class='chat-message chat-message-sender'>
                <img class='chat-image chat-image-default' src="{{asset('img/profiles/03.jpg')}}" />
                <div class='chat-message-wrapper '>
                  <div class='chat-message-content'>
                    <p>Awesome! Photo booth banh mi pitchfork kickstarter whatever, prism godard ethical 90's cray selvage.</p>
                  </div>
                  <div class='chat-details'>
                    <span class='today small'></span>
                  </div>
                </div>
              </div>
              <div class='chat-message chat-message-recipient'>
                <img class='chat-image chat-image-default' src="{{asset('img/profiles/05.jpg')}}" />
                <div class='chat-message-wrapper'>
                  <div class='chat-message-content'>
                    <p> Artisan glossier vaporware meditation paleo humblebrag forage small batch.</p>
                  </div>
                  <div class='chat-details'>
                    <span class='today small'></span>
                  </div>
                </div>
              </div>
              <div class='chat-message chat-message-sender'>
                <img class='chat-image chat-image-default' src="{{asset('img/profiles/03.jpg')}}" />
                <div class='chat-message-wrapper'>
                  <div class='chat-message-content'>
                    <p>Bushwick letterpress vegan craft beer dreamcatcher kickstarter.</p>
                  </div>
                  <div class='chat-details'>
                    <span class='today small'></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <footer id="compose-footer">
            <form class="form-horizontal compose-form">
              <ul class="card-actions icons left-bottom">
                <li>
                  <a href="javascript:void(0)">
                    <i class="zmdi zmdi-attachment-alt"></i>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="zmdi zmdi-mood"></i>
                  </a>
                </li>
              </ul>
              <div class="form-group m-10 p-l-75 is-empty">
                <div class="input-group">
                  <label class="sr-only">Leave a comment...</label>
                  <input type="text" class="form-control form-rounded input-lightGray" placeholder="Leave a comment..">
                  <span class="input-group-btn">
						<button type="button" class="btn btn-blue btn-fab  btn-fab-sm">
							<i class="zmdi zmdi-mail-send"></i>
						</button>
					</span>
                </div>
              </div>
            </form>
          </footer>
        </section>
      </div>
      <div class="modal fade" id="schedule_modal" tabindex="-1" role="dialog" aria-labelledby="schedule_modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel-2">Title goes here</h4>
            </div>
            <div class="modal-body">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in ligula id sem tristique ultrices eget id neque. Duis enim turpis, tempus at accumsan vitae, lobortis id sapien. Pellentesque nec orci mi, in pharetra ligula. Nulla facilisi. Nulla
                facilisi. Mauris convallis venenatis massa, quis consectetur felis ornare quis. Sed aliquet nunc ac ante molestie ultricies. Nam pulvinar ultricies bibendum.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-success">Ok</button>
            </div>
          </div>
          <!-- modal-content -->
        </div>
        <!-- modal-dialog -->
      </div>
    </div>
    <!-- Scripts -->


    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
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
</body>
</html>
