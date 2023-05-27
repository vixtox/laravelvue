<template>
    <div class="container">

        <div class="card">
            <div class="card-header bg-dark text-light">
                <h2 class="card-title">Ficha empleado</h2>
            </div>
            <form v-on:submit.prevent="editarEmpleado">
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
                                    v-model="empleado.nombre_apellidos" id="nombre_apellidos" aria-describedby="helpId"
                                    placeholder="Nombre completo">
                                <div class="alert alert-danger" v-if="errores.nombre_apellidos">{{
                                    errores.nombre_apellidos[0]
                                }}</div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="documento_identidad"><b>NIF/CIF:</b></label>
                                <input type="text" class="form-control" name="documento_identidad"
                                    v-model="empleado.documento_identidad" id="documento_identidad"
                                    aria-describedby="helpId" placeholder="Nº Documento">
                                <div class="alert alert-danger" v-if="errores.documento_identidad">{{
                                    errores.documento_identidad[0]
                                }}</div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="fecha_nacimiento"><b>Fecha nacimiento:</b></label>
                                <input type="date" class="form-control" name="fecha_nacimiento" :max="maxDate"
                                    v-model="empleado.fecha_nacimiento" id="fecha_nacimiento" aria-describedby="helpId">
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
                                <input type="text" class="form-control" name="domicilio" v-model="empleado.domicilio"
                                    id="domicilio" aria-describedby="helpId" placeholder="Domicilio">
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <label for="codigo_postal"><b>Código postal:</b></label>
                                <input type="text" class="form-control" name="codigo_postal"
                                    v-model="empleado.codigo_postal" id="codigo_postal" aria-describedby="helpId"
                                    placeholder="Código postal">
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="provincia_id"><b>Provincia:</b></label>
                                <select class="form-select" id="provincia_id" v-model="empleado.provincia_id"
                                    v-on:change="consultar_municipio(true)">
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
                                <select class="form-select" id="municipio_id" v-model="empleado.municipio_id">
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
                                <input type="telefono" class="form-control" name="telefono" v-model="empleado.telefono"
                                    id="telefono" aria-describedby="helpId" placeholder="Teléfono">
                                <div class="alert alert-danger" v-if="errores.telefono">{{ errores.telefono[0] }}</div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="email"><b>Email:</b></label>
                                <input type="email" class="form-control" name="email" v-model="empleado.email" id="email"
                                    aria-describedby="helpId" placeholder="Email">
                                <div class="alert alert-danger" v-if="errores.email">{{ errores.email[0] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Datos laborales</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Campos de datos laborales aquí -->
                            <div class="col-md-3 col-sm-6">
                                <label for="fecha_contratacion"><b>Fecha contratación:</b></label>
                                <input type="date" class="form-control" name="fecha_contratacion" :max="maxDate"
                                    v-model="empleado.fecha_contratacion" id="fecha_contratacion" aria-describedby="helpId">
                                <div class="alert alert-danger" v-if="errores.fecha_contratacion">{{
                                    errores.fecha_contratacion[0]
                                }}</div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="salario"><b>Salario:</b></label>
                                <input type="text" class="form-control" name="salario" v-model="empleado.salario"
                                    id="salario" aria-describedby="helpId" placeholder="Salario">
                                <div class="alert alert-danger" v-if="errores.salario">{{ errores.salario[0] }}</div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="cargo"><b>Cargo:</b></label>
                                <select class="form-select" id="cargo" v-model="empleado.cargo">
                                    <option disabled value="">Selecciona un cargo</option>
                                    <option value="Veterinario">Veterinario</option>
                                    <option value="Auxiliar">Auxiliar</option>
                                    <option value="Peluquero">Peluquero</option>
                                    <option value="Limpiadora">Limpiadora</option>
                                </select>
                                <div class="alert alert-danger" v-if="errores.cargo">{{ errores.cargo[0]
                                }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn-group w-100" role="group" aria-label="">
                    <button type="submit" class="btn btn-success" title="Guardar">
                        <i class="fa fa-save"></i> Guardar
                    </button>

                    <router-link :to="{ name: 'ListarEmpleados' }" class="btn btn-warning" title="Volver">
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
            maxDate: this.getCurrentDate(),
            empleado: {
                nombre_apellidos: "",
                documento_identidad: "",
                fecha_nacimiento: "",
                domicilio: "",
                municipio_id: "",
                codigo_postal: "",
                provincia_id: "",
                telefono: "",
                email: "",
                fecha_contratacion: "",
                salario: "",
                cargo: "",
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
                const response = await axios.get('empleados/' + id);
                console.log(response.data); // Agregar esta línea para depurar
                this.empleado = response.data;
                await this.consultar_municipio(false);
            } catch (error) {
                console.error(error);
            }
        },

        // Edita empleado en la base de datos
        async editarEmpleado() {
            const res = await axios.put('empleados/' + this.id, this.empleado)
                .then(response => {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Cambios guardados',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    console.log(response)
                    this.errores = {};
                })
                .catch(error => {
                    console.log(error.response);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error actualizar empleado',
                        text: 'Ingresa los campos correctamente',
                    })
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
            try {
                const response = await axios.get('municipios/' + this.empleado.provincia_id);
                console.log(this.empleado.provincia)
                this.localidades = response.data;
                console.log(this.localidades)
            } catch (error) {
                console.error(error);
            }
        },

        getCurrentDate() {
            const today = new Date();
            const year = today.getFullYear();
            let month = today.getMonth() + 1;
            let day = today.getDate();

            // Agrega un cero inicial para el mes y el día si es necesario
            month = month < 10 ? '0' + month : month;
            day = day < 10 ? '0' + day : day;

            return year + '-' + month + '-' + day;
        },

    },
    mounted() {
        this.consultar_provincia();
    },
};
</script>