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
                        {data: 'name'},
                        {data: 'country'},
                        {data: 'serviced_countries'},
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
                            targets: [3],
                            width: '20%',
                            orderable: false,
                            render: function(data, type, row, meta) {
                                var elements = '';
                                if (vm.$helper.isNotNull(data)) {
                                    data.forEach(function(item) {
                                        elements += '<span class="kt-badge kt-badge--primary kt-badge--inline">' +
                                            vm.$helper.getValue(item.name) + '</span> ';
                                    });
                                }
                                return elements;
                            }
                        },
                        {
                            targets: [4],
                            orderable: false,
                            render: function(data, type, row) {
                                var actions = "";
                                var permissions = [
                                    {
                                        name: 'companies-view',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.companies.show', data)+"' class='dropdown-item'><i class='fa fa-eye p-2 m-1 fa-lg align-middle'></i> " + vm.$t('staff/buttons.view') + "</a>"; }
                                    },
                                    {
                                        name: 'companies-edit',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.companies.edit', data)+"' class='dropdown-item'><i class='fa fa-edit p-2 m-1 fa-lg'></i> " + vm.$t('staff/buttons.edit') + "</a>"; }
                                    },
                                    {
                                        name: 'companies-countries-list',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.companies.countries.index', data)+"' class='dropdown-item'><i class='fa fa-globe p-2 m-1 fa-lg'></i> " + vm.$t('staff/buttons.companies_countries') + "</a>"; }
                                    },
                                    {
                                        name: 'companies-delete',
                                        callback: () => { actions += "<button class='icon-button dropdown-item btn-delete-modal' data-item='["+data+"]'><i class='fa fa-trash-alt p-2 m-1 fa-lg'></i> " + vm.$t('staff/buttons.delete') + "</button>"; }
                                    },
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
                    list: vm.$route('admin.ajax.companies.list'),
                    delete: 'admin.companies.destroy'
                },
                notifications: {
                    delete: vm.$t('staff/notifications.companies_deleted_successfully')
                }
            };
        }
    }
});