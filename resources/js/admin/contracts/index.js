const Vue = require('^resources/admin/vue');
import { i18n } from '^resources/i18n';

const app = new Vue({
    el: '#app',
    i18n,

    data: function() {
        return {
            config: null
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
                vm.setConfig();
            });
        },

        setConfig() {
            var vm = this;
            vm.config = {
                options: {
                    order: [[ 2, "asc" ]],
                    columns: [
                        {data: 'id'},
                        {data: 'code'},
                        {data: 'customer_first_name'},
                        {data: 'place_name'},
                        {data: 'started_at'},
                        {data: 'ended_at'},
                        {data: 'frequency'},
                        {data: 'price'},
                        {data: 'id', responsivePriority: -1},
                    ],
                    columnDefs: [
                        {
                            targets: [0],
                            visible: false,
                            searchable: false
                        },
                        {
                            targets: [2],
                            render: function ( data, type, row ) {
                                var firstName = data ?? '';
                                var middleName = row.customer_middle_name ?? '';
                                var lastName = row.customer_last_name ?? '';
                                return firstName + ' ' + middleName + ' ' + lastName;
                            }
                        },
                        {
                            targets: [4, 5],
                            render: function ( data, type, row ) {
                                var label = '';
                                if (vm.$helper.isNotNull(data)) {
                                    label = vm.$helper.formatDate(data, 'MMMM DD, YYYY');
                                }
                                return label;
                            }
                        },
                        {
                            targets: [6],
                            render: function ( data, type, row ) {
                                return vm.$helper.isNotNull(data) ? vm.$t(`staff/tables.contracts_frequency_${data}`) : '';
                            }
                        },
                        {
                            targets: [7],
                            render: function ( data, type, row ) {
                                var price = vm.$helper.isNotNull(data) ? vm.$helper.numberWithCommas(vm.$helper.decimal(data)) : '';
                                return  price + (vm.$helper.isNotNull(row.price_unit) ? 
                                    (' / ' + vm.$t(`staff/tables.contracts_price_unit_${row.price_unit}`)) : '');
                            }
                        },
                        {
                            targets: [8],
                            orderable: false,
                            render: function(data, type, row) {
                                var actions = "";
                                var permissions = [
                                    {
                                        name: 'contracts-view',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.contracts.show', data)+"' class='dropdown-item'><i class='fa fa-eye p-2 m-1 fa-lg align-middle'></i> " + vm.$t('staff/buttons.view') + "</a>"; }
                                    },
                                    {
                                        name: 'contracts-edit',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.contracts.edit', data)+"' class='dropdown-item'><i class='fa fa-edit p-2 m-1 fa-lg'></i> " + vm.$t('staff/buttons.edit') + "</a>"; }
                                    },
                                    {
                                        name: 'contracts-delete',
                                        callback: () => { actions += "<button class='icon-button dropdown-item btn-delete-modal' data-item='["+data+"]'><i class='fa fa-trash-alt p-2 m-1 fa-lg'></i> " + vm.$t('staff/buttons.delete') + "</button>"; }
                                    }
                                ];
                                // generate action buttons
                                permissions.forEach(function(permission) {
                                    if (vm.$permission.has(permission.name)) {
                                        permission.callback();
                                    }
                                });
                                // if no action buttons
                                if (actions === "") {
                                    actions += "<i>No permission to take any action.</i>";
                                }
                                return "<div class='dropdown'>" +
                                        "<button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton-" + data + "' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>"+vm.$t('staff/buttons.actions')+"</button>" +
                                        "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton-" + data + "' x-placement='bottom-start' style='position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);'>" +
                                            "<div>" + actions + "</div>" +
                                        "</div>" +
                                    "</div>";
                            }
                        }
                    ]
                },
                url: {
                    list: vm.$route('admin.ajax.contracts.list'),
                    delete: 'admin.contracts.destroy'
                },
                notifications: {
                    delete: vm.$t('staff/notifications.contracts_deleted_successfully')
                }
            };
        }
    }
});