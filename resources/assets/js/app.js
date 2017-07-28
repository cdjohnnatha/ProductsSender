
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
Vue.component('admin-list', require('./components/Admins/List.vue'));
Vue.component('login-admin', require('./components/Admins/LoginAdmin.vue'));
Vue.component('admin-form', require('./components/Admins/FormAdmin.vue'));
Vue.component('vertical-menu', require('./components/Admins/Menu.vue'));

Vue.component('countries-list', require('./components/Utils/Countries.vue'));
Vue.component('address-form', require('./components/Utils/Address.vue'));
Vue.component('subscriptions', require('./components/Utils/Subscriptions.vue'));


Vue.component('warehouse-form', require('./components/Warehouse/WarehouseForm.vue'));
Vue.component('warehouses-list', require('./components/Warehouse/WarehousesList.vue'));
Vue.component('warehouses-select', require('./components/Warehouse/WarehouseSelect.vue'));

Vue.component('subscription-form', require('./components/Subscriptions/Form.vue'));
Vue.component('subscription-list', require('./components/Subscriptions/Listing.vue'));


Vue.component('status-select', require('./components/Utils/Status.vue'));
Vue.component('status-warehouse-select', require('./components/Utils/StatusWarehouse.vue'));

Vue.component('user-register', require('./components/Users/UserRegister.vue'));
Vue.component('user-form', require('./components/Users/UserRegister.vue'));
Vue.component('user-list', require('./components/Users/Users.vue'));
Vue.component('user-menu', require('./components/Users/Menu.vue'));
Vue.component('user-packages', require('./components/Packages/UserPackages.vue'));
Vue.component('notification-bar', require('./components/Users/NotificationsBar.vue'));
Vue.component('notifications', require('./components/Utils/Notifications.vue'));

Vue.component('package-form', require('./components/Packages/Form.vue'));
Vue.component('package-table', require('./components/Packages/Table.vue'));
Vue.component('package-show', require('./components/Packages/Show.vue'));


Vue.component('virtualList', require('vue-virtual-scroll-list'));

import { store } from './store'

const app = new Vue({
    el: '#app',
    store

});
