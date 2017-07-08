<template>
    <nav id="aside-menu">
        <ul class="nav">
            <li><a href="#" id="btn-1" data-toggle="collapse" data-target="#submenu1"
                   aria-expanded="false">Admin</a>
                <ul class="nav collapse" id="submenu1" role="menu" aria-labelledby="btn-1">
                    <li><a href="/admin/form">New Admin</a></li>
                    <li><a href="#">Link 2.2</a></li>
                    <li><a href="#">Link 2.3</a></li>
                </ul>
            </li>
            <li><a href="/admin/users">Users</a></li>
            <li><a href="#">Warehouses</a></li>
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

</style>
