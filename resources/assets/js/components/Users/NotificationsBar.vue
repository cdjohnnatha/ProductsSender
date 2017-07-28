<template>
    <li class="dropdown">
        <a href="#" class="btn-lg dropdown-toggle" data-toggle="dropdown"
           role="button" aria-expanded="false">
            <span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
            <span class="badge" aria-hidden="true" id="badge">{{unread_notifications}}</span>

        </a>

        <ul class="dropdown-menu" role="menu">
            <li class="dropdown-header">Notifications </li>
            <li v-for="notify in all_notifications">
                <a v-bind:href="prefixUrl + 'packages/' + notify.id">
                    You have a new package name
                    <label>#{{notify.id}}</label>
                </a>
            </li>
            <li role="separator" class="divider"></li>
            <li>
                <a v-bind:href="prefixUrl + 'show-notifications'" class="dropdown-header" id="show-all">
                    Show all
                </a>
            </li>
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
        },
        mounted(){
            this.listen();
            this.unreadNotifications();
        },
        computed:{
            unread_notifications(){
                return this.$store.getters.notifications_length;
            },

            all_notifications(){
                return this.$store.getters.all_notifications;
            }
        },

        methods: {
            listen(){
                window.Echo.private('App.User.' + this.data_id)
                .listen('PackageNotification', (e) => {
                    this.$store.commit('add_notification', e);
                });
            },

            unreadNotifications() {
                axios.get(this.prefixUrl + 'unread').then( response => {
//                    console.log(response.data.unread);
                    response.data.unread.forEach(notifications => {
                        console.log(notifications.data.package);
                       this.$store.commit('add_notification', notifications.data.package);

                    });
                }).catch(function (error) {
                    console.log(error);
                });
            },



        }

    }
</script>

<style lang="css">
    #badge{
        font-size: 60%;
        position:absolute;
        top: .6em;
        right: .3em;
        z-index: 99;
    }


    #show-all{
        color: blue;
    }

</style>
