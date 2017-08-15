<template>
  <section>
    <vue-google-autocomplete
      ref="address"
      id="map"
      classname="form-control"
      placeholder="Please type your address"
      v-on:placechanged="getAddressData"
      country="br">
    </vue-google-autocomplete>
  </section>
</template>
<script>

     export default {
        props: ['setCountry'],
        data() {
            return {
                selectedCountry: '',
                address: ''
            }
        },

        created() {

        },
        methods:{
            getAddressData: function (addressData, placeResultData) {
                this.address = addressData;
                console.log(placeResultData.address_components[1].short_name)
            }
        },
    }
</script>

<style lang="css">
</style>
