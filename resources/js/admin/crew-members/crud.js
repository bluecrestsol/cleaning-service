               
const Vue = require('^resources/admin/vue');
import { i18n } from '^resources/i18n';
const _ = require('lodash');

const app = new Vue({
    el: '#app',
    i18n,

    data: function() {
        return {
            dateOfBirth: {
                value: '',
                config: {
                },
                error: null
            },
            nationalityCountry: {
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
                    hiddenInput: "mobile_number",
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
            language: {
                list: [],
                selected: []
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
                vm.prepareData();
                $(".kt-selectpicker").selectpicker();
                $("#main-form").submit(vm.onFormSubmit);
                vm.getCountries();
                vm.getCrewLanguages();
            });
        },

        prepareData() {
            var vm = this;
            var collection = this.main.collection;
            var data = [];

            if (collection.old) {
                data.push(
                    { to: 'language.selected', from: 'languages', fallback: [] }
                );
            } else {
                data.push(
                    { to: 'language.selected', from: 'languages', fallback: [],
                        callback: function(obj) {
                            return _.map(obj, function(item) { return item.id.toString() });
                        }
                    }
                );
            }
            vm.$helper.transferValues(vm, collection.old ?? collection.crewMember, data);
        },

        onFormSubmit(e) {
            var vm = this;
            var messages = vm.getNumberErrors(['mobile', 'phone', 'whatsapp']);
            if (messages.length > 0) {
                vm.$toaster.run([{ type: 'error', message: messages.join('<br/>') }]);
                return false;
            }
            vm.$helper.addValueToForm("#main-form", 'company_id', vm.main.company.value);
            vm.$helper.addValueToForm("#main-form", 'country_id', vm.main.country.value);
        },

        getCrewLanguages() {
            var vm = this;
            $.ajax({
                url: vm.$route('admin.ajax.languages.fetch'),
                type: 'GET',
                data: {
                    order: vm.$helper.formatSortParams([
                        { column: 'english_name', dir: 'asc' },
                    ])
                },
                dataType: 'JSON',
                success: function (response) {
                    if (response && response.data) {
                        vm.language.list = response.data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.english_name
                            }
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

        // Get list of countries
        getCountries() {
            var vm = this;
            vm.nationalityCountry.loading = true;
            $.ajax({
                url: vm.$route('admin.ajax.countries.fetch'),
                type: 'GET',
                dataType: 'JSON',
                success: function (response) {
                    vm.nationalityCountry.loading = false;
                    if (response && response.data) {
                        var options = [];
                        response.data.forEach(function(item) {
                            options.push({
                                id: item.id,
                                text: item.name
                            });
                        });
                        vm.nationalityCountry.options = options;
                    }
                }
            });
        },
    }
});