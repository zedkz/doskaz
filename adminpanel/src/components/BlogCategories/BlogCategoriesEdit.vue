<template>
    <adminpanel2>
        <admin-page>
            <div class="row page-titles" slot="header">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Редактирование категории блога</h4>
                </div>
            </div>
            <edit slot="content" :resource-id="$route.params.id" :resource-name="resourceName">
                <blog-category-form :resource-name="resourceName"/>
                <submit-button :resource-name="resourceName"/>
            </edit>
        </admin-page>
    </adminpanel2>
</template>

<script>
    import AdminPage from "../AdminPage";
    import Adminpanel2 from "../Adminpanel2";
    import Edit from "@/components/Admin/Actions/Edit";
    import SubmitButton from "@/components/Admin/SubmitButton";
    import BlogCategoryForm from "@/components/BlogCategories/BlogCategoryForm";

    export default {
        name: "BlogCategoriesEdit",
        components: {BlogCategoryForm, SubmitButton, Edit, Adminpanel2, AdminPage},
        props: [
            'resourceName'
        ],
        computed: {
            options() {
                return [
                    {value: 'ROLE_USER', title: 'Пользователь'},
                    {value: 'ROLE_ADMIN', title: 'Администратор'},
                ]
            }
        }
    }
</script>

<style scoped>

</style>