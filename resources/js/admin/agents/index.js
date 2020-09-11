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
                        {data: 'first_name'},
                        {data: 'gender'},
                        {data: 'age'},
                        {data: 'nationality_country'},
                        {data: 'type'},
                        {data: 'places_count'},
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
                            render: function ( data, type, row ) {
                                return (data ?? '') + ' ' + (row['middle_name'] ?? '') + ' ' + (row['last_name'] ?? '')
                            }
                        },
                        {
                            targets: [3],
                            render: function ( data, type, row ) {
                                return vm.$helper.capitalize(data);
                            }
                        },
                        {
                            targets: [5],
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
                            targets: [6],
                            render: function(data, type, row) {
                                var element = '';
                                var badge = {
                                    'hired': { type: 'primary' },
                                    'freelancer': { type: 'dark' }
                                };
                                if (vm.$helper.isNotNull(data)) {
                                    element = '<span class="kt-badge kt-badge--' + badge[data].type + ' kt-badge--inline">' + 
                                        vm.$t('staff/tables.agents_type_'+data) + '</span>';
                                }
                                return element;
                            }
                        },
                        {
                            targets: [7],
                            render: function(data, type, row) {
                                var link = vm.$route('admin.places.index')
                                    + '?' + $.param({ agent: row.id });
                                return '<a href="'+link+'"><span class="kt-badge kt-badge--brand kt-badge--inline">'+data+'</span></a>';
                            }
                        },
                        {
                            targets: [8],
                            render: function(data, type, row) {
                                var element = '';
                                var badge = {
                                    'enabled': { type: 'success' },
                                    'disabled': { type: 'danger' },
                                    'dismissed': { type: 'dark' }
                                };
                                if (vm.$helper.isNotNull(data)) {
                                    element = '<span class="kt-badge kt-badge--' + badge[data].type + ' kt-badge--inline">' + 
                                        vm.$t('staff/tables.agents_status_'+data) + '</span>';
                                }
                                return element;
                            }
                        },
                        {
                            targets: [9],
                            orderable: false,
                            render: function(data, type, row) {
                                var actions = "";
                                var permissions = [
                                    {
                                        name: 'agents-view',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.agents.show', data)+"' class='dropdown-item'><i class='fa fa-eye p-2 m-1 fa-lg align-middle'></i> " + vm.$t('staff/buttons.view') + "</a>"; }
                                    },
                                    {
                                        name: 'agents-edit',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.agents.edit', data)+"' class='dropdown-item'><i class='fa fa-edit p-2 m-1 fa-lg'></i> " + vm.$t('staff/buttons.edit') + "</a>"; }
                                    },
                                    {
                                        name: 'agents-delete',
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
                    list: vm.$route('admin.ajax.agents.list')
                        + '?' + $.param({
                            'company': $("#active-company").val(),
                            'country': $("#active-country").val()
                        }),
                    delete: 'admin.agents.destroy'
                },
                notifications: {
                    delete: vm.$t('staff/notifications.agents_deleted_successfully')
                }
            };
        }
    }
});