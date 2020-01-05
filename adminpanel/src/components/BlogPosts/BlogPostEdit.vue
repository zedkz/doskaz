<template>
    <adminpanel2>
        <admin-page>
            <div class="row page-titles" slot="header">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Редактирование записи блога</h4>
                </div>
            </div>
            <edit slot="content" :resource-id="$route.params.id" :resource-name="resourceName">
                <blog-post-form :resource-name="resourceName"/>
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
    import BlogPostForm from "@/components/BlogPosts/BlogPostForm";

    export default {
        name: "BlogPostEdit",
        components: {BlogPostForm, SubmitButton, Edit, Adminpanel2, AdminPage},
        props: [
            'resourceName'
        ],
        computed: {
        }
    }
</script>

<style scoped>

</style>