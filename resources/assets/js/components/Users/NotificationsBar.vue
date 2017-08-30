<template>

<section>
  <ul class="scrollbar max-h-250" style="padding-left: 0;">
    <span>
      <li v-for="(notify, index) in all_notifications">
        <div class="card">
          <a href="javascript:void(0)" class="pull-right dismiss" data-dismiss="close">
            <i class="zmdi zmdi-close"></i>
          </a>
          <div class="card-body">
            <ul class="list-group ">
              <li class="list-group-item ">
                <span class="pull-left"><img src="img/profiles/11.jpg" alt="" class="img-circle max-w-40 m-r-10 "></span>
                <div class="list-group-item-body">
                  <div class="list-group-item-heading">{{notify.message.header}}</div>
                  <div class="list-group-item-text">{{notify.message.body}}</div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </li>
    </span>
  </ul>
</section>
</template>
<script>
    export default {
        props: {
            data_id: 0
        },
        data(){
            return {
                prefixUrl: '/user/',
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
                    this.$store.commit('add_notification', e.data);
                    console.log(e);
                });
            },

            unreadNotifications() {
                axios.get(this.prefixUrl + 'unread').then( response => {
                    response.data.unread.forEach(notifications => {
                       this.$store.commit('add_notification', notifications.data);
                       console.log(notifications);
                    });
                    this.notificationsBarSize = this.unread_notifications;
                    if(this.unread_notifications > 0){
                        $('#notification_span').addClass('status danger');
                    }
                }).catch(function (error) {
                    console.log(error);
                });

            },
        }

    }
</script>
<style lang="css">
</style>
