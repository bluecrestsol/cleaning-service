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
                    order: [[ 1, "desc" ]],
                    columns: [
                        {data: 'id'},
                        {data: 'created_at'},
                        {data: 'booked_at'},
                        {data: 'name'},
                        {data: 'business_name'},
                        {data: 'service'},
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
                            targets: [1, 2],
                            render: function(data, type, row) {
                                var label = '';
                                if (vm.$helper.isNotNull(data)) {
                                    label = vm.$helper.formatDate(data, 'MMMM DD, YYYY HH:mm:ss');
                                }
                                return label;
                            }
                        },
                        {
                            targets: [6],
                            render: function(data, type, row) {
                                var element = '';
                                var badge = {
                                    'new': { type: 'primary' },
                                    'processed': { type: 'success' },
                                    'deleted': { type: 'danger' }
                                };
                                if (vm.$helper.isNotNull(data)) {
                                    element = '<span class="kt-badge kt-badge--' + badge[data].type + ' kt-badge--inline">' +
                                        vm.$t('staff/tables.bookings_status_'+data) + '</span>';
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
                                        name: 'bookings-view',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.bookings.show', data)+"' class='dropdown-item'><i class='fa fa-eye p-2 m-1 fa-lg align-middle'></i> " + vm.$t('staff/buttons.view') + "</a>"; }
                                    },
                                    {
                                        name: 'bookings-edit',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.bookings.edit', data)+"' class='dropdown-item'><i class='fa fa-edit p-2 m-1 fa-lg'></i> " + vm.$t('staff/buttons.edit') + "</a>"; }
                                    },
                                    {
                                        name: 'bookings-delete',
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
                    list: vm.$route('admin.ajax.bookings.list')
                        + '?' + $.param({
                            'company': $("#active-company").val(),
                            'country': $("#active-country").val()
                        }),
                    delete: 'admin.bookings.destroy'
                },
                notifications: {
                    delete: vm.$t('staff/notifications.bookings_deleted_successfully')
                }
            };
        }
    }
});
