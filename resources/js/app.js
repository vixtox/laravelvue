
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
import AltaMascota from './components/AltaMascota.vue';
import ListarMascotas from './components/ListarMascotas.vue';
import FichaMascota from './components/FichaMascota.vue';
import NuevaVisita from './components/NuevaVisita.vue';
import ListarVisitas from './components/ListarVisitas.vue';

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'ExampleComponent',
        component: ExampleComponent,
        meta: {
            requiresAuth: true
        }
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
            requiresAuth: true,
            requiresAdmin: true
        }
    },
    {
        path: '/listarempleados',
        name: 'ListarEmpleados',
        component: ListarEmpleados,
        meta: {
            requiresAuth: true,
            requiresAdmin: true
        }
    },
    {
        path: '/fichaempleado/:id',
        name: 'FichaEmpleado',
        component: FichaEmpleado,
        meta: {
            requiresAuth: true,
            requiresAdmin: true
        }
    },
    {
        path: '/registrarmascota',
        name: 'AltaMascota',
        component: AltaMascota,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/listarmascotas',
        name: 'ListarMascotas',
        component: ListarMascotas,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/fichamascota/:id',
        name: 'FichaMascota',
        component: FichaMascota,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/nuevavisita/:id',
        name: 'NuevaVisita',
        component: NuevaVisita,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/listarvisitas/:id',
        name: 'ListarVisitas',
        component: ListarVisitas,
        meta: {
            requiresAuth: true
        }
    },

];

const router = new VueRouter({ routes });

const app = new Vue({
    el: '#app',
    router: router
});

router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
    const requiresAdmin = to.matched.some(record => record.meta.requiresAdmin);
    const userRole = window.userRole;

    if (requiresAuth && !userRole) {
        // El usuario no está autenticado, redirige al inicio de sesión
        window.location.href = '/login.index';
    } else if (requiresAdmin && userRole !== 'Admin') {
        // El usuario no tiene el rol de administrador, redirige a una página de acceso denegado
        next('/');
    } else {
        next();
    }
});
