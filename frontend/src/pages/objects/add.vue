<template>
    <div class="add-object">
        <MainHeader/>
        <div class="container">
            <div class="complaint__top">
                <h2 class="title">Добавить объект</h2>
                <div class="add-object__link-b">
                    <span class="add-object__link">Простая форма</span>
                    <span class="add-object__link active">Средняя форма</span>
                    <span class="add-object__link">Сложная форма</span>
                </div>
            </div>
        </div>
        <div class="complaint__wrapper">
            <ObjectAddContent :categories="categories"/>
        </div>
    </div>
</template>

<script>
    import MainHeader from "@/components/MainHeader";
    import ObjectAddContent from "@/components/object_add/ObjectAddContent.vue";

    export default {
        middleware: ['authenticated'],
        layout: 'complaint',
        components: {
            MainHeader,
            ObjectAddContent
        },
        async asyncData({$axios}) {
            const [{data: categories}] = await Promise.all([
                $axios.get('/api/objectCategories')
            ]);

            return {
                categories
            }
        }
    };

</script>

<style lang="scss">
    @import "@/styles/mixins.scss";
</style>