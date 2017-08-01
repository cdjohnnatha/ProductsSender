<template>
    <section class="container col-sm-offset-1">
        <div class="col-sm-11 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Inform New Package</div>
                <div class="panel-body">
                    <section>
                        <div class="form-group col-sm-6">
                            <label for="provider">Provider</label>
                            <input type="text" id="provider" class=form-control>
                            <label>Warehouse</label>
                            <warehouses-select></warehouses-select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Addressee</label>
                            <select class="form-control"></select>
                            <label for="tracknumber">Tack Number</label>
                            <input type="text" id="tracknumber" class="form-control">
                        </div>
                        <div class="form-group col-sm-12">
                            <label>Note</label>
                            <textarea class="form-control"></textarea>
                        </div>
                    </section>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Goods Clearance</th>
                        </tr>
                        <tr>
                            <th class="col-sm-6">Description</th>
                            <th class="col-sm-2">Manufactured Country</th>
                            <th class="col-sm-1">Quantity</th>
                            <th class="col-sm-1">Unit Price</th>
                            <th class="col-sm-2">Total</th>
                            <th><button><span class="glyphicon glyphicon-plus" @click="newGoodsField"></span></button></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(goods, index) in customClearances">
                            <td><input type="text" v-model="goods.description" class="form-control"></td>
                            <td><countries-list @selectedCountry="goods.manufacture_country = $event"></countries-list></td>
                            <td><input type="number" min="1" value="1" v-model="goods.quantity" class="form-control"></td>
                            <td><input type="number" min="1" value="1" v-model="goods.unit_price" class="form-control"></td>
                            <td><span><input type="number" disabled class="form-control"></span></td>
                            <th><button><span class="glyphicon glyphicon-minus" @click="removeFieldGoods(index)"></span></button></th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</template>

<script>
    import CustomClearance from '../Utils/ObjectJson/CustomClearance'
    export default {
        props: {
            data_id: 0,
            user_id: 0,
        },
        data(){
            return {
                urlForm: '/user/' + this.user_id + '/',
                disabled: false,
                buttonName: 'Register',
                submitAction: this.submitForm,
                customClearances: [CustomClearance]
            }
        },

        created() {


        },

        methods: {
            submitForm: function(){
                this.$validator.validateAll().then((result) => {
                    if (result && this.objectPackage.warehouse_id !== -1 ) {
                        axios.post(this.urlForm, this.objectPackage).then( response => {
                            if(response.status === 201)
                                location.href= '/admin/packages/show-list';
                            console.log(response);
                        }).catch(function (error) {
                            console.log(error);
                        });
                    }
                });
            },

            newGoodsField() {
                this.customClearances.push(CustomClearance);
            },

            removeFieldGoods(index){
                this.customClearances.splice(index, 1);
            }

        }

    }
</script>

<style lang="css">

</style>
