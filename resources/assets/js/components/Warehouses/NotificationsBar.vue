<template>

  <section>
    <ul class="scrollbar max-h-250" style="padding-left: 0;">
    <span>
      <li v-for="(notify, index) in all_notifications">
        <div class="card">
          <a href="javascript:void(0)" class="pull-right dismiss" data-dismiss="close" @click="dismiss(index, notify)">
            <i class="zmdi zmdi-close"></i>
          </a>
          <div class="card-body" @click="showPackage(notify)">
            <ul class="list-group ">
              <li class="list-group-item ">
                <div class="list-group-item-body">
                  <div class="list-group-item-heading">{{notify.data.incomingPackage.track_number}}</div>
                  <div class="list-group-item-text">{{notify.data.incomingPackage.addressee}}</div>
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
        data() {
            return {}
        },
        mounted() {
            this.listen();
            this.unreadNotifications();
        },
        computed: {
            unread_notifications() {
                return this.$store.getters.notifications_length;
            },

            all_notifications() {
                return this.$store.getters.all_notifications;
            },
        },

        methods: {
            listen() {
                window.Echo.private('App.CompanyWarehouse.' + this.data_id)
                    .notification((notification) => {
                        this.$store.commit('add_notification', notification);
                        this.addAlertStatus();
                        console.log(notification);
                    });
            },

            unreadNotifications() {
                axios.get('/admin/warehouse-notifications/unread').then(response => {
                    response.data.unread.forEach(notifications => {
                        this.$store.commit('add_notification', notifications);
                        console.log(notifications);
                        this.addAlertStatus();
                    });
                }).catch(function (error) {
                    console.log(error);
                });

            },

            addAlertStatus() {
                this.notificationsBarSize = this.unread_notifications;
                if (this.unread_notifications > 0) {
                    $('#notification_span').addClass('status danger');
                }
            },

            showPackage(package_id) {
                console.log(package_id.id);
                axios.patch('/user/notifications/' + package_id.id).then(response => {});
                window.location = '/user/packages/' + package_id.data.package;
            },

            dismiss(index, notify) {
                axios.patch('/user/notifications/' + notify.id).then(response => {
                    this.$store.commit('rvm_notification', index);
                });
            },
        }

    }
</script>
<style lang="css">
</style>
