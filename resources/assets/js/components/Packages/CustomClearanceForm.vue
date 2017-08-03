<template>
    <table class="table">
        <thead>
        <tr>
            <th>Goods Clearance</th>
        </tr>
        <tr>
            <th class="col-sm-6">Description</th>
            <!--<th class="col-sm-2">Manufactured Country</th>-->
            <th class="col-sm-2">Quantity</th>
            <th class="col-sm-2">Unit Price</th>
            <th class="col-sm-2">Total</th>
            <th>
                <button type="button" class="btn" @click="newGoodsField">
                    <span class="glyphicon glyphicon-plus" ></span>
                </button>
            </th>
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
                <button type="button" class="btn" @click="removeFieldGoods(index)">
                    <span class="glyphicon glyphicon-minus" ></span>
                </button>
            </th>
        </tr>
        </tbody>
        <input type="hidden" v-bind:value="clearanceJson" name="custom_clearance">
    </table>

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
            },

            calculateTotal(index){
                this.customClearances[index].total_price = this.customClearances[index].quantity *
                    this.customClearances[index].unit_price;
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
