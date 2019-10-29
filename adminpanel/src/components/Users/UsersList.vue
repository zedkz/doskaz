<template>
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Пользователи</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <b-card>
                    <b-table striped bordered hover :fields="fields" :items="users">
                        <template v-slot:cell(roles)="data">
                            {{ data.item.roles.map(role => roles[role]).join(', ') }}
                        </template>
                        <template v-slot:cell(_actions)="data">
                            <b-button-group size="sm">
                                <b-button variant="success">Редактировать</b-button>
                            </b-button-group>
                        </template>
                    </b-table>
                </b-card>
            </div>
        </div>
    </div>
</template>

<script>
    import api from '@/api'

    export default {
        name: "UsersList",
        mounted() {
            this.loadUsers()
        },
        data() {
            return {
                users: [],
                count: 0
            }
        },
        computed: {
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
        },
        methods: {
            async loadUsers() {
                const {data: {items, count}} = await api.get('users');
                this.users = items;
                this.count = count
            }
        }
    }
</script>

<style scoped>

</style>