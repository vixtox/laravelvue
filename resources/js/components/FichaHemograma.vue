<template>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark text-light">
                <h2 class="card-title">Hemograma {{ hemograma.animal === "perro" ? 'perro' : 'gato' }}</h2>
            </div>
            <div class="input-group">
                <button class="btn btn-warning w-100" @click="cambiarAnimal()" title="Cambiar animal">
                    Cambiar a hemograma {{ change }}
                </button>
            </div>
            <form @submit.prevent="editarHemograma">
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
                            <td>Hematocrito (%):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.hematocrito" />
                                <span v-if="errores.hematocrito" class="text-danger">{{ errores.hematocrito[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '37-55' : '30-45' }}
                            </td>

                        </tr>
                        <tr>
                            <td>Hemoglobina (g/dl):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.hemoglobina" />
                                <span v-if="errores.hemoglobina" class="text-danger">{{ errores.hemoglobina[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '12-18' : '8-15' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Recuento G. rojos (millones/µl):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.g_rojo" />
                                <span v-if="errores.g_rojo" class="text-danger">{{ errores.g_rojo[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '5,5-8,5' : '5-10' }}
                            </td>
                        </tr>
                        <tr>
                            <td>VCM (fL):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.vcm" />
                                <span v-if="errores.vcm" class="text-danger">{{ errores.vcm[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '60-77' : '39-55' }}
                            </td>
                        </tr>
                        <tr>
                            <td>HCM (pg):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.hcm" />
                                <span v-if="errores.hcm" class="text-danger">{{ errores.hcm[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '19,5-24,5' : '12,5-17,5' }}
                            </td>
                        </tr>
                        <tr>
                            <td>CHCM (g/dl):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.chcm" />
                                <span v-if="errores.chcm" class="text-danger">{{ errores.chcm[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '32-36' : '30-36' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Reticulocitos (%):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.reticulocitos" />
                                <span v-if="errores.reticulocitos" class="text-danger">{{ errores.reticulocitos[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? 'hasta 1' : 'hasta 1,5' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Leucocitos (/μl):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.leucocitos" />
                                <span v-if="errores.leucocitos" class="text-danger">{{ errores.leucocitos[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '6000-18000' : '5500-19500' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Eosinófilos (/μl):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.eosinofilos" />
                                <span v-if="errores.eosinofilos" class="text-danger">{{ errores.eosinofilos[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '100-1250' : '0-1500' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Linfocitos (/μl):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.linfocitos" />
                                <span v-if="errores.linfocitos" class="text-danger">{{ errores.linfocitos[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '1000-4800' : '1500-7000' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Monocitos (/μl):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.monocitos" />
                                <span v-if="errores.monocitos" class="text-danger">{{ errores.monocitos[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '150-1350' : '0-850' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Plaquetas (miles/μl):</td>
                            <td>
                                <input type="number" step="0.01" class="form-control" v-model="hemograma.plaquetas" />
                                <span v-if="errores.plaquetas" class="text-danger">{{ errores.plaquetas[0] }}</span>
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '150-500' : '300-700' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="btn-group w-100" role="group" aria-label="">
                    <button type="submit" class="btn btn-success" title="Guardar hemograma"><i class="fas fa-vial"></i>
                        Guardar hemograma</button>
                    <router-link :to="{ name: 'FichaVisita', params: { id: hemograma.visita_id } }" class="btn btn-warning"
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
                animal: "perro",
                mascotas_id: "",
                visita_id: null,
            },
            errores: {},
            change: "gato",
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
                const response = await axios.get('hemogramas/' + this.id);
                console.log(response.data); // Agregar esta línea para depurar
                this.mascota = response.data.mascota;
                // this.hemograma.mascotas_id = this.mascota.id;
                this.cliente = response.data.cliente;
                this.visita = response.data.visita;
                this.hemograma = response.data.hemograma;
            } catch (error) {
                console.error(error);
            }
        },

         // Edita visita en la base de datos
         async editarHemograma() {
            console.log(this.visita)
            const res = await axios.put('hemogramas/' + this.id, this.hemograma)
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
                        title: 'Error actualizar hemograma',
                        text: 'Ingresa los campos correctamente',
                    })
                    this.errores = error.response.data.errors;
                });
        },

        cambiarAnimal() {
            if (this.hemograma.animal === "perro") {
                this.hemograma.animal = "gato";
                this.change = "perro";
            } else {
                this.hemograma.animal = "perro";
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