<template>
    <div class="card">
        <div class="card-header bg-dark text-light">
            <h2 class="card-title">Lista de clientes</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">NIF/CIF</th>
                            <!-- <th scope="col">Fecha nacimiento</th>
                            <th scope="col">Domicilio</th>
                            <th scope="col">Codigo postal</th> -->
                            <th scope="col">Municipio</th>
                            <th scope="col">Provincia</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Email</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="cliente in clientes" :key="cliente.id">
                            <td>{{ cliente.nombre_apellidos }}</td>
                            <td>{{ cliente.documento_identidad }}</td>
                            <!-- <td>{{ new Date(cliente.fecha_nacimiento).toLocaleDateString('es-ES', {
                                day: '2-digit', month:
                                    '2-digit', year: 'numeric'
                            }) }}</td>
                            <td>{{ cliente.domicilio }}</td>
                            <td>{{ cliente.codigo_postal }}</td> -->
                            <td>{{ cliente.municipio }}</td>
                            <td>{{ cliente.provincia_nombre }}</td>
                            <td>{{ cliente.telefono }}</td>
                            <td>{{ cliente.email }}</td>
                            <td>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div>
            <paginacion :current-page="currentPage" :total-pages="totalPages" @pageChanged="pageChanged"></paginacion>
        </div>
    </div>
</template>
  
  
<script>

import axios from 'axios';
import Paginacion from './Paginacion.vue';

export default {
    components: {
        Paginacion,
    },
    data() {
        return {
            clientes: [],
            currentPage: 1,
            totalPages: 2, // aquí debes usar el número total de páginas que correspondan a tu caso específico
            // url: process.env.MIX_APP_URL,
        }
    },
    methods: {

        pageChanged(page) {
            this.getClientes(page);
        },


        getClientes(page = 1) {
            const apiUrl = window.location.origin + '/proyecto/public/';

            axios.get(apiUrl + 'clientes?page=' + page)
                .then(response => {
                    this.clientes = response.data.clientes;
                    this.currentPage = response.data.currentPage;
                    this.totalPages = response.data.lastPage;
                })
                .catch(error => {
                    console.error(error);
                });
        },

    },

    created() {

        this.getClientes();
        const token = document.querySelector('meta[name="csrf-token"]');
        if (token) {
            this.csrfToken = token.content;
        }

    }
}

</script>
  