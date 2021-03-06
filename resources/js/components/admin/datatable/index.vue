<template>
    <div class="__datatable-wrapper">
        <div class="__datatable-component">
            <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" ref="modal-delete">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Are you sure?
                            </h5>
                            <button type="button" class="close" aria-label="Close" v-on:click="onCancel">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="pull-right">
                                <button class="btn btn-primary" v-on:click="onDelete">Yes</button>
                                <button type="button" class="btn btn-secondary" v-on:click="onCancel">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped- table-bordered table-hover table-checkable" ref="table" :id="id">
                <slot></slot>
            </table>
        </div>
    </div>
</template>

<script>

export default {
    props: [
        "id",
        'options',
        'url',
        'notifications'
    ],

    data() {
        return {
            table: null,
            token: null,
            deletion: null
        }
    },

    mounted: function() {
        var vm = this;
        $(document).ready(function() {
            var locale = $("#locale").val();
            vm.token = $("#token").val();
            var dt_i18n = '';
            switch(locale) {
                case 'en':
                    dt_i18n = '//cdn.datatables.net/plug-ins/1.10.20/i18n/English.json';
                break;
                case 'th':
                    dt_i18n = '//cdn.datatables.net/plug-ins/1.10.21/i18n/Thai.json';
                break;
            }
            var _defaultOptions = {
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                language: {
                    url: dt_i18n
                },
                ajax: {
                    "url": vm.url.list,
                    "type": "POST",
                    data: {
                        _token: vm.token
                    }
                },
            };

            // set options
            var _options = Object.assign({}, _defaultOptions, vm.options);
            vm.table = $(vm.$refs.table).DataTable(_options);
            vm.table.on('click', '.btn-delete-modal', function() {
                vm.deletion = vm.$route(vm.url.delete, $(this).data('item'));
                $(vm.$refs["modal-delete"]).modal('show');
            });
            
            // attach re-order event
            if (vm.options.hasOwnProperty('rowReorder')) {
                vm.addReOrderSequenceEvent();
            }
        });
    },

    methods: {
        onCancel() {
            $(this.$refs["modal-delete"]).modal('hide');
        },

        onDelete() {
            var vm = this;
            $(vm.$refs["modal-delete"]).modal('hide');
            var errorMessage = vm.$t('staff/notifications.datatable_error');
            $.ajax({
                url: vm.deletion,
                type: 'POST',
                data: { 
                    _token: vm.token,
                    _method: 'DELETE'
                },
                dataType: 'JSON'
            }).done(function(response) {
                if (response && response.success) {
                    toastr.success(vm.$helper.getValue(vm.notifications.delete));
                } else {
                    if (response.message) {
                        errorMessage = response.message;
                    }
                    toastr.error(errorMessage);
                }
                vm.table.ajax.reload(null, false);
            }).fail(function(){
                toastr.error(errorMessage);
            });
        },

        addReOrderSequenceEvent() {
            var vm = this;
            vm.table.on('row-reorder', function (e, diff, edit) {
                var list = [];
                var len = diff.length;
                for (var counter = 0; counter < len ; counter++) {
                    var detail = diff[counter];
                    var row = vm.table.row(detail.node);
                    var data = row.data();
                    data.order = detail.newData;
                    row.invalidate();

                    list.push({
                        id: data.id, 
                        order: data.order 
                    });
                }
                
                if (list.length > 0) {
                    $.ajax({
                        url: vm.url.order,
                        type: 'POST',
                        data: { 
                            _token: vm.token,
                            list
                        },
                        dataType: 'JSON'
                    }).done(function(response) {
                        toastr.success(vm.$t('staff/notifications.datatable_order_updated_successfully'));
                    }).fail(function(){
                        toastr.error(vm.$t('staff/notifications.datatable_error'));
                    });
                }
            });
        }
    }
}
</script>

<style lang="scss" scoped>
</style>