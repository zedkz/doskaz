<template>
    <div>
        <slot/>
        <b-pagination align="center" v-model="page" :total-rows="count"/>
    </div>
</template>

<script>
    export default {
        name: "List",
        props: [
            'resourceName'
        ],
        mounted() {
            this.$store.dispatch(`${this.resourceName}/list/load`)
        },
        computed: {
            count() {
                return this.$store.state[this.resourceName].list.count
            },
            page: {
                get() {
                    return this.$store.state[this.resourceName].list.page
                },
                set(page) {
                    this.$store.dispatch(`${this.resourceName}/list/changePage`, page)
                }
            }
        }
    }
</script>

<style scoped>

</style>