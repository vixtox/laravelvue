<template>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark text-light">
                <h2 class="card-title">Bioquímica {{ bioquimica.animal === "perro" ? 'perro' : 'gato' }}</h2>
            </div>
            <div class="input-group">
                <button class="btn btn-warning w-100" @click="cambiarAnimal()" title="Cambiar animal">
                    Cambiar a bioquimica {{ change }}
                </button>
            </div>
            <form @submit.prevent="agregarBioquimica">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mascota</th>
                            <th>Propietario</th>
                            <th>Fecha nioquímica</th>
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
                            <td>Urea (mg/dl):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.urea" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '20-50' : '30-60' }}
                            </td>

                        </tr>
                        <tr>
                            <td>Creatinina (mg/dl):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.creatinina" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '0,6-1,4' : '0,5-1,8' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Glucosa (mg/dl):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.glucosa" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '70-105' : '60-140' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Proteínas totales (g/dl):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.proteinas" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '5,3-7,9' : '5,7-8' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Albumina (g/dl):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.albumina" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '2,3-3,8' : '2,3-3,4' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Bilirrubina (mg/dl):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.bilirrubina" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? 'Hasta 0,8' : 'Hasta 0,8' }}
                            </td>
                        </tr>
                        <tr>
                            <td>ALP (U/L):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.alp" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '32-185' : '25-110' }}
                            </td>
                        </tr>
                        <tr>
                            <td>GPT (U/L):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.gpt" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '28-78' : '10-80' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Fósforo (mg/dl):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.fosforo" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '2-6,2' : '2,8-7,2' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Calcio (mg/dl):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.calcio" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '7-11,5' : '7-11,0' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Colesterol (mg/dl):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.colesterol" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '135-260' : '80-180' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Trigliceridos (mg/dl):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.trigliceridos" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '25-120' : '25-120' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Lípidos (mg/dl):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.lipidos" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '100-700' : '140-600' }}
                            </td>
                        </tr>
                        <tr>
                            <td>CPK (U/L):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.cpk" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? 'Hasta 300' : '50-450' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Amilasa (U/L):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.amilasa" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? 'Hasta 1500' : '500-1500' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Lipasa (U/L):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.lipasa" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? 'Hasta 240' : 'Hasta 75' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Sodio (meq/L):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.sodio" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '135-150' : '140-150' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Potasio (meq/L):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.potasio" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '3,6-5,8' : '3,6-5,5' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Cloro (meq/L):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.cloro" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '105-120' : '108-128' }}
                            </td>
                        </tr>
                        <tr>
                            <td>T4 ():</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="bioquimica.t4" />
                            </td>
                            <td>
                                {{ bioquimica.animal === "perro" ? '0,6-2,8' : '0,6-2,6' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="btn-group w-100" role="group" aria-label="">
                    <button type="submit" class="btn btn-success" title="Guardar bioquimica"><i class="fas fa-vial"></i>
                        Guardar bioquimica</button>
                    <router-link :to="{ name: 'FichaVisita', params: { id: bioquimica.visita_id } }" class="btn btn-warning"
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
            bioquimica: {
                urea: null,
                creatinina: null,
                glucosa: null,
                proteinas: null,
                albumina: null,
                bilirrubina: null,
                alp: null,
                gpt: null,
                fosforo: null,
                calcio: null,
                colesterol: null,
                trigliceridos: null,
                lipidos: null,
                cpk: null,
                amilasa: null,
                lipasa: null,
                sodio: null,
                potasio: null,
                cloro: null,
                t4: null,
                fecha: "",
                animal: "perro",
                mascotas_id: "",
                visita_id: this.$route.params.id,
            },
            change: "gato",
            mascota: [],
            cliente: [],
            visita: [],
            formularioRelleno: false,
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

        validarCamposLlenos() {
            const validacion = {
                urea: this.bioquimica.urea,
                creatinina: this.bioquimica.creatinina,
                glucosa: this.bioquimica.glucosa,
                proteinas: this.bioquimica.proteinas,
                albumina: this.bioquimica.albumina,
                bilirrubina: this.bioquimica.bilirrubina,
                alp: this.bioquimica.alp,
                gpt: this.bioquimica.gpt,
                fosforo: this.bioquimica.fosforo,
                calcio: this.bioquimica.calcio,
                colesterol: this.bioquimica.colesterol,
                trigliceridos: this.bioquimica.trigliceridos,
                lipidos: this.bioquimica.lipidos,
                cpk: this.bioquimica.cpk,
                amilasa: this.bioquimica.amilasa,
                lipasa: this.bioquimica.lipasa,
                sodio: this.bioquimica.sodio,
                potasio: this.bioquimica.potasio,
                cloro: this.bioquimica.cloro,
                t4: this.bioquimica.t4,
            };
            // const camposValidacion = Object.values(validacion);

            for (let i = 0; i < validacion.length; i++) {
                if (camposValidacion[i] !== null) {
                    this.formularioRelleno = true; // Al menos un campo tiene un valor distinto de null
                    return true;
                }
            }

            return false; // Ningún campo tiene un valor distinto de null
        },


        async obtenerInformacionID() {
            try {
                const response = await axios.get('visitas/bioquimica/' + this.bioquimica.visita_id);
                console.log(response.data); // Agregar esta línea para depurar
                this.mascota = response.data.mascota;

                this.cliente = response.data.cliente;
                this.visita = response.data.visita;
            } catch (error) {
                console.error(error);
            }
        },

        // Inserta en la base de datos
        async agregarBioquimica() {

            this.validarCamposLlenos();

            if (this.formularioRelleno) {

                this.bioquimica.mascotas_id = this.mascota.id;
                this.bioquimica.fecha = this.visita.fecha_visita;
                try {
                    console.log(this.bioquimica)
                    const res = await axios.post('bioquimicas', this.bioquimica);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Bioquímica registrada correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.$router.push({ name: 'FichaVisita', params: { id: this.bioquimica.visita_id } });

                } catch (error) {
                    if (error.response.data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error registro bioquimica',
                            text: 'Ingresa los campos correctamente',
                        })
                        this.errores = error.response.data.errors;
                        console.log(this.errores)
                    }
                }

            }else{

                Swal.fire({
                            icon: 'error',
                            title: 'Error registro bioquimica',
                            text: 'Ingrese al menos un parámetro',
                        })

            }

        },

        cambiarAnimal() {
            if (this.bioquimica.animal === "perro") {
                this.bioquimica.animal = "gato";
                this.change = "perro";
            } else {
                this.bioquimica.animal = "perro";
                this.change = "gato";
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

    }
};
</script>