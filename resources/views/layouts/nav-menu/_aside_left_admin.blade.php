<aside id="app_sidebar-left">
  <div id="logo_wrapper">
    <ul>
      <li class="logo-icon">
        <a href="{{route('admin.dashboard')}}">
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
        {{--<li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">--}}
          {{--<a href="{{route('admin.dashboard')}}">--}}
            {{--<i class="zmdi zmdi-view-dashboard"></i>--}}
            {{--{{__('common.titles.dashboard')}}--}}
          {{--</a>--}}
        {{--</li>--}}
        {{--<li class="{{ Route::is('admin.index') ? 'active' : '' }}">--}}
          {{--<a href="{{Route('admin.index')}}"><i class="zmdi zmdi-ticket-star"></i>--}}
            {{--{{__('common.titles.admin')}}--}}
          {{--</a>--}}
        {{--</li>--}}

        {{--<li class="{{ Route::is('admin.users.*') ? 'active' : '' }}">--}}
          {{--<a href="{{Route('admin.users.index')}}"><i class="zmdi zmdi-accounts"></i>--}}
            {{--{{__('common.titles.users')}}--}}
          {{--</a>--}}
        {{--</li>--}}

        <li class="{{ Route::is('admin.company-warehouses.*') ? 'active' : '' }}">
          <a href="{{Route('admin.company-warehouses.index')}}"><i class="zmdi zmdi-store"></i>
            {{__('company_warehouse')}}
          </a>
        </li>
        {{--<li class="{{ Route::is('admin.packages.*') ? 'active' : '' }}">--}}
          {{--<a href="{{Route('admin.packages.index')}}">--}}
            {{--<i class="zmdi zmdi-shopping-basket"></i>--}}
            {{--{{__('common.titles.package')}}--}}
          {{--</a>--}}
        {{--</li>--}}


        {{--<li class="{{ Route::is('admin.services.*') ? 'active' : '' }}">--}}
          {{--<a href="{{Route('admin.services.index')}}"><i class="zmdi zmdi-tag"></i>--}}
            {{--{{__('common.titles.services')}}--}}
          {{--</a>--}}
        {{--</li>--}}

      </ul>
    </div>
  </nav>
</aside>