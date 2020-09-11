<template>
    <div class="__datetimepicker-wrapper">
        <input type="text" class="form-control" :class="ControlClass" :name="name" ref="input">
        <div class="invalid-feedback" v-if="realError">{{ realError }}</div>
    </div>
</template>

<script>
export default {
    props: [
        "value",
        "initial",
        "name",
        "config",
        "error",
        "initialError"
    ],

    data() {
        return {
            default: {
                config: {
                    todayHighlight: !0,
                    autoclose: !0,
                    format: "mm/dd/yyyy hh:ii"
                }
            }
        }
    },

   mounted: function() {
        var vm = this;
        $(document).ready(function() {
            vm.default.config = Object.assign({}, vm.default.config, vm.config);
            $(vm.$refs.input).datetimepicker(vm.default.config)
                .on('changeDate', function(event){
                    vm.onDateChanged(event);
                });;
            var initial = (vm.$helper.isNotNull(vm.initial)) ? vm.initial : vm.value;
            vm.setValue(initial);

            if (vm.$helper.isNotNull(vm.initialError)) {
                vm.setError(vm.initialError);
            }
        });
    },

    watch: {
        value(value) {
            this.setValue(value);
        }
    },

    computed: {
        ControlClass() {
            return { 'is-invalid': this.realError };
        },

        realError: {
            get() {
                return this.error;
            },

            set(value) {
                this.setError(value);
            }
        }
    },

    methods: {
        onDateChanged(event) {
            this.$emit('input', event.target.value);
        },

        setValue(value) {
            if (this.$helper.isNotNull(value)) {
                var dt = value;
                if (!(value instanceof Date)) {
                    dt = new Date(value)
                }
                $(this.$refs.input).data("datetimepicker").setDate(dt);
            } else {
                $(this.$refs.input).val('');
                $(this.$refs.input).datetimepicker('update');
            }
        },

        setError(value) {
            this.$emit('update:error', value);
        },
    },

    destroyed() {
        $(this.$refs.input).datetimepicker('remove');
    }
}
</script>

<style lang="scss" scoped>
</style>