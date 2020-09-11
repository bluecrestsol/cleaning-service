// script for contact requests index page
module.exports = function(data) {
    var _data = {
        config: null
    };
    return {
        data: (() => Object.assign({}, data, _data)),
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
                            {data: 'name'},
                            {data: 'message'},
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
                                targets: [1],
                                render: function(data, type, row) {
                                    var label = '';
                                    if (vm.$helper.isNotNull(data)) {
                                        label = vm.$helper.formatDate(data, 'MMMM DD, YYYY HH:mm:ss');
                                    }
                                    return label;
                                }
                            },
                            {
                                targets: [4],
                                render: function(data, type, row) {
                                    var element = '';
                                    var badge = {
                                        'new': { type: 'warning' },
                                        'processed': { type: 'success' }
                                    };
                                    if (vm.$helper.isNotNull(data)) {
                                        element = '<span class="kt-badge kt-badge--' + badge[data].type + ' kt-badge--inline">' + 
                                            vm.$t('staff/tables.contact_requests_status_'+data) + '</span>';
                                    }
                                    return element;
                                }
                            },
                            {
                                targets: [5],
                                orderable: false,
                                render: function(data, type, row) {
                                    var actions = "";
                                    var permissions = [
                                        {
                                            name: 'contact-requests-view',
                                            callback: () => { actions += "<a href='"+vm.$route('admin.contact_requests.show', data)+"' class='dropdown-item'><i class='fa fa-eye p-2 m-1 fa-lg align-middle'></i> " + vm.$t('staff/buttons.view') + "</a>"; }
                                        },
                                        {
                                            name: 'contact-requests-edit',
                                            callback: () => { actions += "<a href='"+vm.$route('admin.contact_requests.edit', data)+"' class='dropdown-item'><i class='fa fa-edit p-2 m-1 fa-lg'></i> " + vm.$t('staff/buttons.edit') + "</a>"; }
                                        },
                                        {
                                            name: 'contact-requests-delete',
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
                        list: vm.$route('admin.ajax.contact_requests.list'),
                        delete: 'admin.contact_requests.destroy'
                    },
                    notifications: {
                        delete: vm.$t('staff/notifications.contact_requests_deleted_successfully')
                    }
                };
            }
        }
    }
};