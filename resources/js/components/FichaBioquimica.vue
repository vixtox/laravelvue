<template>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark text-light">
                <h2 class="card-title">Bioquímica {{ bioquimica.animal === "perro" ? 'perro' : 'gato' }}</h2>
            </div>
            <form @submit.prevent="editarBioquimica">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mascota</th>
                            <th>Propietario</th>
                            <th>Fecha bioquimica</th>
                        </tr>
                        <tr>
                            <td>
                                <span class="form-control gris">{{ mascota.nombre }}</span>
                            </td>
                            <td>
                                <span class="form-control gris">{{ cliente.nombre_apellidos }}</span>
                            </td>
                            <td>
                                <span class="form-control gris">{{ new Date(visita.fecha_visita).toLocaleDateString('es-ES',
                                    {
                                        day: '2-digit', month:
                                            '2-digit', year: 'numeric'
                                    }) }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Parámetro</th>
                            <th>Resultado</th>
                            <th>Referencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Urea:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.urea" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '20-50' : '30-60' }} (mg/dl)
                            </td>

                        </tr>
                        <tr>
                            <td>Creatinina:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.creatinina" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '0,6-1,4' : '0,5-1,8' }} (mg/dl)
                            </td>
                        </tr>
                        <tr>
                            <td>Glucosa:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.glucosa" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '70-105' : '60-140' }} (mg/dl)
                            </td>
                        </tr>
                        <tr>
                            <td>Proteínas totales:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.proteinas" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '5,3-7,9' : '5,7-8' }} (g/dl)
                            </td>
                        </tr>
                        <tr>
                            <td>Albumina:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.albumina" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '2,3-3,8' : '2,3-3,4' }} (g/dl)
                            </td>
                        </tr>
                        <tr>
                            <td>Bilirrubina:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.bilirrubina" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? 'Hasta 0,8' : 'Hasta 0,8' }} (mg/dl)
                            </td>
                        </tr>
                        <tr>
                            <td>ALP:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.alp" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '32-185' : '25-110' }} (U/L)
                            </td>
                        </tr>
                        <tr>
                            <td>GPT:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.gpt" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '28-78' : '10-80' }} (U/L)
                            </td>
                        </tr>
                        <tr>
                            <td>Fósforo:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.fosforo" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '2-6,2' : '2,8-7,2' }} (mg/dl)
                            </td>
                        </tr>
                        <tr>
                            <td>Calcio:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.calcio" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '7-11,5' : '7-11,0' }} (mg/dl)
                            </td>
                        </tr>
                        <tr>
                            <td>Colesterol:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.colesterol" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '135-260' : '80-180' }} (mg/dl)
                            </td>
                        </tr>
                        <tr>
                            <td>Trigliceridos:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.trigliceridos" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '25-120' : '25-120' }} (mg/dl)
                            </td>
                        </tr>
                        <tr>
                            <td>Lípidos:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.lipidos" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '100-700' : '140-600' }} (mg/dl)
                            </td>
                        </tr>
                        <tr>
                            <td>CPK:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.cpk" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? 'Hasta 300' : '50-450' }} (U/L)
                            </td>
                        </tr>
                        <tr>
                            <td>Amilasa:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.amilasa" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? 'Hasta 1500' : '500-1500' }} (U/L)
                            </td>
                        </tr>
                        <tr>
                            <td>Lipasa:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.lipasa" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? 'Hasta 240' : 'Hasta 75' }} (U/L)
                            </td>
                        </tr>
                        <tr>
                            <td>Sodio:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.sodio" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '135-150' : '140-150' }} (meq/L)
                            </td>
                        </tr>
                        <tr>
                            <td>Potasio:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.potasio" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '3,6-5,8' : '3,6-5,5' }} (meq/L)
                            </td>
                        </tr>
                        <tr>
                            <td>Cloro:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.cloro" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '105-120' : '108-128' }} (meq/L)
                            </td>
                        </tr>
                        <tr>
                            <td>T4:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.t4" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '0,6-2,8' : '0,6-2,6' }} μg/dL
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-body">
                    <div class="btn-group w-100" role="group" aria-label="">
                        <button type="submit" class="btn btn-success m_izq" title="Guardar bioquímica"><i
                                class="fa fa-save"></i>
                        </button>
                        <router-link :to="{ name: 'FichaVisita', params: { id: bioquimica.visita_id } }"
                            class="btn btn-warning m_der" title="Volver">
                            <i class="bi bi-arrow-return-left fw-bold"></i>
                        </router-link>
                    </div>
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
            bioquimica: {
                hematocrito: null,
                hemoglobina: null,
                g_rojo: null,
                vcm: null,
                hcm: null,
                chcm: null,
                reticulocitos: null,
                eosinofilos: null,
                linfocitos: null,
                monocitos: null,
                leucocitos: null,
                plaquetas: null,
                fecha: "",
                animal: "",
                mascotas_id: "",
                visita_id: null,
            },
            mascota: [],
            cliente: [],
            visita: [],
            id: this.$route.params.id,
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
                const response = await axios.get('bioquimicas/' + this.id);
                console.log(response.data); // Agregar esta línea para depurar
                this.mascota = response.data.mascota;
                this.cliente = response.data.cliente;
                this.visita = response.data.visita;
                this.bioquimica = response.data.bioquimica;

                if (this.mascota.especie_id === 1) {
                    this.bioquimica.animal = 'perro';
                } else {
                    this.bioquimica.animal = 'gato';
                }

            } catch (error) {
                console.error(error);
            }
        },

        // Edita visita en la base de datos
        async editarBioquimica() {

            console.log(this.visita)
            const res = await axios.put('bioquimicas/' + this.id, this.bioquimica)
                .then(response => {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Cambios guardados',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    console.log(response)
                })
                .catch(error => {
                    console.log(error.response);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error actualizar bioquímica',
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

    }
};
</script>