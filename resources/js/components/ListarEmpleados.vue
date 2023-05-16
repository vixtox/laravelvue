<template>
    <div class="card">

        <div class="card-header bg-dark text-light">
            <h2 class="card-title">Lista de empleados</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <div class="btn-group w-100" role="group" aria-label="">
                        <input type="text" id="searchInput" :value="searchTerm" @input="searchTerm = $event.target.value"
                            placeholder="Buscar empleado" class="form-control w-50">
                        <router-link :to="{ name: 'AltaEmpleado' }" class="btn btn-success w-50" title="Alta empleado"> <i
                                class="fa-solid fa-user-plus" style="color: #ffffff;"></i></router-link>
                    </div>
                    <table class="table table-striped table-sm">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Municipio</th>
                                <!-- <th scope="col">Provincia</th> -->
                                <th scope="col">Cargo</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="flex-column">
                            <tr v-for="empleado in empleados" :key="empleado.id">
                                <td>{{ empleado.nombre_apellidos }}</td>
                                <td>{{ empleado.municipio_id }}</td>
                                <!-- <td>{{ empleado.provincia_id }}</td> -->
                                <td>{{ empleado.cargo }}</td>
                                <td>{{ empleado.telefono }}</td>
                                <td>
                                    <button class="btn btn-danger" @click="borrarempleado(empleado.id)" title="Dar baja">
                                        <i class="fa-solid fa-user-xmark"></i></button>
                                    <router-link :to="{ name: 'FichaEmpleado', params: { id: empleado.id } }"
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
            empleados: [],
            currentPage: 1,
            totalPages: 2, // aquí debes usar el número total de páginas que correspondan a tu caso específico
            empleadoToDelete: null,
            searchTerm: '',
            selectedClient: null
        }
    },
    methods: {
        borrarempleado(id) {
            this.empleadoToDelete = id;
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger mr-4'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: '¿Está seguro de eliminar el empleado?',
                text: "El empleado se eliminará permanentemente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('empleados/' + this.empleadoToDelete)
                        .then(response => {
                            this.getEmpleados();
                        })
                        .catch(error => {
                            console.error(error);
                        });
                    swalWithBootstrapButtons.fire(
                        'Eliminado!',
                        'El empleado se ha eliminado correctamente.',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'El empleado no se ha eliminado',
                        'error'
                    )
                }
            })
        },

        pageChanged(page) {
            this.getEmpleados(page);
        },

        getEmpleados(page = 1) {
            axios.get('empleados?page=' + page)
                .then(response => {
                    this.empleados = response.data.empleados;
                    this.currentPage = response.data.currentPage;
                    this.totalPages = response.data.lastPage;
                })
                .catch(error => {
                    console.error(error);
                });
        },

    },

    created() {
        this.getEmpleados();
        const token = document.querySelector('meta[name="csrf-token"]');
        if (token) {
            this.csrfToken = token.content;
        }
    },

    mounted() {
        const vm = this;

        axios.get("empleados/buscar", { params: { search: '' } })
            .then((res) => {
                // Inicializar Autocomplete dentro de la promesa
                $("#searchInput").autocomplete({
                    source: res.data.map((empleado) => empleado.nombre_apellidos),
                    select: (event, ui) => {
                        vm.searchTerm = ui.item.value;

                        // Obtener el objeto completo del empleado seleccionado
                        vm.selectedClient = res.data.find((empleado) => empleado.nombre_apellidos === ui.item.value);

                        if (vm.selectedClient) {
                            // Redirigir al usuario a la ruta Fichaempleado con el parámetro id
                            vm.$router.push({ name: 'FichaEmpleado', params: { id: vm.selectedClient.id } });
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