<template>
    <div class="container">

        <div class="card">
            <div class="card-header bg-dark text-light">
                <h2 class="card-title">Ficha cliente</h2>
            </div>
            <form v-on:submit.prevent="editarCliente">
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
                                <div class="alert alert-danger" v-if="errores.nombre_apellidos">{{ errores.nombre_apellidos[0]
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
                                <label for="provincia"><b>Provincia:</b></label>
                                <select class="form-select" id="provincia" v-model="cliente.provincia"
                                    v-on:change="consultar_municipio(true)">
                                    <option disabled value="">Selecciona una provincia</option>
                                    <option v-for="provincia in provincias" :value="provincia.id"
                                        :key="provincia.provincia">
                                        {{ provincia.provincia }}
                                    </option>
                                </select>
                                <div class="alert alert-danger" v-if="errores.provincia">{{ errores.provincia[0]
                                }}</div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="municipio"><b>Municipio:</b></label>
                                <select class="form-select" id="municipio" v-model="cliente.municipio"
                                    v-on:change="get_nombre_municipio()">
                                    <option disabled value="">Selecciona un municipio</option>
                                    <option v-for="municipio in localidades" :value="municipio.id"
                                        :key="municipio.municipio">
                                        {{ municipio.municipio }}
                                    </option>
                                </select>
                                <div class="alert alert-danger" v-if="errores.municipio">{{ errores.municipio[0] }}</div>
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
                        Guardar
                    </button>

                    <router-link :to="{ name: 'ExampleComponent' }" class="btn btn-warning">
                        <i class="bi bi-arrow-return-left"></i>
                    </router-link>
                </div>

            </form>
        </div>

    </div>
</template>


<script>
import axios from 'axios';
export default {
    data() {
        return {
            cliente: {
                nombre_apellidos: "",
                documento_identidad: "",
                fecha_nacimiento: "",
                domicilio: "",
                municipio: "",
                municipio_nombre: "",
                codigo_postal: "",
                provincia: "",
                provincia_nombre: "",
                telefono: "",
                email: "",
            },
            provincias: [],
            localidades: [],
            errores: {},
            id: this.$route.params.id,
        };
    },

    created() {
        console.log(this.id)
        this.obtenerInformacionID(this.id);
        const token = document.querySelector('meta[name="csrf-token"]');
        if (token) {
            this.csrfToken = token.content;
        }
    },

    methods: {
        async obtenerInformacionID(id) {
            try {
                const response = await axios.get('clientes/' + id);
                console.log(response.data); // Agregar esta línea para depurar
                this.cliente = response.data;
                await this.consultar_municipio(false);
            } catch (error) {
                console.error(error);
            }
        },

        // Edita cliente en la base de datos
        async editarCliente() {
            const res = await axios.put('clientes/' + this.id, this.cliente)
                .then(response => {
                    console.log(response)
                    this.errores = {};
                })
                .catch(error => {
                    console.log(error.response);
                    this.errores = error.response.data.errors;
                });
        },
        async consultar_provincia() {
            try {
                const response = await axios.get('provincias');
                this.provincias = response.data;
            } catch (error) {
                console.error(error);
            }
        },
        async consultar_municipio(condicion) {
            if (condicion) {
                this.get_nombre_provincia();
                this.cliente.municipio = '';
            }
            try {
                const response = await axios.get('municipios/' + this.cliente.provincia);
                console.log(this.cliente.provincia)
                this.localidades = response.data;
                console.log(this.localidades)
            } catch (error) {
                console.error(error);
            }
        },
        get_nombre_provincia() {
            // Buscamos el objeto provincia correspondiente al id seleccionado
            if (this.cliente && this.cliente.provincia != '') {
                const provincia = this.provincias.find(
                    (p) => p.id === this.cliente.provincia
                );
                // Cambiamos el valor de cliente.provincia de id a nombre
                this.cliente.provincia_nombre = provincia.provincia;
            }
        },
        get_nombre_municipio() {
            // Buscamos el objeto municipio correspondiente al id seleccionado
            if (this.cliente && this.cliente.municipio != '') {
                const municipio = this.localidades.find(
                    (p) => p.id === this.cliente.municipio
                );
                // Cambiamos el valor de cliente.provincia de id a nombre
                this.cliente.municipio_nombre = municipio.municipio;
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