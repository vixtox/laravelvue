<template>
    <div class="container">

        <div class="card">
            <div class="card-header bg-dark text-light">
                <h2 class="card-title">Alta cliente</h2>
            </div>
            <form v-on:submit.prevent="altaCliente">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Datos personales</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Campos de datos personales aquí -->
                            <div class="col-md-6 col-sm-6">
                                <label for="nombre_apellidos"><b>Nombre completo:</b></label>
                                <input type="text" class="form-control" name="nombre_apellidos"
                                    v-model="cliente.nombre_apellidos" id="nombre_apellidos" aria-describedby="helpId"
                                    placeholder="Nombre completo">
                                <div class="alert alert-danger" v-if="errores.nombre_apellidos">{{
                                    errores.nombre_apellidos[0]
                                }}</div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="documento_identidad"><b>NIF/CIF:</b></label>
                                <input type="text" class="form-control" name="documento_identidad"
                                    v-model="cliente.documento_identidad" id="documento_identidad" aria-describedby="helpId"
                                    placeholder="Nº Documento">
                                <div class="alert alert-danger" v-if="errores.documento_identidad">{{
                                    errores.documento_identidad[0]
                                }}</div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="fecha_nacimiento"><b>Fecha nacimiento:</b></label>
                                <input type="date" class="form-control" name="fecha_nacimiento"
                                    v-model="cliente.fecha_nacimiento" id="fecha_nacimiento" aria-describedby="helpId">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Dirección</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Campos de dirección aquí -->
                            <div class="col-md-3 col-sm-6">
                                <label for="domicilio"><b>Domicilio:</b></label>
                                <input type="text" class="form-control" name="domicilio" v-model="cliente.domicilio"
                                    id="domicilio" aria-describedby="helpId" placeholder="Domicilio">
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <label for="codigo_postal"><b>Código postal:</b></label>
                                <input type="text" class="form-control" name="codigo_postal" v-model="cliente.codigo_postal"
                                    id="codigo_postal" aria-describedby="helpId" placeholder="Código postal">
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="provincia_id"><b>Provincia:</b></label>
                                <select class="form-select" id="provincia_id" v-model="cliente.provincia_id"
                                    v-on:change="consultar_municipio()">
                                    <option disabled value="">Selecciona una provincia</option>
                                    <option v-for="provincia_id in provincias" :value="provincia_id.id"
                                        :key="provincia_id.provincia">
                                        {{ provincia_id.provincia }}
                                    </option>
                                </select>
                                <div class="alert alert-danger" v-if="errores.provincia_id">{{ errores.provincia_id[0]
                                }}</div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="municipio_id"><b>Municipio:</b></label>
                                <select class="form-select" id="municipio_id" v-model="cliente.municipio_id">
                                    <option disabled value="">Selecciona un municipio</option>
                                    <option v-for="municipio_id in localidades" :value="municipio_id.id"
                                        :key="municipio_id.municipio">
                                        {{ municipio_id.municipio }}
                                    </option>
                                </select>
                                <div class="alert alert-danger" v-if="errores.municipio_id">{{ errores.municipio_id[0] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Datos de contacto</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Campos de datos de contacto aquí -->
                            <div class="col-md-3 col-sm-6">
                                <label for="telefono"><b>Teléfono:</b></label>
                                <input type="telefono" class="form-control" name="telefono" v-model="cliente.telefono"
                                    id="telefono" aria-describedby="helpId" placeholder="Teléfono">
                                <div class="alert alert-danger" v-if="errores.telefono">{{ errores.telefono[0] }}</div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="email"><b>Email:</b></label>
                                <input type="email" class="form-control" name="email" v-model="cliente.email" id="email"
                                    aria-describedby="helpId" placeholder="Email">
                                <div class="alert alert-danger" v-if="errores.email">{{ errores.email[0] }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn-group w-100" role="group" aria-label="">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-person-add"></i>
                    </button>

                    <router-link :to="{ name: 'ListarClientes' }" class="btn btn-warning">
                        <i class="bi bi-arrow-return-left"></i>
                    </router-link>
                </div>

            </form>
        </div>

    </div>
</template>


<script>
import axios from 'axios';
import Swal from 'sweetalert2'
export default {
    data() {
        return {
            cliente: {
                nombre_apellidos: "",
                documento_identidad: "",
                fecha_nacimiento: "",
                domicilio: "",
                municipio_id: "",
                codigo_postal: "",
                provincia_id: "",
                telefono: "",
                email: "",
            },
            provincias: [],
            localidades: [],
            errores: {},
        };
    },

    created() {
        const token = document.querySelector('meta[name="csrf-token"]');
        if (token) {
            this.csrfToken = token.content;
        }
    },

    methods: {
        // Inserta en la base de datos
        async altaCliente() {
            try {
                const res = await axios.post('clientes', this.cliente);
                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: 'Cliente registrado correctamente',
                    showConfirmButton: false,
                    timer: 1500
                })
                this.$router.push({ name: 'ListarClientes' });

            } catch (error) {
                if (error.response.data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error registro cliente',
                        text: 'Ingresa los campos correctamente',
                    })
                    this.errores = error.response.data.errors;
                }
            }

        },

        async consultar_provincia() {
            try {
                console.log(this.cliente.nombre_apellidos)
                const response = await axios.get('provincias');
                this.provincias = response.data;
            } catch (error) {
                console.error(error);
            }
        },

        async consultar_municipio() {
            try {
                console.log(this.cliente.provincia_id)
                const response = await axios.get('municipios/' + this.cliente.provincia_id);
                this.localidades = response.data;
                console.log(this.localidades)
            } catch (error) {
                console.error(error);
            }
        },

    },
    mounted() {
        this.consultar_provincia();
    },
};

</script>

<style>
h2 {
    text-align: center;
}
</style>
