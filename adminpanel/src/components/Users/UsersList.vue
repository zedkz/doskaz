<template>
    <adminpanel2>
        <admin-page>
            <div class="row page-titles" slot="header">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">{{ $store.state.users.title }}</h4>
                </div>
            </div>
            <list :resource-name="resourceName" slot="content">
                <b-table striped bordered hover :fields="fields" :items="users">
                    <template v-slot:cell(roles)="data">
                        {{ data.item.roles.map(role => roles[role]).join(', ') }}
                    </template>
                    <template v-slot:cell(_actions)="data">
                        <b-button-group size="sm">
                            <edit-button :resource-name="resourceName" :resource-id="data.item.id"/>
                        </b-button-group>
                    </template>
                </b-table>
            </list>
        </admin-page>
    </adminpanel2>
</template>

<script>
    import AdminPage from "../AdminPage";
    import Adminpanel2 from "../Adminpanel2";
    import List from "../Admin/Actions/List";
    import EditButton from "../Admin/EditButton";

    export default {
        props: ['resourceName'],
        name: "UsersList",
        components: {EditButton, List, Adminpanel2, AdminPage},
        computed: {
            users() {
                return this.$store.state[this.resourceName].list.items
            },
            fields() {
                return [
                    {key: 'name', label: 'Имя'},
                    {key: 'email', label: 'Email'},
                    {key: 'phone', label: 'Телефон'},
                    {key: 'roles', label: 'Роли'},
                    {key: '_actions', label: 'Действия'},
                ]
            },
            roles() {
                return {
                    ROLE_USER: 'Пользователь',
                    ROLE_ADMIN: 'Администратор'
                }
            }
        }
    }
</script>

<style scoped>

</style>