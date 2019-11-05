<template>
    <adminpanel2>
        <admin-page>
            <div class="row page-titles" slot="header">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Редактирование категории блога</h4>
                </div>
            </div>
            <edit slot="content" :resource-id="$route.params.id" :resource-name="resourceName">
                <form>
                    <text-field property="title" required :resource-name="resourceName" label="Наименование"/>
                    <text-field property="slug" :resource-name="resourceName" label="ЧПУ"/>
                    <submit-button :resource-name="resourceName"/>
                </form>
            </edit>
        </admin-page>
    </adminpanel2>
</template>

<script>
    import AdminPage from "../AdminPage";
    import Adminpanel2 from "../Adminpanel2";
    import Edit from "@/components/Admin/Actions/Edit";
    import TextField from "@/components/Admin/Fields/TextField";
    import SubmitButton from "@/components/Admin/SubmitButton";

    export default {
        name: "BlogCategoriesEdit",
        components: {SubmitButton, TextField, Edit, Adminpanel2, AdminPage},
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