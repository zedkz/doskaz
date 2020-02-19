<template>
    <div id="main-wrapper">
        <nav-header></nav-header>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul>
                        <sidebar-link path="/users"><i class="fa fa-user"></i> Пользователи</sidebar-link>
                        <sidebar-link path="/blog/categories"><i class="fa fa-list"></i> Категории блога</sidebar-link>
                        <sidebar-link path="/blog/posts"><i class="fa fa-rss"></i> Записи блога</sidebar-link>
                        <sidebar-link path="/complaints"><i class="fa fa-exclamation-circle"></i> Жалобы</sidebar-link>
                        <sidebar-link path="/objects/addingRequests"><i class="fa fa-file"></i> Заявки на добавление объектов</sidebar-link>
                        <!--<sidebar-link path="/objects/items"><i class="fa fa-map-marker-alt"></i> Объекты</sidebar-link>-->
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="container-fluid">
                <nuxt/>
            </div>
        </div>
    </div>
</template>

<script>
    import SidebarLink from "@/components/SidebarLink";
    import NavHeader from "@/components/NavHeader";

    export default {
        components: {NavHeader, SidebarLink}
    }
</script>

<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&display=swap&subset=cyrillic,cyrillic-ext,latin-ext');

    body, h5, h4 {
        font-family: 'Roboto', sans-serif;
    }
</style>
