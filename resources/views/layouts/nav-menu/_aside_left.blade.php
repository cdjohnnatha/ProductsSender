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
        <li class="active"><a href="index.html"><i class="zmdi zmdi-view-dashboard"></i>Dashboard</a></li>
        <li class="nav-dropdown">
          <a href="#"><i class="zmdi zmdi-ticket-star"></i>Admins</a>
          <ul class="nav-sub">
            <li><a href="{{route('admin.index')}}"> List of Adm</a></li>
            <li><a href="{{route('admin.create')}}">Create new admin</a></li>
          </ul>
        </li>
        <li class="nav-dropdown"><a href="#"><i class="zmdi zmdi-store"></i>Warehouses</a>
          <ul class="nav-sub">
            <li><a href="{{Route('admin.warehouses.index')}}">List warehouses</a></li>
            <li><a href="{{Route('admin.warehouses.create')}}">Register new warehouse</a></li>
            <li><a href="card-demos.html">Card Demos</a></li>
          </ul>
        </li>
        <li class="nav-dropdown"><a href="#"><i class="zmdi zmdi-inbox"></i>Packages</a>
          <ul class="nav-sub">
            <li><a href="{{Route('admin.packages.index')}}">Packages on warehouse</a></li>
            <li><a href="{{Route('admin.packages.create')}}">Register new package</a></li>
            <li><a href="charts-chartjs.html">Chartjs</a></li>
            <li><a href="charts-morrisjs.html">Morris.js Charts</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</aside>