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
                                <input name="name" class="form-control" type="text" placeholder="Name"
                                       v-model="warehouse.name" v-validate="'required'">
                                <span class="text-danger" v-if="errors.has('name')">
                                    <strong>{{ errors.first('name') }}</strong>
                                </span>
                            </div>
                            <div class="form-group col-sm-3" :class="{'has-error': errors.has('storage_time') }" >
                                <label>Storage Time</label>
                                <input name="storage_time" class="form-control" type="number" placeholder="storage_time"
                                       v-model="warehouse.storage_time" v-validate="'required|numeric'">
                                <span class="text-danger" v-if="errors.has('storage_time')">
                                    <strong>{{ errors.first('storage_time') }}</strong>
                                </span>
                            </div>
                            <div class="form-group col-sm-3" :class="{'has-error': errors.has('box_price') }" >
                                <label>Box Price</label>
                                <input name="box_price" class="form-control" type="number" placeholder="box_price"
                                       v-model="warehouse.box_price" v-validate="'required|decimal'">
                                <span class="text-danger" v-if="errors.has('box_price')">
                                    <strong>{{ errors.first('box_price') }}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <address-form @filledAddress="warehouse.address = $event"
                                  @addressStatus="addressStatus = $event" :address="warehouse.address"></address-form>
                </div> <!-- panel body -->
                <footer class="panel-footer">
                    <button type="submit" id="submit-button" class="btn btn-primary pull-right"
                            @click="submitForm">{{buttonName}}</button>
                    <div class="col-sm-11">
                        <a href="/admin/dashboard" id="cancel-button" class="btn btn-danger pull-right"
                                @click="submitForm">Cancel</a>
                    </div>
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
                urlForm: '/admin/warehouses/register',
                buttonName: 'Create',
                warehouse:{
                    name: '',
                    storage_time: '',
                    box_price: '',
                    address: {
                        label: '',
                        name: '',
                        surname: '',
                        phone: '',
                        company: '',
                        address: '',
                        city: '',
                        state: '',
                        postal_code: '',
                        country: '',
                        default_address: false
                    }
                }

            }
        },

        created() {
            let url = window.location.href;
            if(url.indexOf('edit') !== -1) {
                var id = url.match(/\/([0-9]+)\/edit/)[1];
                this.warehouse.id = id;
                this.urlForm = '/admin/warehouses/' + this.warehouse.id + '/update';
                this.buttonName = 'Update';
                axios.get('/admin/warehouses/'+ this.warehouse.id + '/show').then( response => {
                    this.warehouse = response.data.warehouse;
                    console.log(this.warehouse);
                }).catch(function (error) {

                    console.log(error);
                });
            }
        },

        methods: {
            submitForm: function(){
                console.log('sending');
                $('#clickAddress').click();
                this.$validator.validateAll().then((result) => {
                    if (result && this.addressStatus) {
                        console.log(this.urlForm);
                        axios.post(this.urlForm, this.warehouse ).then( response => {
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
