
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

Vue.component('login-admin', require('./components/LoginAdmin.vue'));
Vue.component('countries-list', require('./components/Countries.vue'));
Vue.component('user-register', require('./components/UserRegister.vue'));
Vue.component('address-form', require('./components/Address.vue'));
Vue.component('subscriptions', require('./components/Subscriptions.vue'));

const app = new Vue({
    el: '#app'
});
