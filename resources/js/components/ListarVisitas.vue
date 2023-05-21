<template>
    <div class="card">
        <div class="card-header bg-dark text-light">
            <h2 class="card-title">Lista de visitas</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Fecha visita</th>
                                <th scope="col">Diagnóstico</th>
                                <th scope="col">Veterinario</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="flex-column">
                            <tr v-for="visita in visitas" :key="visita.id">
                                <td>{{ visita.mascotas_id }}</td>
                                <td>{{ visita.fecha_visita }}</td>
                                <td>{{ visita.diagnostico }}</td>
                                <td>{{ visita.veterinario }}</td>
                                <td>
                                    <button class="btn btn-danger" @click="borrarVisita(visita.id)" title="Eliminar visita">
                                        <i class="fa-solid fa-user-xmark"></i></button>
                                    <!-- <router-link :to="{ name: 'FichaMascota', params: { id: mascota.id } }"
                                        class="btn btn-info" title="Ver detalles"><i class="fa-solid fa-eye"
                                            style="color: #ffffff;"></i></router-link> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- <div>
            <paginacion :current-page="currentPage" :total-pages="totalPages" @pageChanged="pageChanged"></paginacion>
        </div> -->

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
            visitas: [],
            currentPage: 1,
            totalPages: 2, // aquí debes usar el número total de páginas que correspondan a tu caso específico
            visitaToDelete: null,
        }
    },
    methods: {
        borrarVisitas(id) {
            this.visitaToDelete = id;
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger mr-4'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: '¿Está seguro de eliminar la visita?',
                text: "La visita se eliminará permanentemente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('visitas/' + this.visitaToDelete)
                        .then(response => {
                            this.getVisitas();
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
            this.getVisitas(page);
        },

        getVisitas(page = 1) {
            console.log(this.$route.params.id);
            axios.get('visitas/listavisitas/' + this.$route.params.id)
                .then(response => {
                    this.visitas = response.data.visitas;
                    console.log(this.visitas);
                })
                .catch(error => {
                    console.error(error);
                });
        },

    },

    created() {
        this.getVisitas();
        const token = document.querySelector('meta[name="csrf-token"]');
        if (token) {
            this.csrfToken = token.content;
        }
    },

}

</script>