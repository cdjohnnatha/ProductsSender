<template>
    <li class="dropdown">
        <a href="#" class="btn-lg dropdown-toggle" data-toggle="dropdown"
           role="button" aria-expanded="false">
            <span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
            <span class="badge" aria-hidden="true" id="badge">{{unread_notifications}}</span>

        </a>

        <ul class="dropdown-menu" role="menu">
            <li class="dropdown-header">Notifications </li>
            <li role="separator" class="divider"></li>
            <virtual-list role="menu" :size="12" :remain="12"
                              :rclass="'col-sm-12'" :rtag="'li'" :wtag="'li'">
                    <li class="item dropdown-header" v-for="(notify, index) in all_notifications"
                       :key="index">
                        <a v-bind:href="prefixUrl + 'packages/' + notify.id">
                            New package: # {{ notify.id }}
                        </a>
                    </li>
                    <li role="separator" class="divider"></li>
                </virtual-list>
            <li role="separator" class="divider"></li>
            <li class="dropdown-header">
                <a v-bind:href="prefixUrl + 'show-notifications'" id="show-all">
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
            },
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
                    response.data.unread.forEach(notifications => {
                        console.log(notifications.data.package);
                       this.$store.commit('add_notification', notifications.data.package);

                    });
                    this.notificationsBarSize = this.unread_notifications;
                    console.log(this.notificationsBarSize);
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

    #li-sizing{
        padding-right: 8.5em;
        padding-left: 8.5em;
    }
    .li-list{
        font-size: 90%;
    }

    #show-all{
        color: blue;
    }

</style>
