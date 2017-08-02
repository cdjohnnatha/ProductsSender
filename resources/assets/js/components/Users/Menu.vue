<template>
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
                        <a v-bind:href="prefixUrl + 'packages/inform'">
                            <span class="glyphicon glyphicon-menu-right"></span>
                            New
                        </a>
                    </li>
                    <li id="create-one">
                        <a v-bind:href="prefixUrl">
                        <span class="glyphicon glyphicon-menu-right"></span>
                        Select
                    </a>
                    </li>
                    <li id="join-many">
                        <a v-bind:href="prefixUrl">
                            <span class="glyphicon glyphicon-menu-right"></span>
                            Join
                        </a>
                    </li>
                    <li id="list">
                        <a v-bind:href="prefixUrl + 'packages/show-list'">
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
                        <a v-bind:href="prefixUrl">
                            <span class="glyphicon glyphicon-menu-right"></span>
                            Perfil
                        </a>
                    </li>
                    <li id="list-subscriptions">
                        <a v-bind:href="prefixUrl">
                            <span class="glyphicon glyphicon-menu-right"></span>
                            Addresses
                        </a>
                    </li>
                    <li>
                        <a v-bind:href="prefixUrl + 'additional-names'">
                            <span class="glyphicon glyphicon-menu-right"></span>
                            Additional Names
                        </a>
                    </li>
                    <li>
                        <a v-bind:href="prefixUrl">
                            <span class="glyphicon glyphicon-menu-right"></span>
                            Preferences
                        </a>
                    </li>
                    <li>
                        <a v-bind:href="prefixUrl">
                            <span class="glyphicon glyphicon-menu-right"></span>
                            Settings
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</template>
<script>
    export default {
        props: {
            data_id: 0
        },
        data(){
            return {
                prefixUrl: '/user/' + this.data_id + '/' ,
            }
        }

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
