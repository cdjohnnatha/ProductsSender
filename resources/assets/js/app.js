
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VeeValidate from 'vee-validate';
window.Vue.use(VeeValidate);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('admin-list', require('./components/Admins/List.vue'));
Vue.component('login-admin', require('./components/Admins/LoginAdmin.vue'));
Vue.component('admin-form', require('./components/Admins/FormAdmin.vue'));

Vue.component('countries-list', require('./components/Utils/Countries.vue'));
Vue.component('address-form', require('./components/Utils/Address.vue'));
Vue.component('subscriptions', require('./components/Utils/Subscriptions.vue'));
Vue.component('vertical-menu', require('./components/Utils/Menu.vue'));

Vue.component('wareouse-form', require('./components/Warehouse/WarehouseForm.vue'));

Vue.component('user-register', require('./components/Users/UserRegister.vue'));
Vue.component('user-form', require('./components/Users/UserRegister.vue'));
Vue.component('user-list', require('./components/Users/Users.vue'));
const app = new Vue({
    el: '#app'
});
