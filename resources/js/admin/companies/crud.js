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
            whatsapp: {
                config: {
                    utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.1.0/js/utils.js',
                    initialCountry: "auto",
                    placeholderNumberType: "MOBILE",
                    hiddenInput: "whatsapp",
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
            address: {
                country: {
                    loading: false,
                    options: [],
                    value: ''
                }
            },
            billingDetails: {
                mobile: {
                    config: {
                        utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.1.0/js/utils.js',
                        separateDialCode: true,
                        initialCountry: "auto",
                        placeholderNumberType: "MOBILE",
                        hiddenInput: "mobile",
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
                address: {
                    country: {
                        loading: false,
                        options: [],
                        value: ''
                    }
                }
            }
        };
    },
    mounted() {
        this.init();
    },
    methods: {
        // Initialization
        init() {
            var vm = this;
            $(document).ready(function() {
                vm.$toaster.init();
                vm.initDOM();
                vm.getCountries();
            });
        },
        // Initialize DOM
        initDOM() {
            var vm = this;
            $("#main-form").submit(vm.onFormSubmit);
        },
        // On form submit
        onFormSubmit(e) {
            var vm = this;
            var messages = vm.getNumberErrors([
                'phone',
                'whatsapp',
                [ 'billingDetails.mobile', 'billing details mobile'],
                [ 'billingDetails.phone', 'billing details phone']
            ]);
            if (messages.length > 0) {
                vm.$toaster.run([{ type: 'error', message: messages.join('<br/>') }]);
                return false;
            }
        },
        // Get list of countries
        getCountries() {
            var vm = this;
            vm.country.loading = true;
            vm.billingDetails.address.country.loading = true;
            $.ajax({
                url: vm.$route('admin.ajax.countries.fetch'),
                type: 'GET',
                dataType: 'JSON',
                success: function (response) {
                    vm.country.loading = false;
                    vm.address.country.loading = false;
                    vm.billingDetails.address.country.loading = false;
                    if (response && response.data) {
                        var options = [];
                        response.data.forEach(function(item) {
                            options.push({
                                id: item.id,
                                text: item.name
                            });
                        });
                        vm.country.options = options;
                        vm.address.country.options = options;
                        vm.billingDetails.address.country.options = options;
                    }
                }
            });
        },
        // On phone change
        onPhoneChange(number, details) {
            this.phone.details = details;
        },
        // On whatsapp change
        onWhatsappChange(number, details) {
            this.whatsapp.details = details;
        },
        // On billing details mobile change
        onBillingDetailsMobileChange(number, details) {
            this.billingDetails.mobile.details = details;
        },
        // On billing details phone change
        onBillingDetailsPhoneChange(number, details) {
            this.billingDetails.phone.details = details;
        }
    }
});