<template>
  <section>
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

    <section>
      <div class="modal fade" id="basic_modal" tabindex="-1" role="dialog" aria-labelledby="basic_modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">

              <h4 class="modal-title" id="myModalLabel-2">Change your address just clicking</h4>
              <ul class="card-actions icons right-top">
                <li>
                  <a href="javascript:void(0)" data-dismiss="modal" class="text-white" aria-label="Close">
                    <i class="zmdi zmdi-close"></i>
                  </a>
                </li>
              </ul>
            </div>
            <div class="modal-body">
              <section v-for="address in addresses" >
                <button type="button" class="btn btn-green btn-flat" @click="selectAddress(address)" data-dismiss="modal">
                  <p>{{address.label}}</p>
                  <p style="font-size: 80%;">{{address.formatted_address}}</p>
                </button>
              </section>
            </div>
          </div>
          <!-- modal-content -->
        </div>
        <!-- modal-dialog -->
      </div>
    </section>
  </section>

</template>

<script>
  var $ = require('jquery');
    export default {
        props: {
            addresses: Array,
            rates: Array
        },
        data(){
            return {
              total: 0,

            }
        },

        created() {
            console.log(this.rates[0]);
            //this.getRates();
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
              console.log('ADDRESS: ' + address);
              axios.post('/user/shipment/shipment-rates', json, {headers: ''}).then( response => {
                this.rates = response.data.rates;
              }).catch(function (error) {
                  console.log(error);
              });
            },

            selectAddress(address) {
                $('#address_to_label').html(address.label);
                $('#address_to_address').html(address.formatted_address);
                $('#address_to_phone').html(address.phone);
                $('#address_id').val(address.id);
                this.getRates();
            },

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
