<template>
    <div class="card">
        <div class="card-header bg-dark text-light">
            <h2 class="card-title">Lista de mascotas</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <div class="w-100 d-flex">
                        <input type="text" id="searchInput" :value="searchTerm" @input="searchTerm = $event.target.value"
                            placeholder="Buscar mascota" class="form-control mr-4 inputListar">
                        <router-link :to="{ name: 'AltaMascota' }" class="btn btn-success botonListar" title="Alta mascota">
                            <i class="fas fa-paw"></i></router-link>
                    </div>
                    <table class="table table-striped table-sm">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Especie</th>
                                <th scope="col">Raza</th>
                                <th scope="col">Propietario</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="flex-column">
                            <tr v-for="mascota in mascotas" :key="mascota.id">
                                <td>{{ mascota.nombre }}</td>
                                <td>{{ mascota.especie_id }}</td>
                                <td>{{ mascota.razas_id }}</td>
                                <td>{{ mascota.nombre_cliente }}</td>
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
            totalPages: 2, 
            mascotaToDelete: null,
            searchTerm: '',
            selectedClient: null,
            clientes: [],
            pageTitle: 'Lista mascotas',
        }
    },
    methods: {
        borrarMascota(id) {
            this.mascotaToDelete = id;
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success mr-4',
                    cancelButton: 'btn btn-danger'
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
                reverseButtons: false
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

    async mounted() {
        const vm = this;

        axios
            .get("mascotas/buscar", { params: { search: '' } })
            .then(async (res) => {
                const autocompleteData = [];

                // Obtener los datos de las mascotas
                const mascotas = res.data;

                // Iterar sobre las mascotas y obtener los nombres de las mascotas junto con los nombres de los clientes
                for (const mascota of mascotas) {
                    const responseCliente = await axios.get('clientes/' + mascota.cliente_id);
                    const cliente = responseCliente.data;

                    const nombreCompleto = `${mascota.nombre}, ${cliente.nombre_apellidos}`;
                    autocompleteData.push(nombreCompleto);
                }

                // Inicializar Autocomplete con los datos obtenidos
                $("#searchInput").autocomplete({
                    source: autocompleteData,
                    select: (event, ui) => {
                        const [nombreMascota, nombreCliente] = ui.item.value.split(", ");

                        // Obtener el ID de la mascota
                        const mascotaSeleccionada = mascotas.find(mascota => mascota.nombre === nombreMascota);
                        const idMascota = mascotaSeleccionada.id;

                        // Redirigir al usuario a la ruta FichaMascota con el parámetro id
                        vm.$router.push({ name: 'FichaMascota', params: { id: idMascota } });

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
