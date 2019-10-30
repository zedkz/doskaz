<template>
    <div class="form-group row">
        <div class="col-sm-10">
            <button type="button" class="btn btn-primary" @click="submit">Сохранить</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SubmitButton",
        props: [
            'resourceName'
        ],
        methods: {
            submit() {
                this.$store.dispatch(`${this.resourceName}/edit/submit`)
            }
        }
    }
</script>

<style scoped>

</style>