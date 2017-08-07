<template>

  <section id="lists">
    <div class="columns" v-for="(subscription, index) in subscriptions">
      <ul class="price"
          @click="selectSubscription(subscription.id, $event)">
        <li class="header">{{subscription.title}}</li>
        <li class="grey">$ {{subscription.amount}} / month</li>
        <li v-for="benefit in subscriptions[index].benefits">{{benefit.message}}</li>
        <li class="grey">
            <input type="hidden" name="subscription_id" v-bind:value="subscription.id">
        </li>
      </ul>
    </div>
  </section>

</template>

<script>
    export default {
        data() {
            return {
                isActive: true,
                subscriptions:{
                    id: '',
                    title: '',
                    amount: '',
                    benefits: [ { message: ''} ]
                },
                selectedId: 0
            }
        },

        created() {
            axios.get('/register/subscriptions').then( response => {
              this.subscriptions = response.data.subscriptions;
            });
        },
        methods: {
            selectSubscription(id, event) {
              $('#lists').find('.columns').find('ul').each(function(){
                if($(this).hasClass('price-selected')){
                    $(this).removeClass('price-selected');
                }
              });
              this.isActive = false;
              $(event.currentTarget).addClass('price-selected');
              this.selectedId = id;
              this.register();
              this.subscribe();
            },

            register(){
                //Used in UserRegisterComponent
                this.$emit('allowRegister', false);
            },

            subscribe(){
                this.$emit('subscription', this.selectedId);
            }
        }
    }
</script>

<style lang="css">

</style>
