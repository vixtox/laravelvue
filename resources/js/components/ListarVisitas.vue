<template>
    <div class="card">
        <div class="card-header bg-dark text-light">
            <h2 class="card-title">Lista de visitas</h2>
        </div>
        <div class="btn-group w-100" role="group" aria-label="">
            <router-link :to="{ name: 'NuevaVisita', params: { id: this.$route.params.id } }" class="btn btn-success listar" title="Nueva Visita">
                <i class="fas fa-calendar-plus"></i></router-link>
        </div>
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
                                <router-link :to="{ name: 'FichaVisita', params: { id: visita.id } }" class="btn btn-info"
                                    title="Ver detalles"><i class="fa-solid fa-eye"
                                        style="color: #ffffff;"></i></router-link>
                                <button class="btn btn-secondary" @click="generarPDF(visita.id)" title="Generar PDF">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </button>
                                <button class="btn btn-warning" @click="enviarCorreo(visita.id)" title="Enviar correo">
                                    <i class="fa-solid fa-envelope"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <paginacion :current-page="currentPage" :total-pages="totalPages" @pageChanged="pageChanged"></paginacion>
        </div>

        <router-link :to="{ name: 'FichaMascota', params: { id: mascota_id } }" class="btn btn-warning listar" title="Volver"><i class="bi bi-arrow-return-left fw-bold"></i></router-link>

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
            totalPages: 2,
            visitaToDelete: null,
            mascota: [],
            pageTitle: 'Lista visitas',
            mascota_id: null,
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
                    confirmButton: 'btn btn-success mr-4',
                    cancelButton: 'btn btn-danger'
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
                reverseButtons: false
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
                    this.mascota_id = this.visitas[0].mascotas_id;
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