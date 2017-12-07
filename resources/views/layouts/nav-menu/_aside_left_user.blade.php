<aside id="app_sidebar-left">
  <div id="logo_wrapper">
    <ul>
      <li class="logo-icon">
        <a href="{{route('user.dashboard')}}">
          <div class="logo">
            <img src="{{asset('img/logo/holyship-square.png')}}" alt="Logo">
          </div>
          <h1 class="brand-text">Holyship</h1>
        </a>
      </li>
      <li class="menu-icon">
        <a href="javascript:void(0)" role="button" data-toggle-state="app_sidebar-menu-collapsed" data-key="leftSideBar">
          <i class="mdi mdi-backburger"></i>
        </a>
      </li>
    </ul>
  </div>
  <nav id="app_main-menu-wrapper" class="scrollbar">
    <div class="sidebar-inner sidebar-push">
      <ul class="nav nav-pills nav-stacked">
        <li class="sidebar-header">NAVIGATION</li>
        <li class="{{ route::is('user.dashboard') ? 'active' : '' }}">
          <a href="{{route('user.dashboard')}}">
            <i class="zmdi zmdi-view-dashboard"></i>
            {{__('nav_left_menu_client.dashboard')}}
          </a>
        </li>
        <li class="{{ Route::is('user.packages.*') ? 'active' : '' }}">
          <a href="{{Route('user.packages.index')}}">
            <i class="zmdi zmdi-inbox"></i>
            {{__('nav_left_menu_client.packages')}}
          </a>
        </li>

        <li class="{{ Route::is('user.address.*') ? 'active' : '' }}">
          {{--<a href="{{Route('user.address.index')}}">--}}
            {{--<i class="zmdi zmdi-pin"></i>--}}
            {{--{{__('common.titles.address')}}--}}
          {{--</a>--}}
        </li>

      </ul>
    </div>
  </nav>
</aside>