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
                        {data: 'name'},
                        {data: 'questions_count'},
                        {data: 'translations_count'},
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
                            targets: [3],
                            render: function(data, type, row) {
                                return '<a class="kt-badge kt-badge--inline kt-badge--primary" href="'+vm.$route('admin.faqs_categories.questions.index', row['id'])+'">'
                                    + vm.$helper.getValue(data) + '</a>';
                            }
                        },
                        {
                            targets: [4],
                            render: function(data, type, row, meta) {
                                var languagesCount = 0;
                                var settings = meta.settings;
                                if (vm.$helper.isNotNull(settings)) {
                                    var others = settings.json.others;
                                    if (vm.$helper.isNotNull(others) && vm.$helper.isNotNull(others.languages_count)) {
                                        languagesCount = others.languages_count;
                                    }
                                }
                                return '<span class="kt-badge kt-badge--inline kt-badge--primary">'
                                    + vm.$helper.getValue(data) + '/' + languagesCount + '</span>';
                            }
                        },
                        {
                            targets: [5],
                            render: function(data, type, row) {
                                var element = '';
                                var badge = {
                                    'enabled': { type: 'success' },
                                    'disabled': { type: 'danger' }
                                };
                                if (vm.$helper.isNotNull(data)) {
                                    element = '<span class="kt-badge kt-badge--' + badge[data].type + ' kt-badge--inline">' + 
                                        vm.$t('staff/tables.faqs_categories_status_'+data) + '</span>';
                                }
                                return element;
                            }
                        },
                        {
                            targets: [6],
                            orderable: false,
                            render: function(data, type, row) {
                                var actions = "";
                                var permissions = [
                                    {
                                        name: 'faqs-categories-view',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.faqs_categories.show', data)+"' class='dropdown-item'><i class='fa fa-eye p-2 m-1 fa-lg align-middle'></i> " + vm.$t('staff/buttons.view') + "</a>"; }
                                    },
                                    {
                                        name: 'faqs-categories-edit',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.faqs_categories.edit', data)+"' class='dropdown-item'><i class='fa fa-edit p-2 m-1 fa-lg'></i> " + vm.$t('staff/buttons.edit') + "</a>"; }
                                    },
                                    {
                                        name: 'faqs-categories-delete',
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
                    list: vm.$route('admin.ajax.faqs_categories.list')
                        + '?' + $.param({
                            country: vm.main.country.value
                        }),
                    delete: 'admin.faqs_categories.destroy',
                    order: vm.$route('admin.ajax.faqs_categories.order', vm.main.country.value)
                },
                notifications: {
                    delete: vm.$t('staff/notifications.faqs_categories_deleted_successfully')
                }
            };
        }
    }
});