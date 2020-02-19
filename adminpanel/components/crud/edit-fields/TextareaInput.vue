<template>
    <textarea v-model="val" class="form-control" rows="5"></textarea>
</template>

<script>
    export default {
        name: "TextareaInput",
        props: [
            'value'
        ],
        computed: {
            val: {
                get() {
                    return this.value
                },
                set(v) {
                    this.$emit('input', v)
                }
            },
        }
    }
</script>

<style scoped>

</style>
