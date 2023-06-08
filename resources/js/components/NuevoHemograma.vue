<template>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark text-light">
                <h2 class="card-title">Hemograma {{ hemograma.animal === "perro" ? 'perro' : 'gato' }}</h2>
            </div>
            <!-- <div class="card-body">
                <button class="btn btn-warning m_izq m_der" @click="cambiarAnimal()" title="Cambiar animal">
                    <i class="fas fa-sync-alt"></i> Hemograma {{ change }}
                </button>
            </div> -->
            <form @submit.prevent="agregarHemograma">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mascota</th>
                            <th>Propietario</th>
                            <th>Fecha hemograma</th>
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
                            <td>Hematocrito:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.hematocrito" />
                                <span v-if="errores.hematocrito" class="text-danger">{{ errores.hematocrito[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '37-55' : '30-45' }} (%)
                            </td>

                        </tr>
                        <tr>
                            <td>Hemoglobina:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.hemoglobina" />
                                <span v-if="errores.hemoglobina" class="text-danger">{{ errores.hemoglobina[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '12-18' : '8-15' }} (g/dl)
                            </td>
                        </tr>
                        <tr>
                            <td>Recuento G. rojos:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.g_rojo" />
                                <span v-if="errores.g_rojo" class="text-danger">{{ errores.g_rojo[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '5,5-8,5' : '5-10' }} (millones/µl)
                            </td>
                        </tr>
                        <tr>
                            <td>VCM:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.vcm" />
                                <span v-if="errores.vcm" class="text-danger">{{ errores.vcm[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '60-77' : '39-55' }} (fL)
                            </td>
                        </tr>
                        <tr>
                            <td>HCM:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.hcm" />
                                <span v-if="errores.hcm" class="text-danger">{{ errores.hcm[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '19,5-24,5' : '12,5-17,5' }} (pg)
                            </td>
                        </tr>
                        <tr>
                            <td>CHCM:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.chcm" />
                                <span v-if="errores.chcm" class="text-danger">{{ errores.chcm[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '32-36' : '30-36' }} (g/dl)
                            </td>
                        </tr>
                        <tr>
                            <td>Reticulocitos:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.reticulocitos" />
                                <span v-if="errores.reticulocitos" class="text-danger">{{ errores.reticulocitos[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? 'hasta 1' : 'hasta 1,5' }} (%)
                            </td>
                        </tr>
                        <tr>
                            <td>Leucocitos:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.leucocitos" />
                                <span v-if="errores.leucocitos" class="text-danger">{{ errores.leucocitos[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '6000-18000' : '5500-19500' }} (/μl)
                            </td>
                        </tr>
                        <tr>
                            <td>Eosinófilos:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.eosinofilos" />
                                <span v-if="errores.eosinofilos" class="text-danger">{{ errores.eosinofilos[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '100-1250' : '0-1500' }} (/μl)
                            </td>
                        </tr>
                        <tr>
                            <td>Linfocitos:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.linfocitos" />
                                <span v-if="errores.linfocitos" class="text-danger">{{ errores.linfocitos[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '1000-4800' : '1500-7000' }} (/μl)
                            </td>
                        </tr>
                        <tr>
                            <td>Monocitos:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.monocitos" />
                                <span v-if="errores.monocitos" class="text-danger">{{ errores.monocitos[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '150-1350' : '0-850' }} (/μl)
                            </td>
                        </tr>
                        <tr>
                            <td>Plaquetas:</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.plaquetas" />
                                <span v-if="errores.plaquetas" class="text-danger">{{ errores.plaquetas[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '150-500' : '300-700' }} (miles/μl)
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-body">
                    <div class="btn-group w-100" role="group" aria-label="">
                        <button type="submit" class="btn btn-success m_izq" title="Guardar hemograma"><i
                                class="fa fa-save"></i></button>
                        <router-link :to="{ name: 'FichaVisita', params: { id: hemograma.visita_id } }"
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
            hemograma: {
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
                visita_id: this.$route.params.id,
            },
            errores: {},
            // change: "gato",
            mascota: [],
            cliente: [],
            visita: [],
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
                const response = await axios.get('visitas/hemograma/' + this.hemograma.visita_id);
                console.log(response.data); // Agregar esta línea para depurar
                this.mascota = response.data.mascota;
                this.hemograma.mascotas_id = this.mascota.id;
                this.cliente = response.data.cliente;
                this.visita = response.data.visita;

                if (this.mascota.especie_id === 1) {
                    this.hemograma.animal = 'perro';
                } else {
                    this.hemograma.animal = 'gato';
                }

            } catch (error) {
                console.error(error);
            }
        },


        // Inserta en la base de datos
        async agregarHemograma() {
            if (this.visita.hemograma_id === null) {

                this.hemograma.fecha = this.visita.fecha_visita;
                try {
                    console.log(this.hemograma)
                    const res = await axios.post('hemogramas', this.hemograma);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Hemograma registrado correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.$router.push({ name: 'FichaVisita', params: { id: this.hemograma.visita_id } });

                } catch (error) {
                    if (error.response.data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error registro hemograma',
                            text: 'Ingresa los campos correctamente',
                        })
                        this.errores = error.response.data.errors;
                        console.log(this.errores)
                    }
                }

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error registro hemograma',
                    text: 'Ya has registrado el hemograma de esta visita',
                })
            }


        },

        // cambiarAnimal() {
        //     if (this.hemograma.animal === "perro") {
        //         this.hemograma.animal = "gato";
        //         this.change = "perro";
        //     } else {
        //         this.hemograma.animal = "perro";
        //         this.change = "gato";
        //     }
        // },

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