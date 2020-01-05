<template>
    <adminpanel2>
        <admin-page>
            <div class="row page-titles" slot="header">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">{{ $store.state.blogCategories.title }}</h4>
                </div>
            </div>
            <list :resource-name="resourceName" slot="content">
                <b-table striped bordered hover :fields="fields" :items="items">
                    <template v-slot:cell(createdAt)="data"> {{data.item.createdAt | formatDate}}
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
    import AdminPage from "@/components/AdminPage"
    import Adminpanel2 from "@/components/Adminpanel2"
    import List from "@/components/Admin/Actions/List"
    import EditButton from "@/components/Admin/EditButton"
    import DeleteButton from "@/components/Admin/DeleteButton"
    import {format} from 'date-fns'

    export default {
        props: ['resourceName'],
        name: "ComplaintsList",
        components: {DeleteButton, EditButton, List, Adminpanel2, AdminPage},
        filters: {
          formatDate(date) {
              return format(new Date(date), 'yyyy-MM-dd HH:mm')
          }
        },
        computed: {
            items() {
                return this.$store.state[this.resourceName].list.items
            },
            fields() {
                return [
                    {key: 'id', label: 'id'},
                    {key: 'createdAt', label: 'Дата подачи'},
                    {key: '_actions', label: 'Действия'},
                ]
            },
        }
    }
</script>

<style scoped>

</style>