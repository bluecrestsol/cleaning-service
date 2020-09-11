const Vue = require('^resources/admin/vue');
import { i18n } from '^resources/i18n';
const _ = require('lodash');

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
                    autoWidth: false,
                    order: [[ 0, "desc" ]],
                    columns: [
                        {data: 'id'},
                        {data: 'code'},
                        {data: 'place_name'},
                        {data: 'place_category'},
                        {data: 'city'},
                        {data: 'area'},
                        {data: 'crew_member_leader_first_name'},
                        {data: 'crew_members_count'},
                        {data: 'scheduled_at'},
                        {data: 'serviced_at'},
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
                            width: '18%'
                        },
                        {
                            targets: [4],
                            width: '18%',
                            render: function(data, type, row) {
                                var label = '';
                                [data, row['district']].map(function(item) {
                                    if (vm.$helper.isNotNull(label)) {
                                        label += ', ';
                                    }
                                    label += item ?? '';
                                });
                                return label;
                            }
                        },
                        {
                            targets: [5],
                            render: function(data, type, row) {
                                return vm.$helper.isNotNull(data) ? vm.$helper.numberWithCommas(vm.$helper.decimal(data)) : '';
                            }
                        },
                        {
                            targets: [6],
                            width: '18%',
                            render: function(data, type, row) {
                                return vm.$helper.implode([
                                    vm.$helper.getValue(data),
                                    row['crew_member_leader_middle_name'],
                                    row['crew_member_leader_last_name']
                                ]);
                            }
                        },
                        {
                            targets: [7],
                            render: function(data, type, row) {
                                return '<span class="kt-badge kt-badge--inline kt-badge--primary">' + vm.$helper.getValue(data) + '</span>';
                            }
                        },
                        {
                            targets: [8, 9],
                            render: function(data, type, row) {
                                var label = '';
                                if (vm.$helper.isNotNull(data)) {
                                    label = vm.$helper.formatDate(data, 'MMMM DD, YYYY HH:mm:ss', vm.main.collection.shared.others.timezone);
                                }
                                return label;
                            }
                        },
                        {
                            targets: [10],
                            render: function(data, type, row) {
                                var element = '';
                                var badge = {
                                    'booked': { type: 'primary' },
                                    'cancelled_by_customer': { type: 'danger' },
                                    'cancelled_by_company': { type: 'danger' },
                                    'completed': { type: 'success' },
                                };
                                if (badge.hasOwnProperty(data)) {
                                    element = '<div style="width: 180px;"><span class="kt-badge kt-badge--' + badge[data].type + ' kt-badge--inline">' + 
                                        vm.$t('staff/tables.appointments_status_'+data) + '</span></div>';
                                }
                                return element;
                            }
                        },
                        {
                            targets: [11],
                            orderable: false,
                            render: function(data, type, row) {
                                var actions = "";
                                var permissions = [
                                    {
                                        name: 'appointments-view',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.appointments.show', data)+"' class='dropdown-item'><i class='fa fa-eye p-2 m-1 fa-lg align-middle'></i> " + vm.$t('staff/buttons.view') + "</a>"; }
                                    },
                                    {
                                        name: 'appointments-edit',
                                        callback: () => { actions += "<a href='"+vm.$route('admin.appointments.edit', data)+"' class='dropdown-item'><i class='fa fa-edit p-2 m-1 fa-lg'></i> " + vm.$t('staff/buttons.edit') + "</a>"; }
                                    },
                                    {
                                        name: 'appointments-delete',
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
                    list: vm.$route('admin.ajax.appointments.list')
                        + vm.$helper.params({
                            place: vm.main.collection.place,
                            crew_member: vm.main.collection.crewMember
                        }),
                    delete: 'admin.appointments.destroy'
                },
                notifications: {
                    delete: vm.$t('staff/notifications.appointments_deleted_successfully')
                }
            };
        }
    }
});