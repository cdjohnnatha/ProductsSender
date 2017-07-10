<template>
    <nav id="aside-menu">
        <ul class="nav">
            <li>
                <a href="#" id="btn-1" data-toggle="collapse" data-target="#admin-menu"
                   aria-expanded="false">
                    <label>Admin</label>

                </a>
                <ul class="nav collapse col-sm-offset-1" id="admin-menu" role="menu" aria-labelledby="btn-1">
                    <li><a href="/admin/form">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        New</a>
                    </li>
                    <li><a href="/admin/show-list">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        List</a></li>
                </ul>
            </li>
            <li><a href="/admin/users">Users</a></li>
            <li>
                <a href="#" id="btn-2" data-toggle="collapse" data-target="#warehouse-menu"
                   aria-expanded="false">
                    <label>Warehouses</label>
                </a>
                <ul class="nav collapse col-sm-offset-1" id="warehouse-menu" role="menu" aria-labelledby="btn-1">
                    <li><a href="/admin/warehouses/create">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        New</a>
                    </li>
                    <li><a href="/admin/warehouses/show-list">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        List</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</template>
<script>
    export default {


    }
</script>

<style lang="css">
    #aside-menu{
        width: 15%;
        z-index: 1;
        position: fixed;
        padding-top: 60px;
        top: 0;
        bottom: 0;
        background-color: white;
    }

    #aside-menu a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        color: #818181;
        display: block;
        transition: 0.3s
    }

    #admin-menu li{
        font-size: .9em;
    }

</style>
