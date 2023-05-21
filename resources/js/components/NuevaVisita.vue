<template>
    <div class="container">

        <div class="card">
            <div class="card-header bg-dark text-light">
                <h2 class="card-title">Nueva visita</h2>
            </div>
            <form v-on:submit.prevent="altaVisita">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Datos generales</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Campos de datos generales aquí -->
                            <div class="col-md-3 col-sm-6">
                                <label><b>Mascota:</b></label>
                                <span class="form-control bg-secondary">{{ mascota.nombre }}</span>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label><b>Propietario:</b></label>
                                <span class="form-control bg-secondary">{{ cliente.nombre_apellidos }}</span>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="fecha_visita"><b><span class="text-danger">* </span>Fecha visita:</b></label>
                                <input type="date" class="form-control" name="fecha_visita" :max="maxDate"
                                    v-model="visita.fecha_visita" id="fecha_visita" aria-describedby="helpId">
                                <div class="alert alert-danger" v-if="errores.fecha_visita">{{ errores.fecha_visita[0]
                                }}</div>
                            </div>
                            <div class="col-md-3 col-sm-6">
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
                                <label for="sintomas"><b><span class="text-danger">* </span>Síntomas:</b></label>
                                <textarea rows="4" class="form-control" id="sintomas" v-model="visita.sintomas"></textarea>
                                <div class="alert alert-danger" v-if="errores.sintomas">{{
                                    errores.sintomas[0]
                                }}</div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label for="tratamiento"><b><span class="text-danger">* </span>Tratamiento:</b></label>
                                <textarea rows="4" class="form-control" id="tratamiento"
                                    v-model="visita.tratamiento"></textarea>
                                <div class="alert alert-danger" v-if="errores.tratamiento">{{
                                    errores.tratamiento[0]
                                }}</div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="diagnostico"><b><span class="text-danger">* </span>Diagnóstico:</b></label>
                                <input class="form-control" id="diagnostico" aria-describedby="helpId"
                                    placeholder="Diagnóstico" name="diagnostico" v-model="visita.diagnostico">
                                <div class="alert alert-danger" v-if="errores.diagnostico">{{
                                    errores.diagnostico[0]
                                }}</div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="veterinario"><b><span class="text-danger">* </span>Veterinario:</b></label>
                                <select class="form-select" id="veterinario" v-model="visita.veterinario">
                                    <option disabled value="">Selecciona un veterinario</option>
                                    <option v-for="veterinario in veterinarios" :value="veterinario.nombre_apellidos"
                                        :key="veterinario.nombre_apellidos">
                                        {{ veterinario.nombre_apellidos }}
                                    </option>
                                </select>
                                <div class="alert alert-danger" v-if="errores.veterinario">{{ errores.veterinario[0]
                                }}</div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="coste"><b><span class="text-danger">* </span>Coste:</b></label>
                                <input type="number" step="0.01" class="form-control" name="coste" v-model="visita.coste"
                                    id="coste" aria-describedby="helpId" placeholder="Coste">
                                <div class="alert alert-danger" v-if="errores.coste">{{
                                    errores.coste[0]
                                }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn-group w-100" role="group" aria-label="">
                    <button type="submit" class="btn btn-success" title="Nueva visita">
                        <i class="fa fa-clinic-medical"></i>
                    </button>

                    <router-link :to="{ name: 'ListarMascotas' }" class="btn btn-warning" title="Volver">
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
                mascotas_id: this.$route.params.id,
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
            cliente: {},
        };
    },

    created() {
        this.obtenerInformacionID();
        const token = document.querySelector('meta[name="csrf-token"]');
        if (token) {
            this.csrfToken = token.content;
        }
    },

    methods: {

        async obtenerInformacionID() {
            try {
                const response = await axios.get('mascotas/' + this.$route.params.id);
                console.log(response.data); // Agregar esta línea para depurar
                this.mascota = response.data;
                await this.obtenerPropietario();
            } catch (error) {
                console.error(error);
            }
        },

        async obtenerPropietario() {
            try {
                const response = await axios.get('clientes/' + this.mascota.cliente_id);
                console.log(response.data); // Agregar esta línea para depurar
                this.cliente = response.data;
            } catch (error) {
                console.error(error);
            }
        },

        // Inserta en la base de datos
        async altaVisita() {
            try {
                this.visita.coste = parseFloat(this.visita.coste);
                this.visita.mascotas_id = parseFloat(this.visita.mascotas_id);
                console.log(this.visita)
                const res = await axios.post('visitas', this.visita);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Visita registrada correctamente',
                    showConfirmButton: false,
                    timer: 1500
                })
                this.$router.push({ name: 'ListarMascotas' });

            } catch (error) {
                if (error.response.data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error registro visita',
                        text: 'Ingresa los campos correctamente',
                    })
                    this.errores = error.response.data.errors;
                    console.log(this.errores)
                }
            }

        },

        async consultar_veterinarios() {
            try {
                const response = await axios.get('empleados/listar_veterinarios');
                this.veterinarios = response.data;
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

            return `${year}-${month}-${day}`;
        },

    },

    mounted() {
        this.consultar_veterinarios();
    },

};

</script>

<style>
h2 {
    text-align: center;
}
</style>
