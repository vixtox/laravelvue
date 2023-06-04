<template>
    <div class="card">
        <div class="card-header bg-dark text-light">
            <h2 class="card-title">Lista de visitas</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <div class="btn-group w-100" role="group" aria-label="">
                        <router-link :to="{ name: 'NuevaVisita' }" class="btn btn-success w-100" title="Nueva Visita">
                            <i class="fas fa-calendar-plus"></i> Nueva visita</router-link>
                    </div>
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
                                <td>{{ mascota.nombre }}</td>
                                <td>{{ new Date(visita.fecha_visita).toLocaleDateString('es-ES', {
                                    day: '2-digit', month:
                                        '2-digit', year: 'numeric'
                                }) }}</td>
                                <td>{{ visita.diagnostico }}</td>
                                <td>{{ visita.veterinario }}</td>
                                <td>
                                    <button class="btn btn-danger" @click="borrarVisita(visita.id)" title="Eliminar visita">
                                        <i class="fas fa-calendar-minus"></i>
                                    </button>
                                    <router-link :to="{ name: 'FichaVisita', params: { id: visita.id } }"
                                        class="btn btn-info" title="Ver detalles"><i class="fa-solid fa-eye"
                                            style="color: #ffffff;"></i></router-link>
                                    <button class="btn btn-warning" @click="generarPDF(visita.id)" title="Generar PDF">
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </button>
                                    <button class="btn btn-secondary" @click="enviarCorreo(visita.id)"
                                        title="Enviar correo">
                                        <i class="fa-solid fa-envelope"></i>
                                    </button>
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
            visitas: [],
            currentPage: 1,
            totalPages: 2, // aquí debes usar el número total de páginas que correspondan a tu caso específico
            visitaToDelete: null,
            mascota: {},
        }
    },
    methods: {

        async obtenerInformacionID() {
            try {
                const response = await axios.get('mascotas/' + this.$route.params.id);
                console.log(response.data); // Agregar esta línea para depurar
                this.mascota = response.data;
            } catch (error) {
                console.error(error);
            }
        },

        borrarVisita(id) {
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
                    console.log(this.visitaToDelete)
                    axios.delete('visitas/' + this.visitaToDelete)
                        .then(response => {
                            this.getVisitas();
                        })
                        .catch(error => {
                            console.error(error);
                        });
                    swalWithBootstrapButtons.fire(
                        'Eliminado!',
                        'La visita se ha eliminado correctamente.',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'La visita no se ha eliminado',
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
                    this.currentPage = response.data.currentPage;
                    this.totalPages = response.data.lastPage;
                    console.log(this.visitas)
                })
                .catch(error => {
                    console.error(error);
                });
        },

        generarPDF(id) {
            axios.get('visitas/generate-pdf/' + id, { responseType: 'blob' })
                .then(response => {
                    const url = window.URL.createObjectURL(new Blob([response.data], { type: 'application/pdf' }));
                    window.open(url);
                })
                .catch(error => {
                    console.error(error);
                });
        },

        enviarCorreo(id) {
            // Llamada a la API para enviar el correo
            axios.post('enviarcorreo/' + id)
                .then(response => {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'El correo se envio correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'El correo no se ha enviado'
                    })
                });
        }

    },

    created() {
        this.obtenerInformacionID();
        this.getVisitas();
        const token = document.querySelector('meta[name="csrf-token"]');
        if (token) {
            this.csrfToken = token.content;
        }
    },

}

</script>