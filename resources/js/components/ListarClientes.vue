<template>
    <div class="card">
        <div class="card-header bg-dark text-light">
            <h2 class="card-title">Lista de clientes</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Municipio</th>
                                <th scope="col">Provincia</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="flex-column">
                            <tr v-for="cliente in clientes" :key="cliente.id">
                                <td>{{cliente.nombre_apellidos }}</td>
                                <td>{{ cliente.municipio_nombre }}</td>
                                <td>{{ cliente.provincia_nombre }}</td>
                                <td>{{ cliente.telefono }}</td>
                                <td>
                                    <button class="btn bg-danger" @click="borrarCliente(cliente.id)" title="Dar baja">
                                        <i class="fa-solid fa-user-xmark"></i></button>
                                    <router-link :to="{ name: 'FichaCliente', params: { id: cliente.id } }" class="btn bg-info" title="Ver detalles"><i class="fa-sharp fa-regular fa-eye"></i></router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div>
            <paginacion :current-page="currentPage" :total-pages="totalPages" @pageChanged="pageChanged"></paginacion>
        </div>
        <b-modal v-model="showModal" title="Confirmación" hide-footer>
            <p v-for="cliente in clientes" :key="cliente.id">¿Estás seguro de que quieres borrar a {{
                cliente.nombre_apellidos }}?</p>
            <div class="d-flex justify-content-end">
                <b-button variant="secondary" class="mr-2" @click="showModal = false">Cancelar</b-button>
                <b-button variant="danger" @click="deleteCliente">Borrar</b-button>
            </div>
        </b-modal>
    </div>
</template>
 
<script>

import axios from 'axios';
import Paginacion from './Paginacion.vue';
import { BModal, BButton } from 'bootstrap-vue'

export default {
    components: {
        Paginacion,
        BModal,
        BButton
    },
    data() {
        return {
            clientes: [],
            currentPage: 1,
            totalPages: 2, // aquí debes usar el número total de páginas que correspondan a tu caso específico
            showModal: false,
            clienteToDelete: null
        }
    },
    methods: {
        borrarCliente(id) {
            this.showModal = true;
            this.clienteToDelete = id;
        },

        deleteCliente() {
            axios.delete('clientes/' + this.clienteToDelete)
                .then(response => {
                    this.showModal = false;
                    this.getClientes();
                })
                .catch(error => {
                    console.error(error);
                });
        },

        pageChanged(page) {
            this.getClientes(page);
        },

        getClientes(page = 1) {
            axios.get('clientes?page=' + page)
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