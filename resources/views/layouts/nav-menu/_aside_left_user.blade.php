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
    </ul>
  </div>
  <nav id="app_main-menu-wrapper" class="scrollbar">
    <div class="sidebar-inner sidebar-push">
      <ul class="nav nav-pills nav-stacked">
        <li class="sidebar-header">NAVIGATION</li>
        <li class="{{ Route::is('user.dashboard') ? 'active' : '' }}">
          <a href="{{ Route('user.dashboard') }}">
            <i class="zmdi zmdi-view-dashboard"></i>
            @lang('nav_left_menu_client.dashboard')
          </a>
        </li>
        <li class="{{ Route::is('user.packages.*') ? 'active' : '' }}">
          <a href="{{ Route('user.packages.index') }}">
            <i class="zmdi zmdi-inbox"></i>
            @lang('nav_left_menu_client.packages')
          </a>
        </li>

        <li class="{{ Route::is('user.addresses.*') ? 'active' : '' }}">
          <a href="{{ Route('user.addresses.index') }}">
            <i class="zmdi zmdi-pin"></i>
            @lang('nav_left_menu_client.address')
          </a>
        </li>

        <li class="{{ Route::is('user.invoices.*') ? 'active' : '' }}">
          <a href="{{ Route('user.invoices.index') }}">
            <i class="zmdi zmdi-money"></i>
            @lang('nav_left_menu_client.invoices')
          </a>
        </li>

        <li class="{{ Route::is('user.payment_transactions.*') ? 'active' : '' }}">
          <a href="{{ Route('user.payment_transactions.index') }}">
            <i class="zmdi zmdi-balance-wallet"></i>
            @lang('nav_left_menu_client.transactions')
          </a>
        </li>
      </ul>
    </div>
  </nav>
</aside>