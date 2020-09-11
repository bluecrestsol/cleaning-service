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
                        {data: 'first_name'},
                        {data: 'business_name'},
                        {data: 'country'},
                        {data: 'places_count'},
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
                                return vm.$helper.getValue(data) + ' ' + vm.$helper.getValue(row.last_name);
                            }
                        },
                        {
                            targets: [4],
                            orderable: false,
                            render: function(data, type, row) {
                                var label = '';
                                if (vm.$helper.isNotNull(data)) {
                                    label = vm.$helper.getValue(data.name);
                                }
                                return label;
                            }
                        },
                        {
                            targets: [5],
                            render: function(data, type, row) {
                                var link = vm.$route('admin.places.index')
                                    + '?' + $.param({ customer: row.id });
                                return '<a href="'+link+'"><span class="kt-badge kt-badge--brand kt-badge--inline">'+data+'</span></a>';
                            }
                        },
                        {
                            targets: [6],
                            orderable: false,
                            render: function(data, type, row) {
                                var actions = "";
                                var permissions = [
                                    {
                                        name: 'customers-view',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.customers.show', data)+"' class='dropdown-item'><i class='fa fa-eye p-2 m-1 fa-lg align-middle'></i> " + vm.$t('staff/buttons.view') + "</a>"; }
                                    },
                                    {
                                        name: 'customers-edit',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.customers.edit', data)+"' class='dropdown-item'><i class='fa fa-edit p-2 m-1 fa-lg'></i> " + vm.$t('staff/buttons.edit') + "</a>"; }
                                    },
                                    {
                                        name: 'customers-delete',
                                        callback: () => { actions += "<button class='icon-button dropdown-item btn-delete-modal' data-item='["+data+"]'><i class='fa fa-trash-alt p-2 m-1 fa-lg'></i> " + vm.$t('staff/buttons.delete') + "</button>"; }
                                    },
                                    {
                                        name: 'customers-notes-list',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.customers.notes.index', data)+"' class='dropdown-item'><i class='fas fa-sticky-note p-2 m-1 fa-lg'></i> "
                                            + `${row.notes_count} ` + vm.$t('staff/buttons.customers_notes') + "</a>"; }
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
                    list: vm.$route('admin.ajax.customers.list')
                        + '?' + $.param({
                            'company': $("#active-company").val(),
                            'country': $("#active-country").val()
                        }),
                    delete: 'admin.customers.destroy'
                },
                notifications: {
                    delete: vm.$t('staff/notifications.customers_deleted_successfully')
                }
            };
        }
    }
});