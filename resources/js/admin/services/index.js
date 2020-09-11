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
                    paging: false,
                    columns: [
                        {data: 'id'},
                        {data: 'order'},
                        {data: 'type'},
                        {data: 'name'},
                        {data: 'price'},
                        {data: 'discounted_price'},
                        {data: 'status'},
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
                            render: function (data, type, row) {
                                return vm.$helper.isNotNull(data) ? vm.$t('staff/tables.services_type_'+data) : '';
                            }
                        },
                        {
                            targets: [4, 5],
                            render: function ( data, type, row ) {
                                return vm.$helper.isNotNull(data) ? vm.$helper.numberWithCommas(vm.$helper.decimal(data)) : '';
                            }
                        },
                        {
                            targets: [6],
                            render: function(data, type, row) {
                                var element = '';
                                var badge = {
                                    'enabled': { type: 'success' },
                                    'disabled': { type: 'danger' }
                                };
                                if (vm.$helper.isNotNull(data)) {
                                    element = '<span class="kt-badge kt-badge--' + badge[data].type + ' kt-badge--inline">' + 
                                        vm.$t('staff/tables.services_status_'+data) + '</span>';
                                }
                                return element;
                            }
                        },
                        {
                            targets: [7],
                            orderable: false,
                            render: function(data, type, row) {
                                var actions = "";
                                var permissions = [
                                    {
                                        name: 'services-view',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.services.show', data)+"' class='dropdown-item'><i class='fa fa-eye p-2 m-1 fa-lg align-middle'></i> " + vm.$t('staff/buttons.view') + "</a>"; }
                                    },
                                    {
                                        name: 'services-edit',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.services.edit', data)+"' class='dropdown-item'><i class='fa fa-edit p-2 m-1 fa-lg'></i> " + vm.$t('staff/buttons.edit') + "</a>"; }
                                    },
                                    {
                                        name: 'services-delete',
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
                    ],
                    rowReorder: {
                        dataSrc: 'order',
                        update: false,
                        selector: 'td:not(:last-child)'
                    }
                },
                url: {
                    list: vm.$route('admin.ajax.services.list')
                        + '?' + $.param({
                            country: vm.main.country.value
                        }),
                    delete: 'admin.services.destroy',
                    order: vm.$route('admin.ajax.services.order', vm.main.country.value)
                },
                notifications: {
                    delete: vm.$t('staff/notifications.services_deleted_successfully')
                }
            };
        }
    }
});