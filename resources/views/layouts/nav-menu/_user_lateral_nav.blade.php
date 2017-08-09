<link href="{{asset('css/_lateral_nav_admin.css')}}" rel="stylesheet" >

<nav id="aside-menu">
    <ul class="nav">
        <li>
            <a href="#" id="packagesLabel" data-toggle="collapse" data-target="#packages-menu"
               aria-expanded="false">
                <label>
                    <span class="glyphicon glyphicon-gift"></span>
                    Packages
                </label>
            </a>
            <ul class="nav collapse col-sm-offset-1" id="packages-menu" role="menu" aria-labelledby="packagesLabel">
                <li id="new-one">
                    <a href="{{route('user.dashboard', Auth::user()->id)}}">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        New
                    </a>
                </li>
                <li id="create-one">
                    <a href="{{route('user.dashboard', Auth::user()->id)}}">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        Select
                    </a>
                </li>
                <li id="join-many">
                    <a href="{{route('user.dashboard', Auth::user()->id)}}">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        Join
                    </a>
                </li>
                <li id="list">
                    <a href="{{route('user.dashboard', Auth::user()->id)}}">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        List
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#" id="btn-subscription" data-toggle="collapse" data-target="#user-menu"
               aria-expanded="false">
                <label>
                    <span class="glyphicon glyphicon-user"></span>
                    User
                </label>
            </a>
            <ul class="nav collapse col-sm-offset-1" id="user-menu" role="menu" aria-labelledby="btn-1">
                <li id="create-subscription">
                    <a href="{{route('user.dashboard', Auth::user()->id)}}">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        Perfil
                    </a>
                </li>
                <li id="list-subscriptions">
                    <a href="{{route('user.dashboard', Auth::user()->id)}}">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        Addresses
                    </a>
                </li>
                <li>
                    <a href="{{route('user.dashboard', Auth::user()->id)}}">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        Additional Names
                    </a>
                </li>
                <li>
                    <a href="{{route('user.dashboard', Auth::user()->id)}}">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        Preferences
                    </a>
                </li>
                <li>
                    <a href="{{route('user.dashboard', Auth::user()->id)}}">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        Settings
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>