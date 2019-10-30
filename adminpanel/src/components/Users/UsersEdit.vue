<template>
    <adminpanel2>
        <admin-page>
            <div class="row page-titles" slot="header">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Редактирование пользователя</h4>
                </div>
            </div>
            <edit slot="content" :resource-id="$route.params.id" :resource-name="resourceName">
                <form>
                    <text-field property="name" :resource-name="resourceName" label="Имя"/>
                    <text-field :disabled="true" property="email" :resource-name="resourceName" label="Email"/>
                    <text-field :disabled="true" property="phone" :resource-name="resourceName" label="Номер телефона"/>
                    <selection-field :resource-name="resourceName" property="roles" label="Роли" :options="options"/>
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
    import SelectionField from "@/components/Admin/Fields/SelectionFIeld";
    import SubmitButton from "@/components/Admin/SubmitButton";

    export default {
        name: "UsersEdit",
        components: {SubmitButton, SelectionField, TextField, Edit, Adminpanel2, AdminPage},
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