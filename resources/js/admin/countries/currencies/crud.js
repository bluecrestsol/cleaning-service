               
const Vue = require('^resources/admin/vue');
import { i18n } from '^resources/i18n';

const app = new Vue({
    el: '#app',
    i18n,

    data: function() {
        return {
            currency: {
                loading: false,
                options: [],
                value: ''
            },
            status: {
                options: {
                    'enabled': true,
                    'disabled': false
                },
                value: 'disabled'
            },
            isPrimary: {
                options: {
                    '1': true,
                    '0': false
                },
                value: '0'
            }
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
                vm.getCurrencies();
            });
        },

        getCurrencies() {
            var vm = this;
            var collection = vm.main.collection;
            var country = (collection.country ?? {}).id ?? null;
            var currency = (collection.currency ?? {}).id ?? null;
            vm.currency.loading = true;

            var data = {};
            if (vm.$helper.isNotNull(currency)) {
                data.except = currency;
            }
            $.ajax({
                url: vm.$route('admin.ajax.countries.currencies.fetch.reverse', country),
                type: 'GET',
                data,
                dataType: 'JSON',
                success: function (response) {
                    vm.currency.loading = false;
                    if (response && response.data) {
                        vm.currency.options = response.data.map(function(item) {
                            return {
                                id: item.id,
                                text: vm.$helper.getValue(item.name)
                            }
                        });
                    }
                }
            });
        }
    }
});