import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

const routes = [
    {
        path: '/login',
        name: 'login',
    },
/*    {
        path: '/',
        name: 'home',
        component: Adminpanel,
        children: [
            {
                path: 'users',
                component: UsersList,
                name: 'admin.users'
            },
            {
                path: 'users/:id',
                component: UsersEdit,
                name: 'admin.users.edit'
            }
        ]
    }*/
];

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
});

export default router
