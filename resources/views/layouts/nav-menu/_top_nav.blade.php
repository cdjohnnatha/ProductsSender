<section class="nav-wrapper">
    <ul class="nav navbar-nav pull-left left-menu">
        <li class="app_menu-open">
            <a href="javascript:void(0)" data-toggle-state="app_sidebar-left-open" data-key="leftSideBar">
                <i class="zmdi zmdi-menu"></i>
            </a>
        </li>
    </ul>
    <ul class="nav navbar-nav left-menu hidden-xs">
        <li>
            <a href="javascript:void(0)" class="nav-link">
                <span>Home</span>
            </a>
        </li>
        <li class="dropdown dropdown-lg app_menu_launcher hidden-xs">
            <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown" aria-expanded="false">
                <span>Dropdown</span>
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu dropdown-lg-menu dropdown-menu-left btn-primary p-15 text-center">
                <li>
                    <ul>
                        <li><a href="app-mail.html"><i class="zmdi zmdi-email"></i><span>Mail</span></a></li>
                        <li><a href="javascript:void(0)"><i class="zmdi zmdi-accounts-list"></i><span>Contacts</span></a></li>
                        <li><a href="javascript:void(0)"><i class="zmdi zmdi-comment-text"></i><span>Chat</span></a></li>
                    </ul>
                </li>
                <li>
                    <ul>
                        <li><a href="app-notes.html"><i class="mdi mdi-lightbulb"></i><span>Notes</span></a></li>
                        <li><a href="app-taskboard.html"><i class="zmdi zmdi-view-column"></i><span>Taskboard</span></a></li>
                        <li><a href="javascript:void(0)"><i class="zmdi zmdi-calendar-note"></i><span>Calendar</span></a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="dropdown mega">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link" aria-expanded="false">
                <span>Mega</span>
                <span class="caret"></span>
            </a>
            <div class="dropdown-menu full-width p-l-10">
                <div class="row">
                    <div class="col-xs-22 col-sm-2 col-md-4">
                        <h3>Pages <span class="badge status info">10</span></h3>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <ul>
                                    <li>
                                        <a href="page-profile.html" class="btn-primary-hover"><i class="zmdi zmdi-chevron-right m-r-5"></i> Profile</a>
                                    </li>
                                    <li>
                                        <a href="page-invoice.html" class="btn-primary-hover"><i class="zmdi zmdi-chevron-right m-r-5"></i>  Invoice</a>
                                    </li>
                                    <li>
                                        <a href="page-timeline.html" class="btn-primary-hover"><i class="zmdi zmdi-chevron-right m-r-5"></i>  Timeline</a>
                                    </li>
                                    <li>
                                        <a href="page-locations.html" class="btn-primary-hover"><i class="zmdi zmdi-chevron-right m-r-5"></i>  Locations</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <ul>
                                    <li>
                                        <a href="page-pricing-tables.html" class="btn-primary-hover"><i class="zmdi zmdi-chevron-right m-r-5"></i>  Pricing Tables</a>
                                    </li>
                                    <li>
                                        <a href="page-gallery.html" class="btn-primary-hover"><i class="zmdi zmdi-chevron-right m-r-5"></i>  Gallery</a>
                                    </li>
                                    <li>
                                        <a href="login.html" class="btn-primary-hover"><i class="zmdi zmdi-chevron-right m-r-5"></i>  Login</a>
                                    </li>
                                    <li>
                                        <a href="lock-screen.html" class="btn-primary-hover"><i class="zmdi zmdi-chevron-right m-r-5"></i>  Lock Screen</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-10 col-md-8">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <h3 class="p-t-15 p-b-15">New Arrivals</h3>
                            <div class="col-xs-12">
                                <div id="new_arrivals_megamenu" class="row">
                                    <div><img src="{{asset('img/ecom/products/39_Ie8T.jpeg')}}" class="col-sm-6 col-md-4 max-h-200" alt=""></div>
                                    <div><img src="{{asset('img/ecom/products/39_8wMD.jpeg')}}" class="col-sm-6 col-md-4 max-h-200" alt=""></div>
                                    <div><img src="{{asset('img/ecom/products/39_JnFC.jpeg')}}" class="col-sm-6 col-md-4 max-h-200" alt=""></div>
                                    <div><img src="{{asset('img/ecom/products/2830_S4ql.jpeg')}}" class="col-sm-6 col-md-4 max-h-200" alt=""></div>
                                    <div><img src="{{asset('img/ecom/products/4107_PPxC.jpeg')}}" class="col-sm-6 col-md-4 max-h-200" alt=""></div>
                                    <div><img src="{{asset('img/ecom/products/5764_YK7g.jpeg')}}" class="col-sm-6 col-md-4 max-h-200" alt=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <h3 class="p-t-15 p-b-15">Today's Analysis</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="ct-chart ct-golden-section " id="chartist_megaMenu"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
    <ul class="nav navbar-nav pull-right">
        <li class="dropdown avatar-menu">
            <a href="javascript:void(0)" data-toggle="dropdown" aria-expanded="false">
								<span class="meta">
									<span class="avatar">
										<img src="{{asset('img/logo/holyship-circle.png')}}" alt="" class="img-circle max-w-35">
										<i class="badge mini success status"></i>
									</span>
									<span class="name">{{Auth::user()->name}}</span>
									<span class="caret"></span>
								</span>
            </a>
            <ul class="dropdown-menu btn-primary dropdown-menu-right">
                <li>
                    <a href="page-profile.html"><i class="zmdi zmdi-account"></i> Profile</a>
                </li>
                <li>
                    <a href="app-mail.html"><i class="zmdi zmdi-email"></i> Messages</a>
                </li>
                <li>
                    <a href="javascript:void(0)"><i class="zmdi zmdi-settings"></i> Account Settings</a>
                </li>
                <li>
                    <a href="{{Route('logout')}}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        <i class="zmdi zmdi-sign-in"></i> Sign Out
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            {{ csrf_field() }}
                        </form>
                    </a>
                </li>
            </ul>
        </li>
        <li class="select-menu hidden-xs hidden-sm">
            <select class="select form-control country" style="display:none">
                <option option="EN">English</option>
            </select>
        </li>
        <li>
            <a href="javascript:void(0)" data-navsearch-open>
                <i class="zmdi zmdi-search"></i>
            </a>
        </li>
        @include('layouts.nav-menu._notifications')
        <li class="last">
            <a href="javascript:void(0)" data-toggle-state="sidebar-overlay-open" data-key="rightSideBar">
                <i class="mdi mdi-playlist-plus"></i>
            </a>
        </li>
    </ul>
</section>