<link href="{{asset('css/_lateral_nav_admin.css')}}" rel="stylesheet" >

<nav id="aside-menu">
    <ul class="nav">
        <li>
            <a href="#" id="btn-1" data-toggle="collapse" data-target="#admin-menu"
               aria-expanded="false">
                <label>Admin</label>

            </a>
            <ul class="nav collapse col-sm-offset-1" id="admin-menu" role="menu" aria-labelledby="btn-1">
                <li>
                    <a href="{{route('admin.create')}}">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        New
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.index')}}">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        List
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#" id="btn-users" data-toggle="collapse" data-target="#users-menu"
               aria-expanded="false">
                <label>Users</label>
            </a>
            <ul class="nav collapse col-sm-offset-1" id="users-menu" role="menu" aria-labelledby="btn-1">
                <li>
                    <a href="{{route('admin.users.create')}}">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        New
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.users.index')}}">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        List
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" id="btn-2" data-toggle="collapse" data-target="#warehouse-menu"
               aria-expanded="false">
                <label>Warehouses</label>
            </a>
            <ul class="nav collapse col-sm-offset-1" id="warehouse-menu" role="menu" aria-labelledby="btn-1">
                <li>
                    <a href="{{route('admin.warehouses.create')}}">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        New
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.warehouses.index')}}">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        List
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#" id="btn-subscription" data-toggle="collapse" data-target="#subscriptions-menu"
               aria-expanded="false">
                <label>Plans</label>
            </a>
            <ul class="nav collapse col-sm-offset-1" id="subscriptions-menu" role="menu" aria-labelledby="btn-1">
                <li id="create-subscription">
                    <a href="{{route('admin.subscriptions.create')}}">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        New
                    </a>
                </li>
                <li id="list-subscriptions">
                    <a href="{{route('admin.subscriptions.index')}}">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        List
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#" id="btn-package" data-toggle="collapse" data-target="#packages-menu"
               aria-expanded="false">
                <label>Packages</label>
            </a>
            <ul class="nav collapse col-sm-offset-1" id="packages-menu" role="menu" aria-labelledby="btn-1">
                <li id="create-package">
                    <a href="{{route('admin.packages.create')}}">
                        <span class="glyphicon glyphicon-plus-sign"></span>
                        New
                    </a>
                </li>
                <li id="informed-packages">
                    <a href="/admin/packages/show-list">
                        <span class="glyphicon glyphicon-exclamation-sign"></span>
                        Informed
                    </a>
                </li>
                <li id="list-packages">
                    <a href="{{route('admin.packages.index')}}">
                        <span class="glyphicon glyphicon-align-justify"></span>
                        List
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</nav>