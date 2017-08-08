
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

 /* Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('nested-messages', require('./components/Subscriptions/NestedBenefitsMessage.vue'));
Vue.component('warehouses-select', require('./components/Warehouse/WarehouseSelect.vue'));
Vue.component('status-select', require('./components/Utils/Status.vue'));
Vue.component('package-upload-files', require('./components/Packages/UploadFiles.vue'));
Vue.component('package-pictures', require('./components/Packages/PackagePictures.vue'));

Vue.component('small-pictures-preview', require('./components/Packages/PackageSmallPreview.vue'));
Vue.component('register-form-button', require('./components/Users/UserFormButton.vue'));


import { store } from './store'

const app = new Vue({
    el: '#app',
    store,
});
