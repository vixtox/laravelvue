<template>
    <div class="container">
        <div class="card">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="input-group">
                        <button class="btn btn-warning w-50" @click="cambiarAnimal()" title="Cambiar animal">
                            Cambiar animal
                        </button>
                        <input type="date" class="form-control w-50" name="fecha" :max="maxDate" v-model="hemograma.fecha"
                            id="fecha" aria-describedby="helpId">
                    </div>
                </div>
            </div>

            <div class="card-header bg-dark text-light">
                <h2 class="card-title">Hemograma {{ hemograma.animal === "perro" ? 'perro' : 'gato' }}</h2>
            </div>
            <form @submit.prevent="agregarHemograma">
                <table class="table">
                    <thead>
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
                                <input type="number" class="form-control" v-model="hemograma.hematocrito" />
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '37-55' : '30-45' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Hemoglobina (g/dl):</td>
                            <td>
                                <input type="number" class="form-control" v-model="hemograma.hemoglobina" />
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '12-18' : '8-15' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Recuento G. rojos (millones/µl):</td>
                            <td>
                                <input type="number" class="form-control" v-model="hemograma.g_rojo" />
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '5,5-8,5' : '5-10' }}
                            </td>
                        </tr>
                        <tr>
                            <td>VCM (fL):</td>
                            <td>
                                <input type="number" class="form-control" v-model="hemograma.vcm" />
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '60-77' : '39-55' }}
                            </td>
                        </tr>
                        <tr>
                            <td>HCM (pg):</td>
                            <td>
                                <input type="number" class="form-control" v-model="hemograma.hcm" />
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '19,5-24,5' : '12,5-17,5' }}
                            </td>
                        </tr>
                        <tr>
                            <td>CHCM (g/dl):</td>
                            <td>
                                <input type="number" class="form-control" v-model="hemograma.chcm" />
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '32-36' : '30-36' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Reticulocitos (%):</td>
                            <td>
                                <input type="number" class="form-control" v-model="hemograma.reticulocitos" />
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? 'hasta 1' : 'hasta 1,5' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Leucocitos (/μl):</td>
                            <td>
                                <input type="number" class="form-control" v-model="hemograma.leucocitos" />
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '6000-18000' : '5500-19500' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Eosinófilos (/μl):</td>
                            <td>
                                <input type="number" class="form-control" v-model="hemograma.eosinofilos" />
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '100-1250' : '0-1500' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Linfocitos (/μl):</td>
                            <td>
                                <input type="number" class="form-control" v-model="hemograma.linfocitos" />
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '1000-4800' : '1500-7000' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Monocitos (/μl):</td>
                            <td>
                                <input type="number" class="form-control" v-model="hemograma.monocitos" />
                            </td>
                            <td>
                                {{ hemograma.animal === "perro" ? '150-1350' : '1500-7000' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Plaquetas (miles/μl):</td>
                            <td>
                                <input type="number" class="form-control" v-model="hemograma.plaquetas" />
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
                    <router-link :to="{ name: 'FichaVisita', params: { id: hemograma.mascotas_id } }" class="btn btn-warning"
                        title="Volver">
                        <i class="bi bi-arrow-return-left fw-bold"></i>
                    </router-link>
                </div>
            </form>
        </div>
    </div>
</template>
  

  
<script>
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
                eosinofilos: null,
                plaquetas: null,
                animal: "perro",
                mascotas_id: this.$route.params.id,
            },

        };
    },

    methods: {
     // Inserta en la base de datos
     async agregarHemograma() {
            try {
                const res = await axios.post('hemogramas', this.hemograma);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Hemograma registrado correctamente',
                    showConfirmButton: false,
                    timer: 1500
                })
                this.$router.push({ name: 'ListarMascotas' });

            } catch (error) {
                if (error.response.data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error registro hemograma',
                        text: 'Ingresa los campos correctamente',
                    })
                    this.errores = error.response.data.errors;
                }
            }

        },

        cambiarAnimal() {
            if (this.hemograma.animal === "perro") {
                this.hemograma.animal = "gato"
            } else {
                this.hemograma.animal = "perro"
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
  