const Vue = require('^resources/admin/vue');
import { i18n } from '^resources/i18n';

const app = new Vue({
    el: '#app',
    i18n,
    data: function() {
        return {
            agent: {
                loading: false,
                options: [],
                value: ''
            },
            customer: {
                loading: false,
                options: [],
                billingDetails: {
                    loading: false,
                    value: null
                },
                value: ''
            },
            category: {
                loading: false,
                options: [],
                value: ''
            },
            state: {
                loading: false,
                options: [],
                value: ''
            },
            city: {
                loading: false,
                options: [],
                value: ''
            },
            district: {
                loading: false,
                options: [],
                value: ''
            },
            publicListing: {
                options: {
                    '1': true,
                    '0': false
                },
                value: ''
            },
            publicHistory: {
                options: {
                    '1': true,
                    '0': false
                },
                value: ''
            },
            publicPhotos: {
                options: {
                    '1': true,
                    '0': false
                },
                value: ''
            },
            address: {
                country: {
                    loading: false,
                    options: [],
                    value: ''
                }
            },
            billingDetails: {
                useCustomer: {
                    options: {
                        '1': true,
                        '0': false
                    },
                    value: '1'
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
        // Call initialization
        this.init();
    },
    // Watchers
    watch: {
        // If selected state is changed then get list of cities
        'state.value': function(value) {
            this.getCitiesByState(value);
        },
        // If selected city is changed then get list of districts
        'city.value': function(value) {
            this.getDistrictsByCity(value);
        },
        // If selected customer is changed then get its billing details
        'customer.value': function(value) {
            this.getCustomerBillingDetails(value);
        }
    },
    // Computed properties
    computed: {
        // Use customer's billing details
        useCustomer() {
            return this.billingDetails.useCustomer.value;
        },
        // Customer's billing details
        customerBillingDetails() {
            return this.customer.billingDetails.value;
        },
    },
    methods: {
        // Initialization
        init() {
            var vm = this;
            $(document).ready(function() {
                vm.$toaster.init();
                vm.prepareData();
                vm.initDOM();
                vm.getAgents();
                vm.getCustomers();
                vm.getCountries();
                vm.onTypeChange();
                vm.getStatesByCountry($("#active-country").val());
            });
        },
        // Initialize DOM
        initDOM() {
            var vm = this;
                $(".kt-selectpicker").selectpicker();
                $("#type").on('change', vm.onTypeChange);
                $("#main-form").submit(vm.onFormSubmit);
        },
        // On form submit
        onFormSubmit(e) {
            var vm = this;
            if (vm.billingDetails.useCustomer.value == '0') {
                var messages = vm.getNumberErrors([
                    [ 'billingDetails.mobile', 'billing details mobile'],
                    [ 'billingDetails.phone', 'billing details phone']
                ]);
                if (messages.length > 0) {
                    vm.$toaster.run([{ type: 'error', message: messages.join('<br/>') }]);
                    return false;
                }
            }
            vm.$helper.addValueToForm("#main-form", 'country_id', vm.main.country.value);
        },
        // Prepare page data
        prepareData() {
            var collection = this.main.collection;
            this.billingDetails.useCustomer.value = (collection.place ?? {}).use_customer ?? "1";
        },
        // Get list of agents by country
        getAgents() {
            var vm = this;
            vm.agent.loading = true;
            $.ajax({
                url: vm.$route('admin.ajax.agents.fetch'),
                type: 'GET',
                data: {
                    country: $("#active-country").val(),
                    status: 'enabled'
                },
                dataType: 'JSON',
                success: function (response) {
                    vm.agent.loading = false;
                    if (response && response.data) {
                        vm.agent.options = response.data.map(function(item) {
                            var code = item.code ?? '';
                            var text = vm.$helper.implode([code, item.first_name, item.middle_name, item.last_name]);
                            return {
                                id: item.id,
                                text
                            }
                        });
                    }
                }
            });
        },
        // Get list of customers by country
        getCustomers() {
            var vm = this;
            vm.customer.loading = true;
            $.ajax({
                url: vm.$route('admin.ajax.customers.fetch'),
                type: 'GET',
                data: {
                    country: $("#active-country").val()
                },
                dataType: 'JSON',
                success: function (response) {
                    vm.customer.loading = false;
                    if (response && response.data) {
                        vm.customer.options = response.data.map(function(item) {
                            var code = item.code ?? '';
                            var name = vm.$helper.implode([code, item.first_name, item.middle_name, item.last_name]);
                            return {
                                id: item.id,
                                text: vm.$helper.implode([name, item.business_name], ' - ')
                            }
                        });
                    }
                }
            });
        },
        // Get billing details of selected customer
        getCustomerBillingDetails($id) {
            var vm = this;
            if (vm.$helper.isNotNull($id)) {
                vm.customer.billingDetails.loading = true;
                $.ajax({
                    url: vm.$route('admin.ajax.customers.billing_details.get', $id),
                    type: 'GET',
                    dataType: 'JSON',
                    success: function (response) {
                        vm.customer.billingDetails.loading = false;
                        if (response && response.data) {
                            vm.customer.billingDetails.value = response.data;
                        }
                    }
                });
            } else {
                vm.customer.billingDetails.value = null;
            }
        },
        // Get list of countries
        getCountries() {
            var vm = this;
            vm.address.country.loading = true;
            vm.billingDetails.address.country.loading = true;
            $.ajax({
                url: vm.$route('admin.ajax.countries.fetch'),
                type: 'GET',
                dataType: 'JSON',
                success: function (response) {
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
                        vm.address.country.options = options;
                        vm.billingDetails.address.country.options = options;
                    }
                }
            });
        },
        // Get list of place categories by selected type
        getPlaceCategoriesByType(type) {
            var vm = this;
            if (vm.$helper.isNotNull(type)) {
                vm.category.loading = true;
                $.ajax({
                    url: vm.$route('admin.ajax.places.categories.fetch'),
                    type: 'GET',
                    data: {
                        type,
                        order: vm.$helper.formatSortParams([
                            { column: 'name', dir: 'asc' }
                        ])
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        vm.category.loading = false;
                        if (response && response.data) {
                            vm.category.options = response.data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                }
                            });
                        }
                    }
                });
            } else {
                vm.category.options = [];
            }
        },
        // On place type change
        onTypeChange() {
            this.getPlaceCategoriesByType($("#type").val());
        },
        // Get list of states by selected country
        getStatesByCountry(country) {
            var vm = this;
            vm.state.loading = true;
            $.ajax({
                url: vm.$route('admin.ajax.states.fetch'),
                type: 'GET',
                data: {
                    country
                },
                dataType: 'JSON',
                success: function (response) {
                    vm.state.loading = false;
                    if (response && response.data) {
                        vm.state.options = response.data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.name
                            }
                        });
                    }
                }
            });
        },
        // Get list of cities by selected state
        getCitiesByState(state) {
            var vm = this;
            if (vm.$helper.isNotNull(state)) {
                vm.city.loading = true;
                $.ajax({
                    url: vm.$route('admin.ajax.cities.fetch'),
                    type: 'GET',
                    data: {
                        state
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        vm.city.loading = false;
                        if (response && response.data) {
                            vm.city.options = response.data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                }
                            });
                        }
                    }
                });
            } else {
                vm.city.options = [];
            }
        },
        // Get list of districts by selected city
        getDistrictsByCity(city) {
            var vm = this;
            if (vm.$helper.isNotNull(city)) {
                vm.district.loading = true;
                $.ajax({
                    url: vm.$route('admin.ajax.districts.fetch'),
                    type: 'GET',
                    data: {
                        city,
                        order: vm.$helper.formatSortParams([
                            { column: 'name', dir: 'asc' }
                        ])
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        vm.district.loading = false;
                        if (response && response.data) {
                            vm.district.options = response.data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                }
                            });
                        }
                    }
                });
            } else {
                vm.district.options = [];
            }
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