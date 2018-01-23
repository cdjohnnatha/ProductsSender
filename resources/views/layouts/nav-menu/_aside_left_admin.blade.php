<aside id="app_sidebar-left">
  <div id="logo_wrapper">
    <ul>
      <li class="logo-icon">
        <a href="{{ route('admin.dashboard') }}">
          <div class="logo">
            <img src="{{ asset('img/logo/holyship-square.png') }}" alt="Logo">
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

        <li class="{{ Route::is('admin.index') ? 'active' : '' }}">
          <a href="{{ Route('admin.index') }}">
            <i class="zmdi zmdi-city"></i>
            @lang('nav_left_menu_adm.admins')
          </a>
        </li>

        <li class="{{ Route::is('admin.companies.*') ? 'active' : '' }}">
          <a href="{{ Route('admin.companies.index') }}">
            <i class="zmdi zmdi-city"></i>
            @lang('nav_left_menu_adm.companies')
          </a>
        </li>

        <li class="{{ Route::is('admin.packages.*') ? 'active' : '' }}">
          <a href="{{ Route('admin.packages.index') }}">
            <i class="zmdi zmdi-city"></i>
            @lang('nav_left_menu_adm.packages')
          </a>
        </li>
      </ul>
    </div>
  </nav>
</aside>