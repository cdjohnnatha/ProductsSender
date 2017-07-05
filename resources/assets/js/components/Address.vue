<template>
    <section class="panel-body">
        <div class="form-group">
            <div class="col-sm-5">
                <label>Name for address</label>
                <input type="text" class="form-control" v-model="address.addressLabel">
            </div>
            <div class="col-sm-4">
                <label>First Name</label>
                <input type="text" class="form-control" v-model="address.name">
            </div>
            <div class="col-sm-3">
                <label>Surname</label>
                <input type="text" class="form-control" v-model="address.surname">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-3">
                <label>Phone</label>
                <input type="text" class="form-control" v-model="address.phone">
            </div>
            <div class="col-sm-3">
                <label>Company Name</label>
                <input type="text" class="form-control" v-model="address.company">
            </div>
            <div class="col-sm-6">
                <label>Address</label>
                <input type="text" class="form-control" v-model="address.address">
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-4">
                <label>City</label>
                <input type="text" class="form-control" v-model="address.city">
            </div>
            <div class="col-sm-3">
                <label>State</label>
                <input type="text" class="form-control" v-model="address.state">
            </div>
            <div class="col-sm-2">
                <label>Postal Code</label>
                <input type="text" class="form-control" v-model="address.postalCode">
            </div>
            <div class="col-sm-3">
                <label>Country</label>
                <countries-list @selectedCountry="address.country = $event"></countries-list>
            </div>
                <button type="button" v-show="false" @click="filledAddress" id="clickAddress"></button>
        </div>
    </section>
</template>

<script>
    export default {
        propos: ['msg'],
        data() {
            return {
                address:{
                    addressLabel: '',
                    name: '',
                    surname: '',
                    phone: '',
                    company: '',
                    address: '',
                    city: '',
                    state: '',
                    postalCode: '',
                    country: ''
                },
            }
        },

        methods:{
            filledAddress: function(){
                this.$emit('filledAddress', this.address);
                alert('test');
            }
        }
    }
</script>

<style lang="css">
</style>
