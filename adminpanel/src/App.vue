<template>
    <div>
        <resource name="users" :list="users.list" :edit="users.edit" title="Пользователи"/>
        <resource name="blogCategories" :list="blogCategories.list" :edit="blogCategories.edit" :create="blogCategories.create" title="Категории блога"/>
        <resource name="blogPosts" :list="blogPosts.list" :edit="blogPosts.edit" :create="blogPosts.create" title="Записи блога"/>
        <router-view/>
    </div>
</template>

<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&display=swap&subset=cyrillic,cyrillic-ext,latin-ext');

    body, h5, h4 {
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
    import BlogPostsList from "@/components/BlogPosts/BlogPostsList";
    import BlogPostCreate from "@/components/BlogPosts/BlogPostCreate";
    import BlogPostEdit from "@/components/BlogPosts/BlogPostEdit";
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
            },
            blogPosts() {
                return {
                    list: BlogPostsList,
                    create: BlogPostCreate,
                    edit: BlogPostEdit
                }
            }
        }
    }
</script>