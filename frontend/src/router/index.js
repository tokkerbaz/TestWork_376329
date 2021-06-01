import AllPosts from '@/components/AllPosts.vue';
import CreatePost from '@/components/CreatePost.vue';
import EditPost from '@/components/EditPost.vue';
import ShowPost from '@/components/ShowPost.vue';
import Login from "@/components/Login";
import Register from "@/components/Register";

import Vue from "vue";
import VueRouter from "vue-router";
import Home from "@/components/Home";

Vue.use(VueRouter);

const routes = [
    {
        name:'home',
        path: '/',
        component: Home
    },
    {
        name: 'posts',
        path: '/posts',
        component: AllPosts
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'create',
        path: '/create',
        meta: {
            auth: true
        },
        component: CreatePost
    },
    {
        name: 'edit',
        path: '/edit/:id',
        meta: {
            auth: true
        },
        component: EditPost
    },
    {
        name: 'show',
        path: '/:slug',
        meta: {
            auth: true
        },
        component: ShowPost
    }
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
});

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('user')

    if (to.matched.some(record => record.meta.auth) && !loggedIn) {
        next('/login')
        return
    }
    next()
})

export default router;