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
                                <td>{{ cliente.nombre_apellidos }}</td>
                                <td>{{ cliente.municipio }}</td>
                                <td>{{ cliente.provincia_nombre }}</td>
                                <td>{{ cliente.telefono }}</td>
                                <td>
                                    <b-button @click="showModal(cliente)">Borrar</b-button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <b-modal ref="modal" hide-footer>
            <div class="d-block text-center">
                <p>¿Está seguro de que desea borrar al cliente?</p>
                <b-button variant="primary" @click="deleteCliente()">Sí</b-button>
                <b-button variant="secondary" @click="hideModal()">No</b-button>
            </div>
        </b-modal>
        <div>
            <paginacion :current-page="currentPage" :total-pages="totalPages" @pageChanged="pageChanged"></paginacion>
        </div>
    </div>
</template>
 
<script>
import axios from "axios";
import Paginacion from "./Paginacion.vue";
import { BButton, BModal } from "bootstrap-vue";

export default {
  components: {
    Paginacion,
    BButton,
    BModal,
  },
  data() {
    return {
      clientes: [],
      currentPage: 1,
      totalPages: 2, // aquí debes usar el número total de páginas que correspondan a tu caso específico
      // url: process.env.MIX_APP_URL,
      clienteToDelete: null,
    };
  },
  methods: {
    pageChanged(page) {
      this.getClientes(page);
    },

    getClientes(page = 1) {
      // const apiUrl = window.location.origin + '/proyecto/public/';

      // axios.get(apiUrl + 'clientes?page=' + page)
      axios
        .get("clientes?page=" + page)
        .then((response) => {
          this.clientes = response.data.clientes;
          this.currentPage = response.data.currentPage;
          this.totalPages = response.data.lastPage;
        })
        .catch((error) => {
          console.error(error);
        });
    },

    showModal(cliente) {
      this.clienteToDelete = cliente;
      this.$refs.modal.show();
    },

    hideModal() {
      this.clienteToDelete = null;
      this.$refs.modal.hide();
    },

    deleteCliente(cliente) {
        axios.delete(`clientes/${cliente.id}`)
            .then(response => {
                // Si la eliminación fue exitosa, actualizamos la lista de clientes
                this.getClientes();
                // Cerramos el modal
                this.closeModal();
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