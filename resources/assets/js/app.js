
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
import VeeValidate from 'vee-validate';
window.Vue.use(VeeValidate);

import VueLazyLoad from 'vue-lazyload';
import VueTouch from 'vue-touch';
window.Vue.use(VueLazyLoad);
window.Vue.use(VueTouch, { name: 'v-touch' });

Vue.component('status-select', require('./components/Utils/Status.vue'));

Vue.component('user-notifications', require('./components/Users/NotificationsBar.vue'));
Vue.component('user-additional-names', require('./components/Users/AdditionalNames.vue'));
Vue.component('autocomplete-address', require('./components/Utils/AutocompleteAddress.vue'));
Vue.component('vue-google-autocomplete', require('vue-google-autocomplete'));
Vue.component('select-subscription', require('./components/Utils/SelectSubscription.vue'));
Vue.component('plan-offers', require('./components/Utils/PlanOffers.vue'));
Vue.component('custom-clearance-form', require('./components/Packages/CustomClearanceForm.vue'));
Vue.component('warehouse-notifications', require('./components/Warehouses/NotificationsBar.vue'));
Vue.component('shipment-component', require('./components/Packages/Shipment.vue'));


import VueGoogleAutocomplete from 'vue-google-autocomplete';
import vSelect from "vue-select";
Vue.component('vue-country-select', VueGoogleAutocomplete);
Vue.component('v-select', vSelect);

import { store } from './store'
const app = new Vue({
    el: '#app',
    store,

});
