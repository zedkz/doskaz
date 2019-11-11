<template>
   <create :initial-data="initialize">
       <adminpanel2>
           <admin-page>
               <div class="row page-titles" slot="header">
                   <div class="col-md-5 align-self-center">
                       <h4 class="text-themecolor">Создание категории блога</h4>
                   </div>
               </div>

               <create slot="content">
                   <blog-post-form/>
                   <create-button/>
               </create>
           </admin-page>
       </adminpanel2>
   </create>
</template>

<script>
    import Adminpanel2 from "@/components/Adminpanel2";
    import AdminPage from "@/components/AdminPage";
    import Create from "@/components/Admin/Actions/Create";
    import CreateButton from "@/components/Admin/CreateButton";
    import BlogPostForm from "@/components/BlogPosts/BlogPostForm";
    export default {
        name: "BlogPostCreate",
        components: {BlogPostForm, CreateButton, Create, AdminPage, Adminpanel2},
        props: [
            'resourceName'
        ],
        computed: {
            initialize() {
                return () => ({
                    isPublished: true,
                    publishedAt: (new Date).toISOString()
                })
            }
        }
    }
</script>

<style scoped>

</style>