<template>
    <section class="container col-sm-offset-1">
        <div class="col-sm-11 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Warehouses</div>
                <div class="panel-body">
                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <div class="form-group col-sm-6" :class="{'has-error': errors.has('name') }" >
                                <label>Name for warehouse</label>
                                <input name="nameWarehouse" class="form-control" type="text" placeholder="Name"
                                       v-model="warehouse.nameWarehouse" v-validate="'required'">
                                <span class="text-danger" v-if="errors.has('nameWarehouse')">
                                    <strong>{{ errors.first('nameWarehouse') }}</strong>
                                </span>
                            </div>
                            <div class="form-group col-sm-3" :class="{'has-error': errors.has('storageTime') }" >
                                <label>Storage Time</label>
                                <input name="storageTime" class="form-control" type="number" placeholder="storageTime"
                                       v-model="warehouse.storageTime" v-validate="'required|numeric'">
                                <span class="text-danger" v-if="errors.has('storageTime')">
                                    <strong>{{ errors.first('storageTime') }}</strong>
                                </span>
                            </div>
                            <div class="form-group col-sm-3" :class="{'has-error': errors.has('boxPrice') }" >
                                <label>Box Price</label>
                                <input name="boxPrice" class="form-control" type="number" placeholder="boxPrice"
                                       v-model="warehouse.boxPrice" v-validate="'required|decimal'">
                                <span class="text-danger" v-if="errors.has('boxPrice')">
                                    <strong>{{ errors.first('boxPrice') }}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <address-form @filledAddress="warehouse.address = $event"
                                  @addressStatus="addressStatus = $event"></address-form>
                </div> <!-- panel body -->
                <footer class="panel-footer">
                    <button type="submit" id="submit-button" class="btn btn-primary pull-right"
                            @click="submitForm">Create</button>
                    <div class="clearfix"></div>
                </footer>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data(){
            return {
                addressStatus: false,
                warehouse:{
                    nameWarehouse: '',
                    storageTime: '',
                    boxPrice: '',
                    address: {
                        addressLabel: '',
                        name: '',
                        surname: '',
                        phone: '',
                        company: '',
                        address: '',
                        city: '',
                        state: '',
                        postalCode: '',
                        country: '',
                        addressStatus: false
                    }
                }

            }
        },

        methods: {
            submitForm: function(){
                console.log('sending');
                $('#clickAddress').click();
                this.$validator.validateAll().then((result) => {
                    if (result && this.addressStatus) {
                        axios.post('/admin/warehouses/register', this.warehouse ).then( response => {
                            location.href= response.data;
                        }).catch(function (error) {
                            console.log(error);
                        });
                    }
                });

            }
        }

    }
</script>

<style lang="css">
</style>
