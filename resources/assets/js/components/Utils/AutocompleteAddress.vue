<template>
  <section>
      <vue-google-autocomplete
        ref="address"
        id="map"
        classname="form-control"
        placeholder=""
        v-on:placechanged="getAddressData" v-bind:value="set_address">
      </vue-google-autocomplete>
      <input type="hidden" name="address[city]" v-bind:value="address.city">
      <input type="hidden" name="address[state]" v-bind:value="address.state">
      <input type="hidden" name="address[country]" v-bind:value="address.country">
      <input type="hidden" name="address[street]" v-bind:value="address.street">
      <input type="hidden" name="address[formatted_address]" v-bind:value="address.formated_address">
      <input type="hidden" name="address_code[country]" v-bind:value="geonames.city">
      <input type="hidden" name="address_code[state]" v-bind:value="geonames.state">
      <input type="hidden" name="address_code[city]" v-bind:value="geonames.country">
  </section>
</template>
<script>
     export default {
        props: {
            set_address: {
                type: String,
                default: ''
            }
        },
        data(){
            return {
                geonameUsername: '&username=cdjohnnatha',
                prefixGeonames: 'http://api.geonames.org/',
                address: {
                  city: '',
                  state: '',
                  country: '',
                  street: '',
                  formated_address: '',
                },
                geonames: {
                    country: '',
                    state: '',
                    city: '',
                }

            }
        },
        mounted() {
            console.log(this.set_address);
        },
        methods:{
            getAddressData: function (addressData, placeResultData) {
                var index = 0;
                $('#submit-button').addClass('disabled');
                this.address.street = addressData.route;
                this.address.state = addressData.administrative_area_level_1;
                this.address.country = addressData.country;
                this.address.formated_address = placeResultData.formatted_address;
                for(index; index < placeResultData.address_components.length; index++){
                    if(placeResultData.address_components[index].types[0] == 'administrative_area_level_2'){
                        this.address.city = placeResultData.address_components[index].long_name;
                        break;
                    }
                }
                axios.all([this.getCountryGeonameId(), this.getStateGeonameId(), this.getCityGeonameId()])
                    .then( response => {
                        $('#submit-button').removeClass('disabled');
                    });

            },

            getCountryGeonameId(){
                var url = this.prefixGeonames + 'searchJSON?q='
                    + this.address.country + '&maxRows=2' + this.geonameUsername;
                return axios.get(url, {headers: ''})
                  .then( response => {
                    this.geonames.country = response.data.geonames[0].geonameId;
                });
            },

            getCityGeonameId(){
                var url = this.prefixGeonames + 'searchJSON?q=' + this.address.city + '&maxRows=2'
                    + this.geonameUsername;
                return axios.get(url, {headers: ''})
                    .then( response => {
                        this.geonames.city = response.data.geonames[0].geonameId;
                    });
            },

            getStateGeonameId(){
                var url = this.prefixGeonames + 'searchJSON?q=' + this.address.state + '&maxRows=2'
                    + this.geonameUsername;
                return axios.get(url, {headers: ''})
                    .then( response => {
                        this.geonames.state = response.data.geonames[0].geonameId;
                    });
            }
        },
    }
</script>
<link rel="stylesheet" type="text/css" href="https://select2.github.io/select2-bootstrap-theme/css/select2-bootstrap.css">
<style lang="css">
</style>
