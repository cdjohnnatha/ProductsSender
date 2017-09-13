<template>
  <section>
    <header class="card-heading">
      <i class="zmdi zmdi-case"></i>
      Goods Clearance
      <button type="button" class="btn btn-primary btn-fab btn-fab-sm" id="add_custom_clearance_button" @click="newGoodsField">
        <i class="zmdi zmdi-plus"></i>
      </button>
      <small><mark>0- All values must be written in U.S dollars.</mark></small>
      <small>1- Click at button + to add more goods</small>
      <small>2- Check if the total value is equal to your bills</small>
      <small>3- Write everything which are contained in box and we check for you if everything are there.</small>
    </header>
     <section class="card-body p-0">
        <div class="table-responsive">
          <table id="productsTable" class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
              <thead>
              <tr>
                  <th class="col-sm-6">Description</th>
                  <th class="col-sm-2">Quantity</th>
                  <th class="col-sm-2">Unit Price</th>
                  <th class="col-sm-2" id="total_title">Total unit</th>
              </tr>
              </thead>
              <tbody>
                <tr v-for="(goods, index) in customClearances" id="goods">
                    <td>
                        <input type="text" v-model="goods.description" class="form-control"
                               v-bind:name="'custom_clearance[' + index + '][description]'">

                        <input v-if="editing.length != 0" type="hidden" v-model="goods.id" class="form-control"
                               v-bind:name="'custom_clearance[' + index + '][id]'">
                    </td>
                    <td>
                        <input type="number" min="1" value="1" v-model="goods.quantity" @change="calculateTotal(index)"
                               class="form-control" v-bind:name="'custom_clearance[' + index + '][quantity]'">
                    </td>
                    <td>
                        <input type="number" min="0.00" step="0.01" v-model="goods.unit_price"
                               @change="calculateTotal(index)" class="form-control"
                               v-bind:name="'custom_clearance[' + index + '][unit_price]'">
                    </td>
                    <td >
                        <span>
                            <input type="number" id="total_value" class="form-control" v-bind:value="goods.total_unit" disabled>
                            <input type="hidden" v-bind:name="'custom_clearance[' + index + '][total_unit]'"
                                   v-bind:value="goods.total_unit">
                        </span>
                    </td>
                    <th>
                        <button type="button" class="btn btn-warning btn-fab btn-fab-sm" @click="removeFieldGoods(index)">
                            <i class="zmdi zmdi-minus"></i>
                        </button>
                    </th>
                </tr>
              </tbody>
          </table>
        </div>
    </section>
    <div class="row form-group">
      <div class="col-xs-6 col-sm-11 text-right ">
        <span class="block p-b-5 p-t-5">Total:</span>
      </div>
      <div class="col-xs-6 col-sm-1 p-0">
        <span class="block p-b-5 cart-total">{{total}}</span>

        <input type="hidden" name="total_goods" v-bind:value="total">
      </div>
    </div>
  </section>
</template>

<script>
    export default {
        props: {
            editing: {
                default: Array
            }
        },
        data(){
            return {
              total: 0,
                customClearances: []
            }
        },

        created() {
            if(this.editing.length <= 0) {
                if (this.customClearances.length <= 0) {
                    this.customClearances.push({
                        description: '',
                        quantity: 1,
                        unit_price: 0.00,
                        total_unit: 0.0
                    });
                }
            } else{
                this.customClearances = this.editing;
                this.calculateGlobalTotal();
            }

        },

        methods: {
            newGoodsField() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.customClearances.push({
                            description: '',
                            quantity: 1,
                            unit_price: 0.00,
                            total_unit: 0.0
                        });
                    }
                });
            },

            removeFieldGoods(index){
                console.log(this.customClearances[index].id);
                if(this.editing.length > 0 && this.customClearances[index].hasOwnProperty('id')){
                    axios.post('/user/goods/' + this.customClearances[index].id, {
                        '_method': 'delete'
                    }).catch(function (error) {
                        console.log(error);
                    });
                }

                if(this.customClearances.length > 1){
                    this.customClearances.splice(index, 1);
                    this.calculateGlobalTotal();
                }
            },

            calculateTotal(index){
                this.customClearances[index].total_unit = this.customClearances[index].quantity *
                    this.customClearances[index].unit_price;
                this.calculateGlobalTotal();
            },

            calculateGlobalTotal(){
                var count;
                this.total = 0;
                for(count = 0; count < this.customClearances.length; count++){
                    this.total += parseFloat(this.customClearances[count].total_unit);
                }

                this.total = parseFloat(this.total).toFixed(2);
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
  #total_title{
    text-align: center;
  }

  #total_value{
    text-align: center;
  }
</style>
