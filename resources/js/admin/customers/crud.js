const Vue = require('^resources/admin/vue');
import { i18n } from '^resources/i18n';

const app = new Vue({
    el: '#app',
    i18n,

    data: function() {
        return {
            language: {
                loading: false,
                options: [],
                value: ''
            },
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
        init() {
            var vm = this;
            $(document).ready(function(){
                vm.$toaster.init();
                vm.prepareData();
                vm.initDOM();
                vm.getLanguages();
                vm.getCountries();
            });
        },

        initDOM() {
            var vm = this;
            $(".kt-selectpicker").selectpicker();
            $("#main-form").submit(vm.onFormSubmit);
        },

        prepareData() {
        },

        onFormSubmit(e) {
            var vm = this;
            var messages = vm.getNumberErrors([
                'mobile',
                'phone',
                'whatsapp',
                [ 'billingDetails.mobile', 'billing details mobile'],
                [ 'billingDetails.phone', 'billing details phone']
            ]);
            if (messages.length > 0) {
                vm.$toaster.run([{ type: 'error', message: messages.join('<br/>') }]);
                return false;
            }
            vm.$helper.addValueToForm("#main-form", 'company_id', vm.main.company.value);
            vm.$helper.addValueToForm("#main-form", 'country_id', vm.main.country.value);
        },

        getLanguages() {
            var vm = this;
            vm.language.loading = true;
            $.ajax({
                url: vm.$route('admin.ajax.countries.languages.fetch', $("#active-country").val()),
                type: 'GET',
                dataType: 'JSON',
                success: function (response) {
                    vm.language.loading = false;
                    if (response && response.data) {
                        vm.language.options = response.data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.english_name
                            }
                        });
                    }
                }
            });
        },

        getCountries() {
            var vm = this;
            vm.billingDetails.address.country.loading = true;
            $.ajax({
                url: vm.$route('admin.ajax.countries.fetch'),
                type: 'GET',
                dataType: 'JSON',
                success: function (response) {
                    vm.billingDetails.address.country.loading = false;
                    if (response && response.data) {
                        vm.billingDetails.address.country.options = response.data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.name
                            };
                        });
                    }
                }
            });
        },

        onMobileChange(number, details) {
            this.mobile.details = details;
        },

        onPhoneChange(number, details) {
            this.phone.details = details;
        },

        onWhatsappChange(number, details) {
            this.whatsapp.details = details;
        },

        onBillingDetailsMobileChange(number, details) {
            this.billingDetails.mobile.details = details;
        },

        onBillingDetailsPhoneChange(number, details) {
            this.billingDetails.phone.details = details;
        }
    }
});