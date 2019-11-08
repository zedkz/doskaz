<template>
    <div>
        <resource name="users" :list="users.list" :edit="users.edit" title="Пользователи"/>
        <resource name="blogCategories" :list="blogCategories.list" :edit="blogCategories.edit" :create="blogCategories.create" title="Категории блога"/>
        <router-view/>
    </div>
</template>

<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&display=swap&subset=cyrillic,cyrillic-ext,latin-ext');

    body {
        font-family: 'Roboto', sans-serif;
    }
</style>
<script>
    import Resource from "@/components/Admin/Resource";
    import UsersList from "@/components/Users/UsersList";
    import UsersEdit from "@/components/Users/UsersEdit";
    import BlogCategoriesList from "@/components/BlogCategories/BlogCategoriesList";
    import BlogCategoriesEdit from "@/components/BlogCategories/BlogCategoriesEdit";
    import BlogCategoryCreate from "@/components/BlogCategories/BlogCategoryCreate";
    export default {
        components: {Resource},
        computed: {
            users() {
                return {
                    list: UsersList,
                    edit: UsersEdit
                }
            },
            blogCategories() {
                return {
                    list: BlogCategoriesList,
                    edit: BlogCategoriesEdit,
                    create: BlogCategoryCreate
                }
            }
        }
    }
</script>