<template>
    <div class="container">

        <div class="card">
            <div class="card-header bg-dark text-light">
                <h2 class="card-title">Alta mascota</h2>
            </div>
            <form v-on:submit.prevent="altaMascota">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Datos identificación</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Campos de datos personales aquí -->
                            <div class="col-md-3 col-sm-6">
                                <label for="nombre"><b><span class="text-danger">* </span>Nombre:</b></label>
                                <input type="text" class="form-control" name="nombre" v-model="mascota.nombre" id="nombre"
                                    aria-describedby="helpId" placeholder="Nombre">
                                <div class="alert alert-danger" v-if="errores.nombre">{{
                                    errores.nombre[0]
                                }}</div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="chip"><b>Chip:</b></label>
                                <input type="text" class="form-control" name="chip" v-model="mascota.chip" id="chip"
                                    aria-describedby="helpId" placeholder="Nº Chip">
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <label for="searchInput"><b><span class="text-danger">* </span>Propietario:</b></label>
                                <input type="text" id="searchInput" :value="searchTerm"
                                    @input="searchTerm = $event.target.value" placeholder="Buscar cliente"
                                    class="form-control">
                                <div class="alert alert-danger" v-if="errores.cliente_id">{{
                                    errores.cliente_id[0]
                                }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Datos generales</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Campos de características aquí -->
                            <div class="col-md-3 col-sm-6">
                                <label for="especie_id"><b><span class="text-danger">* </span>Especie:</b></label>
                                <select class="form-select" id="especie_id" v-model="mascota.especie_id"
                                    v-on:change="consultar_razas()">
                                    <option disabled value="">Selecciona una especie</option>
                                    <option value=1>Perro</option>
                                    <option value=2>Gato</option>
                                    <option value=3>Conejo</option>
                                    <option value=4>Hurón</option>
                                </select>
                                <div class="alert alert-danger" v-if="errores.especie_id">{{ errores.especie_id[0]
                                }}</div>
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <label for="razas_id"><b><span class="text-danger">* </span>Raza:</b></label>
                                <select class="form-select" id="razas_id" v-model="mascota.razas_id">
                                    <option disabled value="">Selecciona una raza</option>
                                    <option v-for="razas_id in razas" :value="razas_id.id" :key="razas_id.raza">
                                        {{ razas_id.raza }}
                                    </option>
                                </select>
                                <div class="alert alert-danger" v-if="errores.razas_id">{{ errores.razas_id[0] }}
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="capa"><b>Capa:</b></label>
                                <input type="text" class="form-control" name="capa" v-model="mascota.capa" id="capa"
                                    aria-describedby="helpId" placeholder="capa">
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="caracter"><b><span class="text-danger">* </span>Carácter:</b></label>
                                <select class="form-select" id="caracter" v-model="mascota.caracter">
                                    <option disabled value="">Selecciona un carácter</option>
                                    <option value="Sociable">Sociable</option>
                                    <option value="Miedoso">Miedoso</option>
                                    <option value="Nervioso">Nervioso</option>
                                    <option value="Agresivo">Agresivo</option>
                                </select>
                                <div class="alert alert-danger" v-if="errores.caracter">{{ errores.caracter[0]
                                }}</div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="fecha_nacimiento"><b>Fecha nacimiento:</b></label>
                                <input type="date" class="form-control" name="fecha_nacimiento" :max="maxDate"
                                    v-model="mascota.fecha_nacimiento" id="fecha_nacimiento" aria-describedby="helpId">
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="sexo"><b><span class="text-danger">* </span>Sexo:</b></label>
                                <select class="form-select" id="sexo" v-model="mascota.sexo">
                                    <option disabled value="">Selecciona un sexo</option>
                                    <option value="Macho">Macho</option>
                                    <option value="Hembra">Hembra</option>
                                </select>
                                <div class="alert alert-danger" v-if="errores.sexo">{{ errores.sexo[0]
                                }}</div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="estado"><b><span class="text-danger">* </span>Estado:</b></label>
                                <select class="form-select" id="estado" v-model="mascota.estado">
                                    <option disabled value="">Selecciona un estado</option>
                                    <option value="Fértil">Fértil</option>
                                    <option value="Castrado">Castrado</option>
                                </select>
                                <div class="alert alert-danger" v-if="errores.estado">{{ errores.estado[0]
                                }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Datos baja</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Campos de datos baja aquí -->
                            <div class="col-md-3 col-sm-6">
                                <label for="fecha_baja"><b>Fecha baja:</b></label>
                                <input type="date" class="form-control" name="fecha_baja" :max="maxDate"
                                    v-model="mascota.fecha_baja" id="fecha_baja" aria-describedby="helpId">
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="causa_baja"><b>Causa baja:</b></label>
                                <select class="form-select" id="causa_baja" v-model="mascota.causa_baja">
                                    <option disabled value="">Selecciona un causa_baja</option>
                                    <option value="Enfermedad">Enfermedad</option>
                                    <option value="Accidente">Accidente</option>
                                    <option value="Eutanasia">Eutanasia</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                <div class="btn-group w-100" role="group" aria-label="">
                    <button type="submit" class="btn btn-success m_izq" title="Alta mascota">
                        <i class="fas fa-paw"></i>
                    </button>

                    <router-link :to="{ name: 'ListarMascotas' }" class="btn btn-warning m_der" title="Volver">
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
            mascota: {
                nombre: "",
                chip: "",
                capa: "",
                caracter: "",
                sexo: "",
                estado: "",
                fecha_nacimiento: "",
                fecha_baja: "",
                causa_baja: "",
                cliente_id: "",
                especie_id: "",
                razas_id: "",
            },
            razas: [],
            errores: {},
            searchTerm: '',
            selectedClient: null
        };
    },

    created() {
        const token = document.querySelector('meta[name="csrf-token"]');
        if (token) {
            this.csrfToken = token.content;
        }
    },

    mounted() {
        const vm = this;

        axios.get("clientes/buscar", { params: { search: '' } })
            .then((res) => {
                // Inicializar Autocomplete dentro de la promesa
                $("#searchInput").autocomplete({
                    source: res.data.map((cliente) => cliente.nombre_apellidos),
                    select: (event, ui) => {
                        vm.searchTerm = ui.item.value;

                        // Obtener el objeto completo del cliente seleccionado
                        vm.selectedClient = res.data.find((cliente) => cliente.nombre_apellidos === ui.item.value);

                        if (vm.selectedClient) {
                            // Redirigir al usuario a la ruta FichaCliente con el parámetro id
                            this.mascota.cliente_id = vm.selectedClient.id;
                            console.log(this.mascota.cliente_id)
                        }

                        return false;
                    },

                });
            })
            .catch((error) => {
                console.error(error);
            });
    },

    methods: {
        // Inserta en la base de datos
        async altaMascota() {
            try {
                this.mascota.especie_id = parseInt(this.mascota.especie_id);
                console.log(this.mascota)
                const res = await axios.post('mascotas', this.mascota);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Mascota registrada correctamente',
                    showConfirmButton: false,
                    timer: 1500
                })
                this.$router.push({ name: 'ListarMascotas' });

            } catch (error) {
                if (error.response.data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error registro mascota',
                        text: 'Ingresa los campos correctamente',
                    })
                    this.errores = error.response.data.errors;
                }
            }

        },

        async consultar_razas() {
            try {
                console.log(this.mascota.especie_id)
                const response = await axios.get('razas/' + this.mascota.especie_id);
                this.razas = response.data;
                console.log(this.razas)
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

};

</script>

<style>
h2 {
    text-align: center;
}
</style>