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
                    order: [[ 1, "asc" ]],
                    columns: [
                        {data: 'id'},
                        {data: 'code'},
                        {data: 'name'},
                        {data: 'type'},
                        {data: 'category_name'},
                        {data: 'area'},
                        {data: 'state_name'},
                        {data: 'city_name'},
                        {data: 'district_name'},
                        {data: 'financial_type'},
                        {data: 'customer_first_name'},
                        {data: 'appointments_count'},
                        {data: 'status'},
                        {data: 'id'},
                    ],
                    columnDefs: [
                        {
                            targets: [0],
                            visible: false,
                            searchable: false
                        },
                        
                        {
                            targets: [3],
                            render: function (data, type, row) {
                                return vm.$helper.isNotNull(data) ? vm.$t('staff/tables.places_type_'+data) : '';
                            }
                        },
                        {
                            targets: [5],
                            render: function (data, type, row) {
                                return vm.$helper.isNotNull(data) ? vm.$helper.decimal(data) : '';
                            }
                        },
                        {
                            targets: [4,5],
                            responsivePriority: 10001
                        },
                        {
                            targets: [9],
                            render: function(data, type, row) {
                                var element = '';
                                var badge = {
                                    'free': { type: 'warning' },
                                    'billed': { type: 'success' }
                                };
                                if (vm.$helper.isNotNull(data)) {
                                    element = '<span class="kt-badge kt-badge--' + badge[data].type + ' kt-badge--inline">' + 
                                        vm.$t('staff/tables.places_financial_type_'+data) + '</span>';
                                }
                                return element;
                            }
                        },
                        {
                            targets: [10],
                            render: function (data, type, row) {
                                return vm.$helper.getValue(data) + ' ' + vm.$helper.getValue(row['customer_last_name']);
                            }
                        },
                        {
                            targets: [11],
                            render: function(data, type, row) {
                                var link = vm.$route('admin.appointments.index')
                                    + '?' + $.param({ place: row.id });
                                return '<a href="'+link+'"><span class="kt-badge kt-badge--brand kt-badge--inline">'+data+'</span></a>';
                            }
                        },
                        {
                            targets: [12],
                            responsivePriority: 1,
                            render: function(data, type, row) {
                                var element = '';
                                var badge = {
                                    'enabled': { type: 'success' },
                                    'disabled': { type: 'danger' }
                                };
                                if (vm.$helper.isNotNull(data)) {
                                    element = '<span class="kt-badge kt-badge--' + badge[data].type + ' kt-badge--inline">' + 
                                        vm.$t('staff/tables.places_status_'+data) + '</span>';
                                }
                                return element;
                            }
                        },
                        {
                            targets: [13],
                            responsivePriority: 1,
                            orderable: false,
                            render: function(data, type, row) {
                                var actions = "";
                                var permissions = [
                                    {
                                        name: 'places-view',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.places.show', data)+"' class='dropdown-item'><i class='fa fa-eye p-2 m-1 fa-lg align-middle'></i> " + vm.$t('staff/buttons.view') + "</a>"; }
                                    },
                                    {
                                        name: 'places-edit',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.places.edit', data)+"' class='dropdown-item'><i class='fa fa-edit p-2 m-1 fa-lg'></i> " + vm.$t('staff/buttons.edit') + "</a>"; }
                                    },
                                    {
                                        name: 'places-delete',
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
                    list: vm.$route('admin.ajax.places.list')
                        + vm.$helper.params({
                            customer: vm.main.collection.customer,
                            agent: vm.main.collection.agent
                        }),
                    delete: 'admin.places.destroy'
                },
                notifications: {
                    delete: vm.$t('staff/notifications.places_deleted_successfully')
                }
            };
        }
    }
});