<template>
  <section>
    <header class="card-heading">
      <i class="zmdi zmdi-case"></i>
      Goods Clearance
      <button type="button" class="btn btn-primary btn-fab btn-fab-sm" @click="newGoodsField">
        <i class="zmdi zmdi-plus"></i>
      </button>
      <small>Click at button + to add more goods <mark>but first, type the description</mark></small>
    </header>
     <section class="card-body p-0">
        <div class="table-responsive">
          <table id="productsTable" class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
              <thead>
              <tr>
                  <th class="col-sm-6">Description</th>
                  <th class="col-sm-2">Quantity</th>
                  <th class="col-sm-2">Unit Price</th>
                  <th class="col-sm-2">Total</th>
              </tr>
              </thead>
              <tbody>
                <tr v-for="(goods, index) in customClearances" id="goods">
                    <td :class="{'has-error': errors.has('description') }">
                        <input type="text" v-model="goods.description" class="form-control" v-validate="'required'">
                        <span class="text-danger" v-if="errors.has('description')">
                            <strong>{{ errors.first('description') }}</strong>
                        </span>
                    </td>
                    <!--<td><countries-list @selectedCountry="goods.manufacture_country = $event"></countries-list></td>-->
                    <td>
                        <input type="number" min="1" value="1" v-model="goods.quantity" @change="calculateTotal(index)"
                               class="form-control">
                    </td>
                    <td>
                        <input type="number" min="0.01" value="0.00" step="0.01" v-model="goods.unit_price" @change="calculateTotal(index)"
                               class="form-control">
                    </td>
                    <td>
                        <span>
                            <input type="number" disabled class="form-control" v-bind:value="goods.total_price">
                        </span>
                    </td>
                    <th>
                        <button type="button"class="btn btn-warning btn-fab btn-fab-sm" @click="removeFieldGoods(index)">
                            <i class="zmdi zmdi-minus"></i>
                        </button>
                    </th>
                </tr>
              </tbody>
              <input type="hidden" v-bind:value="clearanceJson" name="custom_clearance">
          </table>
        </div>
    </section>
    <div class="row form-group">
      <div class="col-xs-6 col-sm-11 text-right ">
        <span class="block p-b-5 p-t-5">Total:</span>
      </div>
      <div class="col-xs-6 col-sm-1 p-0">
        <span class="block p-b-5 cart-total">{{total}}</span>
      </div>
    </div>
  </section>
</template>

<script>
    export default {
        props: {
            customClearances: {
                default: function(){ return [] },
                type: Array
            }
        },
        data(){
            return {
              total: 0,
            }
        },

        created() {
        },

        methods: {
            newGoodsField() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.customClearances.push({
                            description: '',
                            manufacture_country: '',
                            quantity: 1,
                            unit_price: 0,
                            total_price: 0.0
                        });
                    }
                });
            },

            removeFieldGoods(index){
                this.customClearances.splice(index, 1);
                this.calculateGlobalTotal();
            },

            calculateTotal(index){
                this.customClearances[index].total_price = this.customClearances[index].quantity *
                    this.customClearances[index].unit_price;
                this.calculateGlobalTotal();
            },

            calculateGlobalTotal(){
                var count;
                this.total = 0;
                for(count = 0; count < this.customClearances.length; count++){
                    this.total += this.customClearances[count].total_price;
                }
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
    .remove-file{
        color:red;
        cursor: pointer;
    }
</style>
