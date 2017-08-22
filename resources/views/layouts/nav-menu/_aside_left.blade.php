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
        <li class="nav-dropdown {{ Route::is('admin.index') || Route::is('admin.create') ? 'active open' : '' }}">
          <a href="#"><i class="zmdi zmdi-ticket-star"></i>
            {{__('admin.panel.admin.label')}}
          </a>
          <ul class="nav-sub">
            <li class="{{ Route::is('admin.index') ? 'active' : '' }}"><a href="{{Route('admin.index')}}">{{__('admin.panel.admin.list')}}</a></li>
            <li class="{{ Route::is('admin.create') ? 'active' : '' }}">
              <a href="{{Route('admin.create')}}">
                {{__('admin.panel.admin.create')}}
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-dropdown {{ Route::is('admin.warehouses.*') ? 'active open' : '' }}">
          <a href="#"><i class="zmdi zmdi-store"></i>
            {{__('admin.panel.warehouses.label')}}
          </a>
          <ul class="nav-sub">
            <li class="{{ Route::is('admin.warehouses.index') ? 'active' : ''}}">
              <a href="{{Route('admin.warehouses.index')}}">
                {{__('admin.panel.warehouses.list')}}
              </a>
            </li>
            <li class="{{ Route::is('admin.warehouses.create') ? 'active' : ''}}">
              <a href="{{Route('admin.warehouses.create')}}">
                {{__('admin.panel.warehouses.create')}}
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-dropdown {{ Route::is('admin.packages.*') ? 'active open' : '' }}">
          <a href="#">
            <i class="zmdi zmdi-inbox"></i>
            {{__('admin.panel.packages.label')}}
          </a>
          <ul class="nav-sub">
            <li class="{{ Route::is('admin.packages.index') ? 'active' : '' }}">
              <a href="{{Route('admin.packages.index')}}">
                {{__('admin.panel.packages.list')}}
              </a>
            </li>
            <li class="{{ Route::is('admin.packages.create') ? 'active' : '' }}">
              <a href="{{Route('admin.packages.create')}}">
                {{__('admin.panel.packages.create')}}
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-dropdown {{ Route::is('admin.subscriptions.*') ? 'active open' : '' }}">
          <a href="#"><i class="zmdi zmdi-money"></i>
            {{__('admin.panel.subscriptions.label')}}
          </a>
          <ul class="nav-sub">
            <li class="{{ Route::is('admin.subscriptions.index') ? 'active' : '' }}">
              <a href="{{Route('admin.subscriptions.index')}}">
                {{__('admin.panel.subscriptions.list')}}
              </a>
            </li>
            <li class="{{ Route::is('admin.subscriptions.create') ? 'active' : '' }}">
              <a href="{{Route('admin.subscriptions.create')}}">
                {{__('admin.panel.subscriptions.create')}}
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</aside>