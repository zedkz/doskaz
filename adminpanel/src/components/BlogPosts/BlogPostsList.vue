<template>
    <adminpanel2>
        <admin-page>
            <div class="row page-titles" slot="header">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">{{ $store.state.blogCategories.title }}</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <create-resource-link :resource-name="resourceName"/>
                    </div>
                </div>
            </div>
            <list :resource-name="resourceName" slot="content">
                <b-table striped bordered hover :fields="fields" :items="items">
                    <template v-slot:cell(roles)="data">
                        {{ data.item.roles.map(role => roles[role]).join(', ') }}
                    </template>
                    <template v-slot:cell(_actions)="data">
                        <b-button-group size="sm">
                            <edit-button :resource-name="resourceName" :resource-id="data.item.id"/>
                            <delete-button :resource-id="data.item.id"/>
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
    import DeleteButton from "@/components/Admin/DeleteButton";
    import CreateResourceLink from "@/components/Admin/CreateResourceLink";

    export default {
        props: ['resourceName'],
        name: "BlogPostsList",
        components: {CreateResourceLink, DeleteButton, EditButton, List, Adminpanel2, AdminPage},
        computed: {
            items() {
                return this.$store.state[this.resourceName].list.items
            },
            fields() {
                return [
                    {key: 'title', label: 'Имя'},
                    {key: '_actions', label: 'Действия'},
                ]
            },
        }
    }
</script>

<style scoped>

</style>