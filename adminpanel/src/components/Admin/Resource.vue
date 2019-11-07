<script>
    import createResourceModule from '@/store/resource'

    export default {
        name: "Resource",
        props: {
            name: {
                type: String,
                required: true
            },
            list: {
                type: Object
            },
            edit: {
                type: Object
            },
            create: {
                type: Object
            },
            title: {
                type: String,
                required: true
            }
        },
        render() {
            return null
        },
        mounted() {
            this.$router.addRoutes([
                {
                    name: `resources.${this.name}.list`,
                    path: `/${this.name}`,
                    component: this.list,
                    props: {resourceName: this.name}
                },
                {
                    name: `resources.${this.name}.edit`,
                    path: `/${this.name}/:id/edit`,
                    component: this.edit,
                    props: {resourceName: this.name}
                },
                {
                    name: `resources.${this.name}.create`,
                    path: `/${this.name}/create`,
                    component: this.create,
                    props: {resourceName: this.name}
                }
            ])
        },
        created() {
            if (!this.$store.state[this.name]) {
                this.$store.registerModule(this.name, createResourceModule(this.name, this.title));
            }
        }
    }
</script>