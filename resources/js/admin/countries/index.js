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
                    serverSide: false,
                    columns: [
                        {data: 'id'},
                        {data: 'name'},
                        {data: 'code'},
                        {data: 'has_states'},
                        {data: 'has_cities'},
                        {data: 'has_districts'},
                        {data: 'has_zip'},
                        {data: 'area_unit'},
                        {data: 'languages'},
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
                            targets: [3, 4, 5, 6],
                            render: function(data, type, row, meta) {
                                var value = data ? data.toString() : '0';
                                var col = meta.col.toString();
                                var element = '';
                                var keys = {
                                    '3': 'has_states_',
                                    '4': 'has_cities_',
                                    '5': 'has_districts_',
                                    '6': 'has_zip_',
                                };
                                var badge = {
                                    '0': { type: 'danger', text: 'no' },
                                    '1': { type: 'success', text: 'yes' }
                                };
                                if (badge.hasOwnProperty(value)) {
                                    element = '<span class="kt-badge kt-badge--' + badge[value].type + ' kt-badge--inline">' +
                                        vm.$t('staff/tables.countries_'+keys[col]+badge[value].text) + '</span>';
                                }
                                return element;
                            }
                        },
                        {
                            targets: [7],
                            render: function(data, type, row, meta) {
                                return vm.$helper.isNotNull(data) ? vm.$t('staff/tables.countries_area_unit_'+data) : '';
                            }
                        },
                        {
                            targets: [8],
                            width: '12%',
                            render: function(data, type, row, meta) {
                                var col = meta.col.toString();
                                var elements = '';
                                var keys = {
                                    '8': 'english_name',
                                    '9': 'symbol'
                                };
                                var badge = {
                                    '0': { type: 'success' },
                                    '1': { type: 'primary' }
                                };
                                data.forEach(function(item) {
                                    var value = item.pivot.is_primary ? item.pivot.is_primary.toString() : '0';
                                    elements += '<span class="kt-badge kt-badge--'+badge[value].type+' kt-badge--inline">' +
                                        item[keys[col.toString()]] + '</span> ';
                                });
                                return elements;
                            }
                        },
                        {
                            targets: [9],
                            render: function(data, type, row) {
                                var element = '';
                                var badge = {
                                    'enabled': { type: 'success' },
                                    'disabled': { type: 'danger' },
                                    'draft': { type: 'warning' }
                                };
                                if (vm.$helper.isNotNull(data)) {
                                    element = '<span class="kt-badge kt-badge--' + badge[data].type + ' kt-badge--inline">' +
                                        vm.$t('staff/tables.countries_status_'+data) + '</span>';
                                }
                                return element;
                            }
                        },
                        {
                            targets: [10],
                            orderable: false,
                            render: function(data, type, row) {
                                var actions = "";
                                var permissions = [
                                    {
                                        name: 'countries-view',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.countries.show', data)+"' class='dropdown-item'><i class='fa fa-eye p-2 m-1 fa-lg align-middle'></i> " + vm.$t('staff/buttons.view') + "</a>"; }
                                    },
                                    {
                                        name: 'countries-edit',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.countries.edit', data)+"' class='dropdown-item'><i class='fa fa-edit p-2 m-1 fa-lg'></i> " + vm.$t('staff/buttons.edit') + "</a>"; }
                                    },
                                    {
                                        name: 'countries-languages-list',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.countries.languages.index', data)+"' class='dropdown-item'><i class='fa fa-language p-2 m-1 fa-lg'></i> " + vm.$t('staff/buttons.countries_languages') + "</a>"; }
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
                    list: vm.$route('admin.ajax.countries.list'),
                    delete: 'admin.countries.destroy'
                },
                notifications: {
                    delete: vm.$t('staff/notifications.countries_deleted_successfully')
                }
            };
        }
    }
});
