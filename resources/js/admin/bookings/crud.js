const Vue = require('^resources/admin/vue');
import { i18n } from '^resources/i18n';

const app = new Vue({
    el: '#app',
    i18n,

    data: function() {
        return {
            bookedAt: {
                value: '',
                error: null
            },
            phone: {
                config: {
                    utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.1.0/js/utils.js',
                    initialCountry: "auto",
                    placeholderNumberType: "FIXED_LINE",
                    hiddenInput: "phone",
                    geoIpLookup: function(success, failure) {
                        $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                            var countryCode = (resp && resp.country) ? resp.country : "";
                            success(countryCode);
                        });
                    }
                },
                value: '',
                details: {
                    isValid: true,
                    message: null
                }
            },
            service: {
                loading: false,
                options: [],
                value: ''
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
                $("#main-form").submit(vm.onFormSubmit);
                vm.prepareData();
                vm.getServices();
            });
        },

        prepareData() {
            var vm = this;
            var collection = this.main.collection;
            var data = [];
            if (collection.old) {
                data.push(
                    { to: 'service.selected', from: 'services', fallback: [] }
                );
            } else {
                data.push(
                    { to: 'service.selected', from: 'services', fallback: [],
                        callback: function(obj) {
                            return _.map(obj, function(item) { return item.id.toString() });
                        }
                    }
                );
            }
            vm.$helper.transferValues(vm, collection.old ?? collection.booking, data);
        },

        onFormSubmit(e) {
            var vm = this;
            var messages = vm.getNumberErrors(['phone']);
            if (messages.length > 0) {
                vm.$toaster.run([{ type: 'error', message: messages.join('<br/>') }]);
                return false;
            }
            vm.$helper.addValueToForm("#main-form", 'company_id', vm.main.company.value);
            vm.$helper.addValueToForm("#main-form", 'country_id', vm.main.country.value);
        },

        getServices() {
            var vm = this;
            vm.service.loading = true;
            $.ajax({
                url: vm.$route('admin.ajax.services.fetch'),
                type: 'GET',
                data: {
                    company: vm.main.company.value,
                    country: vm.main.country.value,
                    status: 'enabled'
                },
                dataType: 'JSON',
                success: function (response) {
                    vm.service.loading = false;
                    if (response && response.data) {
                        vm.service.options = response.data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.name
                            }
                        });
                    }
                }
            });
        },

        onPhoneChange(number, details) {
            this.phone.details = details;
        },
    }
});