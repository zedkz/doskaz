<template>
    <div id="main-wrapper">
        <nav-header></nav-header>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul>
<!--
                        <sidebar-link path="/users" v-if="can('users_access')"><i class="fa fa-user"></i> Пользователи</sidebar-link>
-->
                       <!-- <sidebar-link path="/blog/categories"><i class="fa fa-list"></i> Категории блога</sidebar-link>-->
                       <!-- <sidebar-link path="/blog/posts"><i class="fa fa-rss"></i> Записи блога</sidebar-link>-->
                        <!--<sidebar-link path="/complaints"><i class="fa fa-exclamation-circle"></i> Жалобы</sidebar-link>-->
                        <!--<sidebar-link path="/addingRequests"><i class="fa fa-file"></i> Заявки на добавление объектов</sidebar-link>-->
                        <!--<sidebar-link path="/objects"><i class="fa fa-map-marker-alt"></i> Объекты</sidebar-link>-->
                        <!--<sidebar-link path="/regionalRepresentatives"><i class="fa fa-id-card"></i> Региональные представители</sidebar-link>-->
                        <!--<sidebar-link path="/regionalCoordinators"><i class="fa fa-id-card"></i> Региональные координаторы</sidebar-link>-->
                        <sidebar-link v-for="link in links" :key="link.key" :path="link.path"><i :class="link.icon"></i>
                            {{link.title}}</sidebar-link>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="container-fluid">
                <b-toast></b-toast>
                <nuxt-child/>
            </div>
        </div>
    </div>
</template>

<script>
    import NavHeader from "../components/NavHeader";
    import SidebarLink from "../components/SidebarLink";
    import {get} from 'vuex-pathify'

    export default {
        components: {SidebarLink, NavHeader},
        middleware: ['authenticated'],
        head: {
            link: [
                {rel: 'stylesheet', href: '/adminpanel/eliteadmin/university/dist/css/style.min.css'}
            ],
            bodyAttrs: {
                class: ['fixed-layout', 'skin-blue']
            }
        },
        mounted() {
            if (this.$route.name === 'index') {
                this.$router.push(this.links[0].path)
            }
        },
        computed: {
            operationResult: get('crud/edit/operationResult'),
            can: get('authentication/can'),
            links() {
                return [
                    {path: '/users', key: 'users_access', icon: 'fa fa-user', title: 'Пользователи'},
                    {path: '/blog/categories', key: 'blog_access', icon: 'fa fa-list', title: 'Категории блога'},
                    {path: '/blog/posts', key: 'blog_access', icon: 'fa fa-rss', title: 'Записи блога'},
                    {path: '/complaints', key: 'complaints_access', icon: 'fa fa-exclamation-circle', title: 'Жалобы'},
                    {path: '/addingRequests', key: 'adding_requests_access', icon: 'fa fa-file', title: 'Заявки на добавление объектов'},
                    {path: '/objects', key: 'objects_access', icon: 'fa fa-map-marker-alt', title: 'Объекты'},
                    {path: '/regionalRepresentatives', key: 'regional_representatives_access', icon: 'fa fa-id-card', title: 'Региональные представители'},
                    {path: '/regionalCoordinators', key: 'regional_coordinators_access', icon: 'fa fa-id-card', title: 'Региональные координаторы'},
                    {path: '/administrationTasks', key: 'administration_tasks_access', icon: 'fa fa-id-card', title: 'Задания от администрации'},
                ].filter(item => this.can(item.key))
            }
        },
        watch: {
            operationResult(v) {
                console.log(v)
                if(v) {
                    this.$bvToast.toast(v.message, {
                        toaster: 'b-toaster-top-center',
                        variant: v.status === 'error' ? 'danger' : 'success',
                        noAutoHide: false,
                        solid: true,
                        appendToast: false
                    })
                }
            }
        }
    }
</script>

<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&display=swap&subset=cyrillic,cyrillic-ext,latin-ext');

    body, h5, h4 {
        font-family: 'Roboto', sans-serif !important;
    }
</style>
