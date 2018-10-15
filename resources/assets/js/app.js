
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import VueRouter from 'vue-router' 
import VeeValidate from 'vee-validate'
import Vuex from "vuex"
import VueSession from 'vue-session'
import Auth from './auth.js';




window.Vue = require('vue');
window.Login = require('./components/LoginComponent.vue');
window.Register = require('./components/RegisterComponent.vue');
window.Shops = require('./components/ShopsComponent.vue');
window.NearbyShops = require('./components/NearbyShopsComponent.vue');
window.Nav = require('./components/NavComponent.vue');
window.PreferedShops = require('./components/PreferedShopsComponent.vue');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.use(VeeValidate);
Vue.use(VueRouter);
Vue.use(Auth);
Vue.use(VueSession);



Vue.component("login",Login);
Vue.component("register",Register);
Vue.component("shops",Shops);
Vue.component("nearby_shops",NearbyShops);
Vue.component("nav-component",Nav);
Vue.component("preferedshops",PreferedShops);
Vue.component('pagination', require('laravel-vue-pagination'));




const routes = [
    { path : '/',component : NearbyShops,meta:{x:true}},
    { path : '/login',component : Login,meta:{y:true}},
    { path : '/register',component :Register ,meta:{y:true}},
    { path : '/prefered_shops',component :PreferedShops ,meta:{x:true}}
    ]    

    
const router = new VueRouter({routes,mode:'history'})






router.beforeEach(
    (to,from,next) => {
     if(to.matched.some(record => record.meta.x)){
            
             if(Vue.prototype.$auth.isAuth()){
                next();
             }else {
                 next({path:'/login'});
             } 
     }

     if(to.matched.some(record => record.meta.y)){
        if(Vue.prototype.$auth.isAuth()){
                next({path:'/'});
             }else {
                next();
             } 
     }
    });




const app = new Vue({
    el: '#app',
    router 
});
