
require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router';

import ExampleComponent from './components/ExampleComponent.vue';
import AltaCliente from './components/AltaCliente.vue';
import ListarClientes from './components/ListarClientes.vue';
import FichaCliente from './components/FichaCliente.vue';

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'ExampleComponent',
        component: ExampleComponent
    },
    {
        path: '/registrarcliente',
        name: 'AltaCliente',
        component: AltaCliente
    },
    {
        path: '/listarclientes',
        name: 'ListarClientes',
        component: ListarClientes
    },
    {
        path: '/fichacliente/:id',
        name: 'FichaCliente',
        component: FichaCliente
    },

];

const router = new VueRouter({routes});

const app = new Vue({
    el: '#app',
    router: router
});
