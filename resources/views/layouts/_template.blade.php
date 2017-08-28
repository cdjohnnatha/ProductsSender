<section id="app_wrapper">
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
    @if(auth()->guard('web')->user())
        @include('layouts.nav-menu._aside_left_user')
    @elseif(auth()->guard('admin')->user())
        @include('layouts.nav-menu._aside_left_admin')
    @endif
    <section id="content_outer_wrapper" style="padding-bottom: 0;">
        <div id="content_wrapper">
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
            </div>
            <div id="content" class="container-fluid">
                <div class="content-body">
                    @yield('content')
                </div>
            </div>
            <!-- ENDS $content -->
        </div>
    </section>
    <aside id="app_sidebar-right">
        <div class="sidebar-inner sidebar-overlay">
            @include('layouts.nav-menu._tab_aside_right')
        </div>
    </aside>
    <section id="chat_compose_wrapper">
        @include('layouts.nav-menu._chat_wrapper')
    </section>
</section>

