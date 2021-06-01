import AllPosts from '../components/AllPosts.vue';
import CreatePost from '../components/CreatePost.vue';
import EditPost from '../components/EditPost.vue';
import ShowPost from '../components/ShowPost.vue';

import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);

const routes = [
    {
        name: 'home',
        path: '/',
        component: AllPosts
    },
    {
        name: 'create',
        path: '/create',
        component: CreatePost
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditPost
    },
    {
        name: 'show',
        path: '/:id',
        component: ShowPost
    }
];




export const router = new VueRouter({
    mode: "history",
    routes,
});
