<template>
    <div class="card">
        <div class="card-header bg-dark text-light">
            <h2 class="card-title">Lista de clientes</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <div class="w-100 d-flex">
                        <input type="text" id="searchInput" :value="searchTerm" @input="searchTerm = $event.target.value"
                            placeholder="Buscar cliente" class="form-control mr-4 inputListar">
                        <router-link :to="{ name: 'AltaCliente' }" class="btn btn-success botonListar" title="Alta cliente"> <i
                                class="fa-solid fa-user-plus" style="color: #ffffff;"></i></router-link>
                    </div>
                    <table class="table table-striped table-sm">
                        <thead class="bg-dark text-light">
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
                                <td>{{ cliente.nombre_apellidos }}</td>
                                <td>{{ cliente.municipio_id }}</td>
                                <td>{{ cliente.provincia_id }}</td>
                                <td>{{ cliente.telefono }}</td>
                                <td>
                                    <button class="btn btn-danger" @click="borrarCliente(cliente.id)" title="Dar baja">
                                        <i class="fa-solid fa-user-xmark"></i></button>
                                    <router-link :to="{ name: 'FichaCliente', params: { id: cliente.id } }"
                                        class="btn btn-info" title="Ver detalles"><i class="fa-solid fa-eye"
                                            style="color: #ffffff;"></i></router-link>
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

    </div>
</template>
 
<script>

import axios from 'axios';
import Paginacion from './Paginacion.vue';
import Swal from 'sweetalert2'

export default {
    components: {
        Paginacion,
    },
    data() {
        return {
            clientes: [],
            currentPage: 1,
            totalPages: 2,
            clienteToDelete: null,
            searchTerm: '',
            selectedClient: null,
            pageTitle: 'Lista clientes',
        }
    },
    methods: {
        borrarCliente(id) {
            this.clienteToDelete = id;
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success mr-4',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: '¿Está seguro de eliminar el cliente?',
                text: "El cliente se eliminará permanentemente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                reverseButtons: false
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('clientes/' + this.clienteToDelete)
                        .then(response => {
                            this.getClientes();
                        })
                        .catch(error => {
                            console.error(error);
                        });
                    swalWithBootstrapButtons.fire(
                        'Eliminado!',
                        'El cliente se ha eliminado correctamente.',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'El cliente no se ha eliminado',
                        'error'
                    )
                }
            })
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
    },

    mounted() {
        const vm = this;

        axios.get("clientes/buscar", { params: { search: '' } })
            .then((res) => {
                // Inicializar Autocomplete dentro de la promesa
                $("#searchInput").autocomplete({
                    source: res.data.map((cliente) => cliente.nombre_apellidos),
                    select: (event, ui) => {
                        vm.searchTerm = ui.item.value;

                        // Obtener el objeto completo del cliente seleccionado
                        vm.selectedClient = res.data.find((cliente) => cliente.nombre_apellidos === ui.item.value);

                        if (vm.selectedClient) {
                            // Redirigir al usuario a la ruta FichaCliente con el parámetro id
                            vm.$router.push({ name: 'FichaCliente', params: { id: vm.selectedClient.id } });
                        }

                        return false;
                    },

                });
            })
            .catch((error) => {
                console.error(error);
            });
    }

}

</script>