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
                        {data: 'status'},
                        {data: 'is_primary'},
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
                            render: function(data, type, row) {
                                var element = '';
                                var badge = {
                                    'enabled': { type: 'success' },
                                    'disabled': { type: 'danger' },
                                    'draft': { type: 'warning' }
                                };
                                if (vm.$helper.isNotNull(data)) {
                                    element = '<span class="kt-badge kt-badge--' + badge[data].type + ' kt-badge--inline">' + 
                                        vm.$t('staff/tables.countries_languages_status_'+data) + '</span>';
                                }
                                return element;
                            }
                        },
                        {
                            targets: [3],
                            render: function(data, type, row, meta) {
                                var value = data ? data.toString() : '0';
                                var element = '';
                                var badge = {
                                    '0': { type: 'danger', text: 'no' },
                                    '1': { type: 'success', text: 'yes' }
                                };
                                if (badge.hasOwnProperty(value)) {
                                    element = '<span class="kt-badge kt-badge--' + badge[value].type + ' kt-badge--inline">' + 
                                        vm.$t('staff/tables.countries_languages_is_primary_'+badge[value].text) + '</span>';
                                }
                                return element;
                            }
                        },
                        {
                            targets: [4],
                            orderable: false,
                            render: function(data, type, row) {
                                var actions = "";
                                var permissions = [
                                    {
                                        name: 'countries-currencies-edit',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.countries.currencies.edit', [ vm.main.pageData.country.id, data ])+"' class='dropdown-item'><i class='fa fa-edit p-2 m-1 fa-lg'></i> " + vm.$t('staff/buttons.edit') + "</a>"; }
                                    },
                                    {
                                        name: 'countries-currencies-delete',
                                        callback: () => { actions += "<button class='icon-button dropdown-item btn-delete-modal' data-item='["+vm.main.pageData.country.id+", "+data+"]'><i class='fa fa-trash-alt p-2 m-1 fa-lg'></i> " + vm.$t('staff/buttons.delete') + "</button>"; }
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
                    list: vm.$route('admin.ajax.countries.currencies.list', vm.main.pageData.country.id),
                    delete: 'admin.countries.currencies.destroy'
                },
                notifications: {
                    delete: vm.$t('staff/notifications.countries_currencies_deleted_successfully')
                }
            };
        }
    }
});