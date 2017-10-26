<template>

  <section>
    <div class="col-xs-12 col-sm-12">
      <div class="card">
        <header class="card-heading ">
          <h2 class="card-title">Shipments</h2>
        </header>
        <div class="card-body" >
          <div class="list-group m-t-40">
            <div class="list-group-item" v-for="rate in rates">
              <div class="row-content">
                <div class="least-content">
                  <span class="checkbox">
                    <label>
                      <input type="radio" v-bind:value="rate.amount" name="optionsRadios" class="shipment_value" checked>
                    </label>
                  </span>
                </div>
                <img v-bind:src="rate.provider_image_75" alt="">
                <div class="table-responsive">
                  <table class="table">
                    <caption>Optional table caption.</caption>
                    <thead>
                    <tr>
                      <th>Type</th>
                      <th>Amount {{rate.currency}}</th>
                      <th>Amount {{rate.currency_local}}</th>
                      <th>Days</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>{{rate.provider}}</td>
                      <td>{{rate.amount}}</td>
                      <td>{{rate.amount_local}}</td>
                      <td>{{rate.days}}</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

</template>

<script>
  var $ = require('jquery');
    export default {
        props: {

        },
        data(){
            return {
              total: 0,
              rates: {},

            }
        },

        created() {
            this.getRates();
        },

        methods: {
            getRates(){
              var address = $('#address_id').val();
              var packages = $('#package_id').val();
              var json = {
                'address': address,
                'package': packages
              };
              console.log(json);
              axios.post('/user/shipment/shipment-rates', json, {headers: ''}).then( response => {
                this.rates = response.data.rates;
              }).catch(function (error) {
                  console.log(error);
              });
            }

        },
        computed:{
            clearanceJson(){
                return JSON.stringify(this.customClearances);
            },
        }

    }
</script>

<style lang="css">

</style>
