export default {
    props: ['variables'],

    render() {
        return null;
    },

    mounted() {
        if (this.variables) {
            this.$root.main.collection = Object.assign({}, this.$root.main.collection, JSON.parse(this.variables));
        }
    }
  }