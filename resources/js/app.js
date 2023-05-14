
require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router';

import ExampleComponent from './components/ExampleComponent.vue';
import AltaCliente from './components/AltaCliente.vue';
import ListarClientes from './components/ListarClientes.vue';
import FichaCliente from './components/FichaCliente.vue';
import AltaEmpleado from './components/AltaEmpleado.vue';
import ListarEmpleados from './components/ListarEmpleados.vue';
import FichaEmpleado from './components/FichaEmpleado.vue';

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
        component: AltaCliente,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/listarclientes',
        name: 'ListarClientes',
        component: ListarClientes,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/fichacliente/:id',
        name: 'FichaCliente',
        component: FichaCliente,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/registrarempleado',
        name: 'AltaEmpleado',
        component: AltaEmpleado,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/listarempleados',
        name: 'ListarEmpleados',
        component: ListarEmpleados,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/fichaempleado/:id',
        name: 'FichaEmpleado',
        component: FichaEmpleado,
        meta: {
            requiresAuth: true
        }
    },

];

const router = new VueRouter({routes});

const app = new Vue({
    el: '#app',
    router: router
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !isLoggedIn()) {
        // Redireccionar a la página de inicio de sesión o mostrar un mensaje de acceso denegado
        next('/login');
    } else {
        next();
    }
});

function isLoggedIn() {
    // Aquí puedes implementar la lógica para verificar si el usuario está autenticado en Laravel
    // Puedes utilizar Vuex para almacenar el estado de autenticación o realizar una petición al backend
    // y devolver true si el usuario está autenticado y false en caso contrario.
    // Ejemplo:
    // return store.getters.isLoggedIn;

    // En este caso, se asume que la función siempre devuelve true para ejemplificar la protección de rutas
    return true;
}
