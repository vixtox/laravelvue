<template>
    <div class="card">
        <div class="card-header bg-dark text-light">
            <h2 class="card-title">Lista de mascotas</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <div class="btn-group w-100" role="group" aria-label="">
                        <input type="text" id="searchInput" :value="searchTerm" @input="searchTerm = $event.target.value"
                            placeholder="Buscar mascota" class="form-control w-50">
                        <router-link :to="{ name: 'AltaMascota' }" class="btn btn-success w-50" title="Alta mascota"> <i
                                class="fas fa-paw"></i></router-link>
                    </div>
                    <table class="table table-striped table-sm">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Especie</th>
                                <th scope="col">Raza</th>
                                <th scope="col">Sexo</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="flex-column">
                            <tr v-for="mascota in mascotas" :key="mascota.id">
                                <td>{{ mascota.nombre }}</td>
                                <td>{{ mascota.especie_id }}</td>
                                <td>{{ mascota.razas_id }}</td>
                                <td>{{ mascota.sexo }}</td>
                                <td>
                                    <button class="btn btn-danger" @click="borrarMascota(mascota.id)" title="Dar baja">
                                        <i class="fa-solid fa-user-xmark"></i></button>
                                    <router-link :to="{ name: 'FichaMascota', params: { id: mascota.id } }"
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
            mascotas: [],
            currentPage: 1,
            totalPages: 2, // aquí debes usar el número total de páginas que correspondan a tu caso específico
            mascotaToDelete: null,
            searchTerm: '',
            selectedClient: null
        }
    },
    methods: {
        borrarMascota(id) {
            this.mascotaToDelete = id;
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger mr-4'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: '¿Está seguro de eliminar la mascota?',
                text: "La mascota se eliminará permanentemente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('mascotas/' + this.mascotaToDelete)
                        .then(response => {
                            this.getMascotas();
                        })
                        .catch(error => {
                            console.error(error);
                        });
                    swalWithBootstrapButtons.fire(
                        'Eliminado!',
                        'La mascota se ha eliminado correctamente.',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'La mascota no se ha eliminado',
                        'error'
                    )
                }
            })
        },

        pageChanged(page) {
            this.getMascotas(page);
        },

        getMascotas(page = 1) {
            axios.get('mascotas?page=' + page)
                .then(response => {
                    this.mascotas = response.data.mascotas;
                    this.currentPage = response.data.currentPage;
                    this.totalPages = response.data.lastPage;
                    console.log(this.mascotas)
                })
                .catch(error => {
                    console.error(error);
                });
        },

    },

    created() {
        this.getMascotas();
        const token = document.querySelector('meta[name="csrf-token"]');
        if (token) {
            this.csrfToken = token.content;
        }
    },

    mounted() {
        const vm = this;

        axios.get("mascotas/buscar", { params: { search: '' } })
            .then((res) => {
                // Inicializar Autocomplete dentro de la promesa
                $("#searchInput").autocomplete({
                    source: res.data.map((mascota) => mascota.nombre),
                    select: (event, ui) => {
                        vm.searchTerm = ui.item.value;

                        // Obtener el objeto completo del cliente seleccionado
                        vm.selectedClient = res.data.find((mascota) => mascota.nombre === ui.item.value);

                        if (vm.selectedClient) {
                            // Redirigir al usuario a la ruta FichaMascota con el parámetro id
                            vm.$router.push({ name: 'FichaMascota', params: { id: vm.selectedClient.id } });
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