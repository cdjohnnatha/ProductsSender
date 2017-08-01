<template>
    <section class="container col-sm-offset-1">
        <div class="col-sm-11 col-sm-offset-1">
            <section class="panel">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Your Notifications</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="unreadNotifications.length > 0"
                            v-for="unread in unreadNotifications" class="success"
                            @click="showPackage(unread.data.package.id)">
                            <td>You have a new package #{{unread.data.package.id}}</td>
                            <th>Changed at #{{unread.data.package.created_at}}</th>
                        </tr>
                        <tr v-for="notification in notifications"
                            @click="showPackage(notification.data.package.id)">
                            <td>You have a new package #{{notification.data.package.id}}</td>
                            <th>Changed at #{{notification.data.package.created_at}}</th>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
    </section>
</template>

<script>
    export default {
        props: {
            user_id: 0
        },
        data() {
            return {
                prefixUrl: '/user/' + this.user_id + '/',
                notifications: [],
                unreadNotifications:[],
            }
        },

        created() {
            this.getNotifications();
            this.markAllAsRead();
        },

        methods:{
            getNotifications(){
                axios.get(this.prefixUrl + 'notifications').then( response => {
                    this.notifications = response.data.notifications;
                    this.unreadNotifications = response.data.unreadNotifications;
                }).catch(function (error) {
                    console.log(error);
                });
            },

            markAllAsRead(){
                axios.get(this.prefixUrl + 'mark-read').then( response => {
                   console.log('readed');
                }).catch(function (error) {
                    console.log(error);
                });
            },

            showPackage(id){
                window.location.href = this.prefixUrl + 'packages/'+id;
                console.log(id);
            }

        },
    }
</script>

<style lang="css">
    table tr{
        cursor: pointer;
    }
</style>
