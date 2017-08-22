<template>
  <section>
      <vue-google-autocomplete
        ref="address"
        id="map"
        classname="form-control"
        placeholder=""
        v-on:placechanged="getAddressData" v-bind:value="set_address">
      </vue-google-autocomplete>
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

            }
        },
        mounted() {
            console.log(this.set_address);
        },
        methods:{
            getAddressData: function (addressData, placeResultData) {
                var index = 0;
                $('#submit-button').addClass('disabled');
                $('#street').val(addressData.route);
                $('#state').val(addressData.administrative_area_level_1);
                $('#country').val(addressData.country);
                $('#formatted_address').val(placeResultData.formatted_address);
                for(index; index < placeResultData.address_components.length; index++){
                    if(placeResultData.address_components[index].types[0] == 'administrative_area_level_2'){
                        $('#city').val(placeResultData.address_components[index].long_name);
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
                    + $('#country').val() + '&maxRows=2' + this.geonameUsername;
                return axios.get(url, {headers: ''})
                  .then( response => {
                    $('#geonames_country').val(response.data.geonames[0].geonameId);
                    console.log(response.data.geonames[0].geonameId);
                });
            },

            getCityGeonameId(){
                var url = this.prefixGeonames + 'searchJSON?q=' + $('#city').val() + '&maxRows=2'
                    + this.geonameUsername;
                return axios.get(url, {headers: ''})
                    .then( response => {
                        $('#geonames_city').val(response.data.geonames[0].geonameId);
                    });
            },

            getStateGeonameId(){
                var url = this.prefixGeonames + 'searchJSON?q=' + $('#state').val() + '&maxRows=2'
                    + this.geonameUsername;
                return axios.get(url, {headers: ''})
                    .then( response => {
                        $('#geonames_state').val(response.data.geonames[0].geonameId);
                    });
            }
        },
    }
</script>
<link rel="stylesheet" type="text/css" href="https://select2.github.io/select2-bootstrap-theme/css/select2-bootstrap.css">
<style lang="css">
</style>
