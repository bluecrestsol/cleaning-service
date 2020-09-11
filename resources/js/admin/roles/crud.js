               
const Vue = require('^resources/admin/vue');
import { i18n } from '^resources/i18n';

const app = new Vue({
    el: '#app',
    i18n,

    data: function() {
        return {
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
                $(".pcheck").on('click', function (e) {
                    if ($(this).attr('data-parent') == 0) {
                        var id = $(this).attr('id');
                        $(":checkbox[data-parent=" + id + "]").attr('checked', $(this).is(":checked"));
                    }
                });
            });
        },
    }
});