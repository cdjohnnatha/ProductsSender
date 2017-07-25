<template>
    <li class="dropdown">
        <a href="#" class="btn-lg dropdown-toggle" data-toggle="dropdown"
           role="button" aria-expanded="false">
            <span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li class="dropdown-header">Notifications </li>
            <li><a href="">Actions</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="" class="dropdown-header">Show all</a></li>
        </ul>
    </li>
</template>
<script>
    export default {
        props: {
            data_id: 0
        },
        data(){
            return {
                prefixUrl: '/home/' + this.data_id + '/' ,
            }
        }

    }
</script>

<style lang="css">


</style>
