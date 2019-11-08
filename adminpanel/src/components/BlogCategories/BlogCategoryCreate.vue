<template>
    <adminpanel2>
        <admin-page>
            <div class="row page-titles" slot="header">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Создание категории блога</h4>
                </div>
            </div>

            <create slot="content">
                <blog-category-form/>
                <create-button/>
            </create>
        </admin-page>
    </adminpanel2>
</template>

<script>
    import Adminpanel2 from "@/components/Adminpanel2";
    import AdminPage from "@/components/AdminPage";
    import BlogCategoryForm from "@/components/BlogCategories/BlogCategoryForm";
    import Create from "@/components/Admin/Actions/Create";
    import CreateButton from "@/components/Admin/CreateButton";
    export default {
        name: "BlogCategoryCreate",
        components: {CreateButton, Create, BlogCategoryForm, AdminPage, Adminpanel2},
        props: [
            'resourceName'
        ]
    }
</script>

<style scoped>

</style>