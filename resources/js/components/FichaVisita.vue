<template>
    <div class="container">

        <div class="card">
            <div class="card-header bg-dark text-light">
                <h2 class="card-title">Ficha visita</h2>
            </div>
            <form v-on:submit.prevent="editarVisita">
                <div class="card">
                    <div class="btn-group w-100" role="group" aria-label="">
                        <router-link :to="{ name: 'NuevaVisita' }" class="btn btn-success w-100" title="Nueva visita">
                            <i class="fas fa-calendar-plus"></i> Nueva visita</router-link>
                    </div>
                    <div class="card-header">
                        <h5 class="card-title">Datos generales</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Campos de datos generales aquí -->
                            <div class="col-md-4 col-sm-6">
                                <label><b>Mascota:</b></label>
                                <span class="form-control gris">{{ mascota.nombre }}</span>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label for="fecha_visita"><b>Fecha visita:</b></label>
                                <input type="date" class="form-control" name="fecha_visita" :max="maxDate"
                                    v-model="visita.fecha_visita" id="fecha_visita" aria-describedby="helpId">
                                <div class="alert alert-danger" v-if="errores.fecha_visita">{{ errores.fecha_visita[0]
                                }}</div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label for="hora_visita"><b>Hora visita:</b></label>
                                <input type="time" class="form-control" name="hora_visita" v-model="visita.hora_visita"
                                    id="hora_visita" aria-describedby="helpId">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Detalles visita</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Campos de detalles visita aquí -->
                            <div class="col-md-6 col-sm-6">
                                <label for="sintomas"><b>Síntomas:</b></label>
                                <textarea rows="4" class="form-control" id="sintomas" v-model="visita.sintomas"></textarea>
                                <div class="alert alert-danger" v-if="errores.sintomas">{{
                                    errores.sintomas[0]
                                }}</div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label for="tratamiento"><b>Tratamiento:</b></label>
                                <textarea rows="4" class="form-control" id="tratamiento"
                                    v-model="visita.tratamiento"></textarea>
                                <div class="alert alert-danger" v-if="errores.tratamiento">{{
                                    errores.tratamiento[0]
                                }}</div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label><b>Veterinario:</b></label>
                                <span class="form-control gris">{{ visita.veterinario }}</span>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label for="diagnostico"><b>Diagnóstico:</b></label>
                                <input class="form-control" id="diagnostico" aria-describedby="helpId"
                                    placeholder="Diagnóstico" name="diagnostico" v-model="visita.diagnostico">
                                <div class="alert alert-danger" v-if="errores.diagnostico">{{
                                    errores.diagnostico[0]
                                }}</div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label for="coste"><b>Coste:</b></label>
                                <input type="number" step="0.01" class="form-control" name="coste" v-model="visita.coste"
                                    id="coste" aria-describedby="helpId" placeholder="Coste">
                                <div class="alert alert-danger" v-if="errores.coste">{{
                                    errores.coste[0]
                                }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Consultar/adjuntar pruebas</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <router-link :to="{ name: 'NuevoHemograma', params: { id: visita.mascotas_id } }"
                                    class="btn btn-success w-100" title="Añadir hemograma">
                                    <i class="fas fa-syringe"></i> Añadir hemograma</router-link>
                            </div>
                            <div class="col-md-4">
                                <router-link :to="{ name: 'ListarPruebas', params: { id: visita.mascotas_id } }"
                                    class="btn btn-info w-100" title="Listar pruebas">
                                    <i class="fas fa-eye"></i> Listar pruebas</router-link>
                            </div>
                            <div class="col-md-4">
                                <router-link :to="{ name: 'NuevaBioquimica', params: { id: visita.mascotas_id } }"
                                    class="btn btn-success w-100" title="Añadir bioquímica">
                                    <i class="fas fa-vial"></i> Añadir bioquímica</router-link>
                            </div>
                        </div>
                    </div>
                </div>
                <br>


                <div class="btn-group w-100" role="group" aria-label="">
                    <button type="submit" class="btn btn-success" title="Guardar">
                        <i class="fa fa-save"></i> Guardar
                    </button>
                    <router-link :to="{ name: 'ListarVisitas', params: { id: visita.mascotas_id } }" class="btn btn-warning"
                        title="Volver">
                        <i class="bi bi-arrow-return-left fw-bold"></i>
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
            visita: {
                mascotas_id: "",
                fecha_visita: "",
                hora_visita: "",
                veterinario: "",
                sintomas: "",
                diagnostico: "",
                tratamiento: "",
                coste: "",
            },
            errores: {},
            veterinarios: [],
            mascota: {},
            id: this.$route.params.id,
        };
    },

    created() {
        this.obtenerInformacionID(this.id);
        const token = document.querySelector('meta[name="csrf-token"]');
        if (token) {
            this.csrfToken = token.content;
        }
    },

    methods: {
        async obtenerInformacionID(id) {
            try {
                const response = await axios.get('visitas/' + id);
                console.log(response.data); // Agregar esta línea para depurar
                this.visita = response.data;
                await this.obtenerMascota();
            } catch (error) {
                console.error(error);
            }
        },

        async obtenerMascota() {
            try {
                const response = await axios.get('mascotas/' + this.visita.mascotas_id);
                console.log(response.data); // Agregar esta línea para depurar
                this.mascota = response.data;
            } catch (error) {
                console.error(error);
            }
        },

        // Edita mascota en la base de datos
        async editarVisita() {
            console.log(this.visita)
            const res = await axios.put('visitas/' + this.id, this.visita)
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
                        title: 'Error actualizar mascota',
                        text: 'Ingresa los campos correctamente',
                    })
                    this.errores = error.response.data.errors;
                });
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

};
</script>