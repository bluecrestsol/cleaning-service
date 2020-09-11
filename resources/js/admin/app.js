// Application js for customer
import Vue from 'vue'
import { i18n } from '^resources/i18n'

// Prototypes
const {
    permission,
    helper,
    toaster,
    route
} = require('^resources/core');
Vue.prototype.$helper = helper;
Vue.prototype.$toaster = toaster;
Vue.prototype.$route = route;
Vue.prototype.$permission = permission;

// Mixin
const mixin = require('./mixin');
Vue.mixin(mixin);

// Common components
Vue.component('collection', require('^resources/components/admin/collection').default);
Vue.component('datatable', require('^resources/components/admin/datatable').default);
Vue.component('select2', require('^resources/components/admin/select2').default);
Vue.component('mobile', require('^resources/components/admin/mobile').default);
Vue.component('v-switch', require('^resources/components/admin/v-switch').default);
Vue.component('v-input', require('^resources/components/admin/v-input').default);
Vue.component('datetimepicker', require('^resources/components/admin/datetimepicker').default);
Vue.component('datepicker', require('^resources/components/admin/datepicker').default);

// Per page data
const root = document.getElementById('app')
var page = root.dataset.vuePage;
var data = root.dataset.vueProps;
var config = require(`^resources/admin/${page}.js`)(data);

// Vue instance
const app = new Vue(Object.assign({}, {el: '#app', i18n}, config));