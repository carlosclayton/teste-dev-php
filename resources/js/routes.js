import Vue from 'vue';
import VueRouter from 'vue-router';
import ExampleComponent from './components/ExampleComponent';
import Brand from './components/Brand';
import Home from './components/Home';
import CarList from './components/cars/List';
Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {path: '/home', component: Home},
        {path: '/cars', component: CarList},
        {path: '*', redirect: '/home'}
    ],
    mode: 'history'
});
