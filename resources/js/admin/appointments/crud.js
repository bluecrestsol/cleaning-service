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
            orderedAt: {
                value: '',
                error: null
            },
            scheduledAt: {
                value: '',
                error: null
            },
            servicedAt: {
                value: '',
                error: null
            },
            place: {
                loading: false,
                value: '',
                options: [],
                list: {},
                error: null
            },
            contract: {
                loading: false,
                value: '',
                options: [],
                error: null
            },
            service: {
                loading: false,
                list: [],
                selected: []
            },
            crew: {
                loading: false,
                options: [],
                leader: {
                    value: '',
                    error: null
                },
                member: {
                    list: [],
                    selected: []
                }
            },
            currency: {
                value: '',
                options: [],
                error: null
            },
            price: {
                value: '',
                error: null
            },
            payment: {
                terms: {
                    value: '',
                    error: null
                },
                dueAt: {
                    value: '',
                    config: {
                        todayBtn:"linked",
                        clearBtn:!0
                    },
                    error: null
                },
                method: {
                    value: '',
                    error: null
                },
            }
        };
    },
    mounted() {
        this.init();
    },
    // Watchers
    watch: {
        // If customer is changed, prepare datas
        "customer.id": function(value) {
            if (this.$helper.isNotNull(value)) {
                this.initDelayedControls();
                this.getPlacesByCustomer(value);
                this.getCrewMembersByCountry();
                this.getCountryCurrencies();
            } else {
                this.reset();
            }
        },
        // If crew leader is changed then show members
        "crew.leader.value": function(value) {
            var vm = this;
            if (vm.$helper.isNotNull(value)) {
                var index = _.findIndex(vm.crew.member.list, function(object) {
                    return object.id.toString() == value;
                });
                if (index != -1) {
                    vm.crew.member.list[index].value = 'false';
                }
            }
        }
    },
    methods: {
        // Initialization
        init() {
            var vm = this;
            $(document).ready(function() {
                vm.$toaster.init();
                $("#main-form").submit(vm.onFormSubmit);
                vm.prepareData();
            });
        },
        // Prepare datas
        prepareData() {
            var vm = this;
            var collection = this.main.collection;
            var data = [
                { to: 'place.value', from: 'place_id', fallback: ''},
                { to: 'contract.value', from: 'contract_id', fallback: ''},
                { to: 'price.value', from: 'price', fallback: ''},
                { to: 'payment.terms.value', from: 'payment_term', fallback: ''},
                { to: 'payment.method.value', from: 'payment_method', fallback: ''}
            ];
            var error = [
                { to: 'place.error', from: 'place_id.0', fallback: null},
                { to: 'contract.error', from: 'contract_id.0', fallback: null},
                { to: 'orderedAt.error', from: 'ordered_at.0', fallback: null},
                { to: 'scheduledAt.error', from: 'scheduled_at.0', fallback: null},
                { to: 'servicedAt.error', from: 'serviced_at.0', fallback: null},
                { to: 'crew.leader.error', from: ['crew.leader', '0'], fallback: null},
                { to: 'price.error', from: 'price.0', fallback: null},
                { to: 'payment.terms.error', from: 'payment_term.0', fallback: null},
                { to: 'payment.dueAt.error', from: 'payment_due_at.0', fallback: null},
                { to: 'payment.method.error', from: 'payment_method.0', fallback: null},
            ];

            if (collection.old) {
                data.push(
                    { to: 'service.selected', from: 'services', fallback: [] },
                    { to: 'crew.leader.value', from: 'crew.leader', fallback: '' },
                    { to: 'crew.member.selected', from: 'crew.members', fallback: '' },
                    { to: 'orderedAt.value', from: 'ordered_at', fallback: '' },
                    { to: 'scheduledAt.value', from: 'scheduled_at', fallback: '' },
                    { to: 'servicedAt.value', from: 'serviced_at', fallback: '' },
                    { to: 'payment.dueAt.value', from: 'payment_due_at', fallback: '' }
                );
            } else {
                data.push(
                    { to: 'service.selected', from: 'services', fallback: [],
                        callback: function(obj) {
                            return _.map(obj, function(item) { return item.id.toString() });
                        }
                    },
                    { to: 'orderedAt.value', from: 'ordered_at', fallback: '',
                        callback: function(value) {
                            return vm.$helper.formatDate(value, 'MM/DD/YYYY HH:mm', vm.main.collection.shared.others.timezone) ?? '';
                        }
                    },
                    { to: 'scheduledAt.value', from: 'scheduled_at', fallback: '',
                        callback: function(value) {
                            return vm.$helper.formatDate(value, 'MM/DD/YYYY HH:mm', vm.main.collection.shared.others.timezone) ?? '';
                        }
                    },
                    { to: 'servicedAt.value', from: 'serviced_at', fallback: '',
                        callback: function(value) {
                            return vm.$helper.formatDate(value, 'MM/DD/YYYY HH:mm', vm.main.collection.shared.others.timezone) ?? '';
                        }
                    },
                    { to: 'payment.dueAt.value', from: 'payment_due_at', fallback: '',
                        callback: function(value) {
                            return vm.$helper.toUtcFormat(value, 'MM/DD/YYYY') ?? '';
                        }
                    },
                    { to: 'crew.leader.value', from: 'crew_members', fallback: [],
                        callback: function(obj) {
                            return (obj.length > 0) ? (_.get(obj[0], 'id', '').toString()) : '';
                        }
                    },
                    { to: 'crew.member.selected', from: 'crew_members', fallback: [],
                        callback: function(obj) {
                            return (obj.length > 0) ? _.map(obj.slice(1), function(item) { return item.id.toString() }) : [];
                        }
                    }
                );
            }
            vm.$helper.transferValues(vm, collection.old ?? collection.appointment, data);
            vm.$helper.transferValues(vm, collection.error, error);

            if (this.$helper.isNotNull(this.customer.code.value)) {
                this.onBlur(this.customer.code.value);
            }
        },
        // On form submit
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
            this.addArrayValues(this.service.list, 'services[]');
            this.addArrayValues(this.crew.member.list, 'crew[members][]');
        },
        // Add extra array values to form
        addArrayValues(list, name) {
            var vm = this;
            list.forEach(function(item) {
                if (item.value == 'true') {
                    vm.$helper.addValueToForm("#main-form", name, item.id)
                }
            });
        },
        // Delay initial controls
        initDelayedControls() {
            var vm = this;
            this.$nextTick(function() {
                $(".kt-selectpicker").selectpicker();
                $(vm.$refs['payment-terms']).on('change', function() {
                    vm.setPaymentTerms($(this).val());
                });
                vm.setPaymentTerms($(vm.$refs['payment-terms']).val());
            });
        },
        // Reset/clear datas
        reset() {
            this.place.value = '';
            this.place.options = [];
            this.place.list = {};
            this.place.error = null;

            this.scheduledAt.value = '';
            this.scheduledAt.error = null;

            this.service.list = [];
            this.service.selected = [];

            this.crew.options = [];
            this.crew.leader.value = '';
            this.crew.leader.error = null;
            this.crew.member.list = [];
            this.crew.member.selected = [];

            this.price.value = '';
            this.price.error = null;

            this.payment.terms.value = '';
            this.payment.terms.error = null;
            this.payment.dueAt.value = '';
            this.payment.dueAt.error = null;
            this.payment.method.value = '';
            this.payment.method.error = null;
        },
        // Set payment terms
        setPaymentTerms(value) {
            this.payment.terms.value = value;
        },
        // On blur event for customer code field
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
        // On key up event for customer code field
        onKeyup(value) {
            var vm = this;
            if (vm.$helper.isNotNull(vm.customer.code.error)) {
                vm.customer.code.error = null;
            }
        },
        // Get list of places by customer
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
                        var list = {};
                        vm.place.options = response.data.map(function(item) {
                            list[item.id] = item;
                            var area = '';
                            if (vm.$helper.isNotNull(item.area)) {
                                var unit = '';
                                if (vm.$helper.isNotNull(item.country.area_unit)) {
                                    unit = vm.$t('staff/forms.appointments_place_country_area_unit_'+item.country.area_unit);
                                }
                                area = ` (${vm.$helper.numberWithCommas(vm.$helper.decimal(item.area))} ${unit})`;
                            }
                            return {
                                id: item.id,
                                text: `${item.name}${area}`
                            }
                        });
                        vm.place.list = list;
                    }
                }
            });
        },
        // Get list of services by type
        getServicesByType(type) {
            var vm = this;
            if (vm.$helper.isNotNull(type)) {
                vm.service.loading = true;
                $.ajax({
                    url: vm.$route('admin.ajax.services.fetch'),
                    type: 'GET',
                    data: {
                        company: vm.main.company.value,
                        country: vm.main.country.value,
                        status: 'enabled',
                        type
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        vm.service.loading = false;
                        if (response && response.data) {
                            vm.service.list = response.data.map(function(item) {
                                var value = vm.service.selected.includes(item.id.toString()) ? 'true' : 'false';
                                return {
                                    id: item.id,
                                    text: item.name,
                                    value
                                }
                            });
                        }
                    }
                });
            } else {
                vm.service.list = [];
            }
        },
        // Get list of crew members by country
        getCrewMembersByCountry() {
            var vm = this;
            vm.crew.loading = true;
            $.ajax({
                url: vm.$route('admin.ajax.crew_members.fetch'),
                type: 'GET',
                data: {
                    company: $("#active-company").val(),
                    country: $("#active-country").val(),
                    order: vm.$helper.formatSortParams([
                        { column: 'first_name', dir: 'asc' },
                        { column: 'middle_name', dir: 'asc' },
                        { column: 'last_name', dir: 'asc' }
                    ])
                },
                dataType: 'JSON',
                success: function (response) {
                    vm.crew.loading = false;
                    if (response && response.data) {
                        var list = [];
                            vm.crew.options = response.data.map(function(item) {
                            var text = vm.$helper.implode([item.first_name, item.middle_name, item.last_name]);
                            var value = vm.crew.member.selected.includes(item.id.toString()) ? 'true' : 'false';
                            list.push({
                                id: item.id,
                                text,
                                value
                            });
                            return {
                                id: item.id,
                                text,
                            }
                        });
                        vm.crew.member.list = list;
                    }
                }
            });
        },
        // Get list of country currencies
        getCountryCurrencies() {
            var vm = this;
            vm.currency.loading = true;
            $.ajax({
                url: vm.$route('admin.ajax.countries.currencies.fetch', $("#active-country").val()),
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
        // On place changed
        onPlaceChanged(e) {
            var value = $(e).val();
            var type = null;
            if (this.place.list.hasOwnProperty(value)) {
                type = this.place.list[value].category.type;
            }
            this.getContractsByPlace(value);
            this.getServicesByType(type);
        },
        getContractsByPlace(place) {
            var vm = this;
            if (vm.$helper.isNotNull(place)) {
                vm.contract.loading = true;
                $.ajax({
                    url: vm.$route('admin.ajax.contracts.fetch'),
                    type: 'GET',
                    data: {
                        place,
                        order: vm.$helper.formatSortParams([
                            { column: 'started_at', dir: 'asc' },
                        ])
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        vm.contract.loading = false;
                        if (response && response.data) {
                            vm.contract.options = response.data.map(function(item) {
                                var started_at = vm.$helper.formatDate(item.started_at, 'MM/DD/YYYY') ?? '';
                                var ended_at = vm.$helper.formatDate(item.ended_at, 'MM/DD/YYYY') ?? '';
                                var text = `${item.code} ${started_at} - ${ended_at}`;
                                return {
                                    id: item.id,
                                    text
                                }
                            });
                        }
                    }
                });
            } else {
                vm.contract.options = [];
            }
        }
    }
});
