import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from './pages/Home.vue';
import Blog from './pages/Blog.vue';
import Support from './pages/Support.vue';
import About from './pages/About.vue';
import SinglePost from './pages/SinglePost.vue';
import NotFound from './pages/NotFound.vue';
import Category from './pages/Category.vue';
import Categories from './pages/Categories.vue';

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/blog',
            name: 'blog',
            component: Blog
        },
        {
            path: '/support',
            name: 'support',
            component: Support
        },
        {
            path: '/about',
            name: 'about',
            component: About
        },
        {
            path: '/blog/categories',
            name: 'categories',
            component: Categories
        },
        {
            path: '/blog/:slug',
            name: 'single-post',
            component: SinglePost
        },
        {
            path: '/blog/categories/category/:slug',
            name: 'category',
            component: Category
        },
        {
            path: '*',
            name: 'not-found',
            component: NotFound
        }
    ]
});

export default router;