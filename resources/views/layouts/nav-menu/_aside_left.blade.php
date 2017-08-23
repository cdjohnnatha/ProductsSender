<aside id="app_sidebar-left">
  <div id="logo_wrapper">
    <ul>
      <li class="logo-icon">
        <a href="index.html">
          <div class="logo">
            <img src="{{asset('img/holyship-logo.jpg')}}" alt="Logo">
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
        <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
          <a href="{{route('admin.dashboard')}}">
            <i class="zmdi zmdi-view-dashboard"></i>
            {{__('admin.panel.dashboard')}}
          </a>
        </li>
        <li class="{{ Route::is('admin.index') ? 'active' : '' }}">
          <a href="{{Route('admin.index')}}"><i class="zmdi zmdi-ticket-star"></i>
            {{__('admin.panel.admin.label')}}
          </a>
        </li>
        <li class="{{ Route::is('admin.warehouses.*') ? 'active' : '' }}">
          <a href="{{Route('admin.warehouses.index')}}"><i class="zmdi zmdi-store"></i>
            {{__('admin.panel.warehouses.label')}}
          </a>
        </li>
        <li class="{{ Route::is('admin.packages.*') ? 'active' : '' }}">
          <a href="{{Route('admin.packages.index')}}">
            <i class="zmdi zmdi-inbox"></i>
            {{__('admin.panel.packages.label')}}
          </a>
        </li>

        <li class="{{ Route::is('admin.subscriptions.*') ? 'active' : '' }}">
          <a href="{{Route('admin.subscriptions.index')}}"><i class="zmdi zmdi-money"></i>
            {{__('admin.panel.subscriptions.label')}}
          </a>
        </li>
      </ul>
    </div>
  </nav>
</aside>