<template>
    <section class="container col-sm-offset-1">
        <div class="col-sm-11 col-sm-offset-1">
            <div class="panel panel-default">

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
