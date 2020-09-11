const Vue = require('^resources/admin/vue');
import { i18n } from '^resources/i18n';
const _ = require('lodash');

const app = new Vue({
    el: '#app',
    i18n,

    data: function() {
        return {
            customer: {
                code: {
                    loading: false,
                    value: '',
                    error: null
                },
                id: null,
                title: null,
                first_name: null,
                last_name: null,
                business_name: null
            },
            place: {
                loading: false,
                value: '',
                options: [],
                error: null
            },
            frequency: {
                value: '',
                error: null
            },
            priceUnit: {
                value: '',
                error: null
            },
            price: {
                value: '',
                error: null
            },
            startsAt: {
                value: '',
                error: null
            },
            endsAt: {
                value: '',
                error: null
            },
        };
    },

    mounted() {
        this.init();
    },

    watch: {
        "customer.id": function(value) {
            if (this.$helper.isNotNull(value)) {
                this.initDelayedControls();
                this.getPlacesByCustomer(value);
            } else {
                this.reset();
            }
        }
    },

    methods: {
        init() {
            var vm = this;
            $(document).ready(function() {
                vm.$toaster.init();
                $("#main-form").submit(vm.onFormSubmit);
                vm.prepareData();
            });
        },

        prepareData() {
            var vm = this;
            var collection = this.main.collection;
            var data = [
                { to: 'place.value', from: 'place_id', fallback: ''},
                { to: 'frequency.value', from: 'frequency', fallback: ''},
                { to: 'priceUnit.value', from: 'price_unit', fallback: ''},
                { to: 'price.value', from: 'price', fallback: ''},
            ];
            var error = [
                { to: 'place.error', from: 'place_id.0', fallback: null},
                { to: 'frequency.error', from: 'frequency.0', fallback: null},
                { to: 'priceUnit.error', from: 'price_unit.0', fallback: null},
                { to: 'price.error', from: 'price.0', fallback: null},
                { to: 'startsAt.error', from: 'started_at.0', fallback: null},
                { to: 'endsAt.error', from: 'ended_at.0', fallback: null},
            ];

            if (collection.old) {
                data.push(
                    { to: 'startsAt.value', from: 'started_at', fallback: '' },
                    { to: 'endsAt.value', from: 'ended_at', fallback: '' },
                );
            } else {
                data.push(
                    { to: 'startsAt.value', from: 'started_at', fallback: '',
                        callback: function(value) {
                            return vm.$helper.toUtcFormat(value, 'MM/DD/YYYY') ?? '';
                        }
                    },
                    { to: 'endsAt.value', from: 'ended_at', fallback: '',
                        callback: function(value) {
                            return vm.$helper.toUtcFormat(value, 'MM/DD/YYYY') ?? '';
                        }
                    }
                );
            }
            vm.$helper.transferValues(vm, collection.old ?? collection.contract, data);
            vm.$helper.transferValues(vm, collection.error, error);

            if (this.$helper.isNotNull(this.customer.code.value)) {
                this.onBlur(this.customer.code.value);
            }
        },

        onFormSubmit(e) {
            if (this.customer.code.loading) {
                this.$toaster.run([{ type:'error', message: this.$t('staff/validations.custom.form.cannot') }]);
                return false;
            }
            else if (!this.$helper.isNotNull(this.customer.id)) {
                var message = (this.$helper.isNotNull(this.customer.code.value)) ? this.$t('staff/validations.custom.customer_code.exists')
                    : this.$t('staff/validations.custom.customer_code.empty');
                this.$toaster.run([{ type:'error', message }]);
                return false;
            }
            this.$helper.addValueToForm("#main-form", 'country_id', this.main.country.value);
        },

        initDelayedControls() {
            var vm = this;
            this.$nextTick(function() {
                $(".kt-selectpicker").selectpicker();
            });
        },

        reset() {
            // place
            this.place.value = '';
            this.place.options = [];
            this.place.error = null;
            // frequency
            this.frequency.value = '';
            this.frequency.error = null;
            // price unit
            this.priceUnit.value = '';
            this.priceUnit.error = null;
            // price
            this.price.value = '';
            this.price.error = null;
            // starts at
            this.startsAt.value = '';
            this.startsAt.error = null;
            // ends at
            this.endsAt.value = '';
            this.endsAt.error = null;
        },

        onBlur(code) {
            var vm = this;
            var data = {
                id: null,
                title: null,
                first_name: null,
                last_name: null,
                business_name: null
            };
            if (vm.$helper.isNotNull(code)) {
                vm.customer.code.loading = true;
                $.ajax({
                    url: vm.$route('admin.ajax.customers.fetch'),
                    type: 'GET',
                    data: {
                        code 
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        vm.customer.code.loading = false;
                        var error = vm.$t('staff/validations.custom.customer_code.exists');
                        if (response && response.data) {
                            if (response.data.length > 0) {
                                var item = response.data[0];
                                data.id = item.id;
                                data.title = item.title;
                                data.first_name = item.first_name;
                                data.last_name = item.last_name;
                                data.business_name = item.business_name;
                                error = null;
                            }
                        }
                        vm.customer.code.error = error;
                        vm.customer = Object.assign({}, vm.customer, data);
                    }
                });
            } else {
                vm.customer = Object.assign({}, vm.customer, data);
            }
        },

        onKeyup(value) {
            var vm = this;
            if (vm.$helper.isNotNull(vm.customer.code.error)) {
                vm.customer.code.error = null;
            }
        },

        getPlacesByCustomer(customer) {
            var vm = this;
            vm.place.loading = true;
            $.ajax({
                url: vm.$route('admin.ajax.places.fetch'),
                type: 'GET',
                data: {
                    customer,
                    status: 'enabled'
                },
                dataType: 'JSON',
                success: function (response) {
                    vm.place.loading = false;
                    if (response && response.data) {
                        vm.place.options = response.data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.name
                            }
                        });
                    }
                }
            });
        },

        onPlaceChanged(e) {
        }
    }
});