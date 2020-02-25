<template>
    <div>
        <StartCategoryForm/>
        <Sidebar></Sidebar>
    </div>
</template>

<script>
    import Sidebar from "@/components/Sidebar.vue";
    import StartCategoryForm from "@/components/StartCategoryForm.vue";
    export default {
        components: {
            Sidebar,
            StartCategoryForm
        }
    }
</script>

<style scoped>

</style>