
require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router';

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
import FichaVisita from './components/FichaVisita.vue';
import NuevoHemograma from './components/NuevoHemograma.vue';
import NuevaBioquimica from './components/NuevaBioquimica.vue';
import FichaHemograma from './components/FichaHemograma.vue';
import FichaBioquimica from './components/FichaBioquimica.vue';
import MiCuenta from './components/MiCuenta.vue';



Vue.use(VueRouter);

// Variable global para almacenar el título actual
window.pageTitle = 'Menú';

const routes = [
    {
        path: '/',
        name: 'ListarMascotas',
        component: ListarMascotas,
        meta: {
            requiresAuth: true,
            title: 'Lista mascotas',
        }
    },
    {
        path: '/registrarcliente',
        name: 'AltaCliente',
        component: AltaCliente,
        meta: {
            requiresAuth: true,
            title: 'Alta ciente',
        }
    },
    {
        path: '/listarclientes',
        name: 'ListarClientes',
        component: ListarClientes,
        meta: {
            requiresAuth: true,
            title: 'Lista clientes',
        }
    },
    {
        path: '/fichacliente/:id',
        name: 'FichaCliente',
        component: FichaCliente,
        meta: {
            requiresAuth: true,
            title: 'Ficha cliente',
        }
    },
    {
        path: '/registrarempleado',
        name: 'AltaEmpleado',
        component: AltaEmpleado,
        meta: {
            requiresAuth: true,
            requiresAdmin: true,
            title: 'Alta empleado',
        }
    },
    {
        path: '/listarempleados',
        name: 'ListarEmpleados',
        component: ListarEmpleados,
        meta: {
            requiresAuth: true,
            requiresAdmin: true,
            title: 'Lista empleados',
        }
    },
    {
        path: '/fichaempleado/:id',
        name: 'FichaEmpleado',
        component: FichaEmpleado,
        meta: {
            requiresAuth: true,
            requiresAdmin: true,
            title: 'Ficha empleado',
        }
    },
    {
        path: '/registrarmascota',
        name: 'AltaMascota',
        component: AltaMascota,
        meta: {
            requiresAuth: true,
            title: 'Alta mascota',
        }
    },
    
    {
        path: '/fichamascota/:id',
        name: 'FichaMascota',
        component: FichaMascota,
        meta: {
            requiresAuth: true,
            title: 'Ficha mascota',
        }
    },
    {
        path: '/nuevavisita/:id',
        name: 'NuevaVisita',
        component: NuevaVisita,
        meta: {
            requiresAuth: true,
            title: 'Nueva visita',
        }
    },
    {
        path: '/listarvisitas/:id',
        name: 'ListarVisitas',
        component: ListarVisitas,
        meta: {
            requiresAuth: true,
            title: 'Lista visitas',
        }
    },
    {
        path: '/fichavisita/:id',
        name: 'FichaVisita',
        component: FichaVisita,
        meta: {
            requiresAuth: true,
            title: 'Ficha visita',
        }
    },
    {
        path: '/nuevohemograma/:id',
        name: 'NuevoHemograma',
        component: NuevoHemograma,
        meta: {
            requiresAuth: true,
            title: 'Nuevo hemograma',
        }
    },
    {
        path: '/nuevabioquimica/:id',
        name: 'NuevaBioquimica',
        component: NuevaBioquimica,
        meta: {
            requiresAuth: true,
            title: 'Nueva bioquímica',
        }
    },
    {
        path: '/fichahemograma/:id',
        name: 'FichaHemograma',
        component: FichaHemograma,
        meta: {
            requiresAuth: true,
            title: 'Ficha hemograma',
        }
    },
    {
        path: '/fichabioquimica/:id',
        name: 'FichaBioquimica',
        component: FichaBioquimica,
        meta: {
            requiresAuth: true,
            title: 'Ficha bioquímica',
        }
    },
    {
        path: '/micuenta',
        name: 'MiCuenta',
        component: MiCuenta,
        meta: {
            requiresAuth: true,
            title: 'Mi cuenta',
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
        if (to.meta.title) {
            document.title = to.meta.title;
        }
        next();
    }

});