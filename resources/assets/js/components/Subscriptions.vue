<template>

  <section id="lists">
    <div class="columns" v-for="subscription in subscriptions">
      <ul class="price"
          @click="selectSubscription(subscription.id, $event)">
        <li class="header">{{subscription.name}}</li>
        <li class="grey">$ {{subscription.amount}} / month</li>
        <li>1 packet at warehouse per time</li>
        <li>Your address in USA</li>
        <li>Free storage for 30 days</li>
        <li>$2 per box</li>
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
                subscriptions:[],
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

  * {
    box-sizing: border-box;
  }

  /* Create three columns of equal width */
  .columns {
    float: left;
    width: 33.3%;
    padding: 8px;
  }

  /* Style the list */
  .price {
    list-style-type: none;
    border: 1px solid #eee;
    margin: 0;
    padding: 0;
    -webkit-transition: 0.3s;
    transition: 0.3s;
  }

  /* Add shadows on hover */
  .price:hover {
    box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
  }

  .price-selected{
    box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
  }

  /* Pricing header */
  .price .header {
    background-color: #607d8b;
    color: white;
    font-size: 25px;
  }

  .blueBG .header{
    background-color: #3f51b5;
  }

  .greenBG .header{
    background-color: #009688;
  }

  /* List items */
  .price li {
    border-bottom: 1px solid #eee;
    padding: 20px;
    text-align: center;
  }

  /* Grey list item */
  .price .grey {
    background-color: #eee;
    font-size: 20px;
  }

  /* The "Sign Up" button */
  .button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 10px 25px;
    text-align: center;
    text-decoration: none;
    font-size: 18px;
  }

  /* Change the width of the three columns to 100%
  (to stack horizontally on small screens) */
  @media only screen and (max-width: 600px) {
    .columns {
      width: 100%;
    }
  }
</style>
