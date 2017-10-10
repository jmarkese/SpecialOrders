import Vue from 'vue';
import VueRouter from 'vue-router';
import VueResource from 'vue-resource';
import App from './components/App.vue';
import Dashboard from './components/Dashboard.vue';
import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Signin from './components/Signin.vue';

/**
 *
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');
//
// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));
//
// const app = new Vue({
//     el: '#app'
// });


Vue.use(VueRouter);
Vue.use(VueResource);

Vue.http.headers.common['X-CSRF-TOKEN'] = document.getElementsByName('csrf-token')[0].getAttribute('content');
Vue.http.headers.common['Authorization'] = localStorage.getItem('id_token');
Vue.http.options.root = 'http://specialorders.dev';

export default Vue;

export var router = new VueRouter({
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/signin',
            name: 'signin',
            component: Signin
        }
    ]
});

new Vue({
        el: '#app',
        router: router,
        render: app => app(App)
});

Vue.http.interceptors.push(function(request, next) {
    
    var token = localStorage.getItem('id_token');

    // modify headers
    request.headers.set('Authorization', token);

    // continue to next interceptor
    next();

});