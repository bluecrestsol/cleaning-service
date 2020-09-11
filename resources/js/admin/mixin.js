const _ = require('lodash');
const mixin = {
    data: function() {
        return {
            main: {
                collection: {},
                pageData: null,
                company: {
                    options: [],
                    value: ''
                },
                country: {
                    options: [],
                    value: ''
                }
            }
        }
    },
    mounted() {
        var vm = this;
        $(document).ready(function() {
            var data = $("#data");
            if (data.length) {
                vm.main.pageData = JSON.parse(data.val());
            }
        });
    },
    methods: {
        onSelectTitleChanged(e) {
            $(e).closest('form').submit();
        },

        getNumberErrors(numbers) {
            var vm = this;
            var messages = [];
            numbers.forEach(function(number) {
                var key, attribute;
                if (isArray(number)) {
                    key = number[0],
                    attribute = number[1]
                } else {
                    key = attribute = number;
                }
                var details = _.get(vm, `${key}.details`);
                if (!details.isValid) {
                    messages.push(vm.$t('staff/validations.custom.phone.' + details.message, { attribute }));
                }
            });
            return messages;
        },
    }
};

module.exports = mixin;