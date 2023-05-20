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
                                <label for="mascotas_id"><b>Código mascota:</b></label>
                                <span class="form-control">{{ visita.mascotas_id }}</span>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="fecha_visita"><b>Fecha visita:</b></label>
                                <input type="date" class="form-control" name="fecha_visita" :max="maxDate"
                                    v-model="visita.fecha_visita" id="fecha_visita" aria-describedby="helpId">
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="hora_visita"><b>Hora visita:</b></label>
                                <input type="time" class="form-control" name="hora_visita" v-model="visita.hora_visita"
                                    id="hora_visita" aria-describedby="helpId">
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="veterinario"><b>Veterinario:</b></label>
                                <select class="form-select" id="veterinario" v-model="visita.veterinario">
                                    <option disabled value="">Selecciona un veterinario</option>
                                    <option v-for="veterinario in veterinarios" :value="veterinario.id"
                                        :key="veterinario.nombre_apellidos">
                                        {{ veterinario.nombre_apellidos }}
                                    </option>
                                </select>
                                <div class="alert alert-danger" v-if="errores.veterinario">{{ errores.veterinario[0]
                                }}</div>
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
                            <div class="col-md-12 col-sm-6">
                                <label for="sintomas"><b>Síntomas:</b></label>
                                <textarea class="form-control" id="sintomas"></textarea>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label for="diagnostico"><b>Diagnóstico:</b></label>
                                <textarea class="form-control" id="diagnostico"></textarea>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label for="tratamiento"><b>Tratamiento:</b></label>
                                <textarea class="form-control" id="tratamiento"></textarea>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="coste"><b>Coste:</b></label>
                                <input type="number"  step="0.01" class="form-control" name="coste" v-model="visita.coste" id="coste"
                                    aria-describedby="helpId" placeholder="Coste">
                                <div class="alert alert-danger" v-if="errores.coste">{{
                                    errores.coste[0]
                                }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn-group w-100" role="group" aria-label="">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-paw"></i>
                    </button>

                    <router-link :to="{ name: 'ListarMascotas' }" class="btn btn-warning">
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
                coste: 0,
            },
            errores: {},
            veterinarios: [],
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
        async altaVisita() {
            try {
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
