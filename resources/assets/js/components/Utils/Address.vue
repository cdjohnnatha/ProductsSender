<template>
    <section class="panel-body">
        <div class="form-group col-sm-12" >
            <div class="col-sm-5" :class="{'has-error': errors.has('label') }">
                <label>Name for address</label>
                <input type="text" class="form-control" v-model="address.label"
                       name="label" id="label" v-validate="'required'">
                <span class="text-danger" v-if="errors.has('label')">
                    <strong>{{ errors.first('label') }}</strong>
                </span>
            </div>
            <div class="col-sm-4" :class="{'has-error': errors.has('owner_name') }">
                <label>First Name</label>
                <input type="text" class="form-control" name="owner_name"
                       v-model="address.owner_name" v-validate="'required'">
                <span class="text-danger" v-if="errors.has('owner_name')">
                    <strong>{{ errors.first('owner_name') }}</strong>
                </span>
            </div>
            <div class="col-sm-3" :class="{'has-error': errors.has('owner_surname') }">
                <label>Surname</label>
                <input type="text" class="form-control" name="owner_surname"
                       v-model="address.owner_surname" v-validate="'required'">
                <span class="text-danger" v-if="errors.has('owner_surname')">
                    <strong>{{ errors.first('owner_surname') }}</strong>
                </span>
            </div>
        </div>
        <!-- -->

        <div class="form-group col-sm-12" >
            <div class="col-sm-3" :class="{'has-error': errors.has('phone-address') }">
                <label>Phone</label>
                <input id="phone" type="text" class="form-control" name="phone-address"
                       v-validate="'required|numeric|min:10'"  v-model="address.phone">
                <span class="text-danger" v-if="errors.has('phone-address')">
                    <strong>{{ errors.first('phone-address') }}</strong>
                </span>
            </div>
            <div class="col-sm-3">
                <label>Company Name</label>
                <input type="text" class="form-control" v-model="address.company" name="company">
            </div>
            <div class="col-sm-6" :class="{'has-error': errors.has('address') }">
                <label>Address</label>
                <input type="text" class="form-control"
                       v-model="address.address" name="address" v-validate="'required'">
                <span class="text-danger" v-if="errors.has('address')">
                    <strong>Address name is required</strong>
                </span>
            </div>
        </div>


        <div class="form-group col-sm-12" :class="{'has-error': errors.has('city') }">
            <div class="col-sm-4">
                <label>City</label>
                <input type="text" class="form-control"
                       v-model="address.city" name="city" v-validate="'required'">
                <span class="text-danger" v-if="errors.has('city')">
                    <strong>{{ errors.first('city') }}</strong>
                </span>
            </div>
            <div class="col-sm-3" :class="{'has-error': errors.has('state') }">
                <label>State</label>
                <input type="text" class="form-control"
                       v-model="address.state" name="state" v-validate="'required'">
                <span class="text-danger" v-if="errors.has('state')">
                    <strong>{{ errors.first('state') }}</strong>
                </span>
            </div>
            <div class="col-sm-2" :class="{'has-error': errors.has('postal_code') }">
                <label>Postal Code</label>
                <input type="text" class="form-control"
                       v-model="address.postal_code" name="postal_code" v-validate="'required'">
                <span class="text-danger" v-if="errors.has('postal_code')">
                    <strong>{{ errors.first('postal_code') }}</strong>
                </span>
            </div>
            <div class="col-sm-3">
                <label>Country</label>
                <countries-list name="country-address" @selectedCountry="address.country = $event"
                    :setCountry="address.country">
                </countries-list>
            </div>
                <button type="button" v-show="false" @click="filledAddress"
                        id="clickAddress"></button>
        </div>
    </section>
</template>

<script>
    import Address from './Objects/Address'
    export default {
        props: {
            address: Address
        },
        data() {
            return {


            }
        },


        methods:{
            filledAddress: function(){
                this.$validator.validateAll().then((result) => {
                    if(result) {
                        console.log(this.address);
                        this.$emit('filledAddress', this.address);
                    }
                    this.$emit('addressStatus', result);
                });

            }
        }
    }
</script>

<style lang="css">
</style>
