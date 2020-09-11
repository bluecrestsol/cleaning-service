const Vue = require('^resources/admin/vue');
import { i18n } from '^resources/i18n';

const app = new Vue({
    el: '#app',
    i18n,

    data: function() {
        return {
            country: {
                loading: false,
                options: [],
                value: ''
            },
        };
    },

    mounted() {
        this.init();
    },

    methods: {
        init() {
            var vm = this;
            $(document).ready(function(){
                vm.$toaster.init();
                vm.prepareData();
                vm.initDOM();
            });
        },

        prepareData() {
        },

        initDOM() {
        }
    }
});