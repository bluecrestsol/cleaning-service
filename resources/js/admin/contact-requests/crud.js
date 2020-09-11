// script for contact requests crud page
module.exports = function(data) {
    var _data = {
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
                    $(".kt-selectpicker").selectpicker();
                    $("#main-form").submit(vm.onFormSubmit);
                });
            },

            onFormSubmit(e) {
                var vm = this;
                vm.$helper.addValueToForm("#main-form", 'company_id', vm.main.company.value);
                vm.$helper.addValueToForm("#main-form", 'country_id', vm.main.country.value);
            },
        }
    }
};