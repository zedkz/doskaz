<template>
    <div class="form-group row">
        <div class="col-sm-10">
            <button type="button" class="btn btn-primary" @click="submit">Создать</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CreateButton",
        computed: {
            resourceName() {
                return this.$store.getters.resourceName
            }
        },
        methods: {
            async submit() {
                await this.$store.dispatch(`${this.resourceName}/edit/create`);
                this.$router.push({
                    name: `resources.${this.resourceName}.edit`, params: {
                        id: this.$store.state[this.resourceName].edit.item.id
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>