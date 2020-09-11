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
            state: {
                loading: false,
                options: [],
                value: ''
            },
            city: {
                loading: false,
                options: [],
                value: ''
            }
        };
    },

    mounted() {
        this.init();
    },

    watch: {
        'country.value': function(value) {
            this.getStatesByCountry(value);
        },

        'state.value': function(value) {
            this.getCitiesByCountryAndState(this.country.value, value);
        }
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

        initDOM() {
        },

        prepareData() {
        },

        getStatesByCountry(country)
        {
            var vm = this;
            if (vm.$helper.isNotNull(country)) {
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
            } else {
                vm.state.options = [];
            }
        },

        getCitiesByCountryAndState(country, state)
        {
            var vm = this;
            if (vm.$helper.isNotNull(state)) {
                vm.city.loading = true;
                $.ajax({
                    url: vm.$route('admin.ajax.cities.fetch'),
                    type: 'GET',
                    data: {
                        country,
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
        }
    }
});