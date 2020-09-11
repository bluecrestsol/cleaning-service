
const Vue = require('^resources/admin/vue');
import { i18n } from '^resources/i18n';

const app = new Vue({
    el: '#app',
    i18n,

    data: function() {
        return {
            currency: {
                loading: false,
                value: '',
                options: [],
                error: null
            },
            hasStates: {
                options: {
                    '1': true,
                    '0': false
                },
                value: '0'
            },
            hasCities: {
                options: {
                    '1': true,
                    '0': false
                },
                value: '0'
            },
            hasDistricts: {
                options: {
                    '1': true,
                    '0': false
                },
                value: '0'
            },
            hasZip: {
                options: {
                    '1': true,
                    '0': false
                },
                value: '0'
            },
        };
    },

    mounted() {
        this.init();
    },

    methods: {
        init() {
            var vm = this;
            $(document).ready(function() {
                vm.$toaster.init();
                $(".kt-selectpicker").selectpicker();
            });

            this.getCurrencies();
        },

        // Get list of country currencies
        getCurrencies() {
            var vm = this;
            vm.currency.loading = true;
            $.ajax({
                url: vm.$route('admin.ajax.currencies.fetch'),
                type: 'GET',
                dataType: 'JSON',
                success: function (response) {
                    vm.currency.loading = false;
                    if (response && response.data) {
                        vm.currency.options = response.data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.name
                            }
                        });
                    }
                }
            });
        },
    }
});
