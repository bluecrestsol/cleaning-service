<template>
    <div class="__input-wrapper">
        <input type="hidden" :name="name" :value="realValue">
        <input type="text" class="form-control" :class="ControlClass" v-model="realValue" @blur="onBlur" @keyup="onKeyup">
        <div class="invalid-feedback" v-if="realError">{{ realError }}</div>
    </div>
</template>

<script>
export default {
    props: [
        "value",
        "initial",
        "name",
        "error",
        "initialError"
    ],

    data() {
        return {
        }
    },

   mounted: function() {
        var vm = this;
        if (vm.$helper.isNotNull(vm.initial)) {
            vm.setValue(vm.initial);
        }
        if (vm.$helper.isNotNull(vm.initialError)) {
            vm.setError(vm.initialError);
        }
    },

    computed: {
        ControlClass() {
            return { 'is-invalid': this.realError };
        },

        realValue: {
            get() {
                return this.value;
            },

            set(value) {
                this.setValue(value);
            }
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
        setValue(value) {
            this.$emit('input', value);
        },

        setError(value) {
            this.$emit('update:error', value);
        },

        onBlur() {
            this.$emit('blur', this.value);
        },
        
        onKeyup($event) {
            this.$emit('keyup', $event.target.value);
        },
    }
}
</script>

<style lang="scss" scoped>
</style>