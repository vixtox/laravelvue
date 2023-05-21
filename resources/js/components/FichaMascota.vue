<template>
    <div class="container">

        <div class="card">
            <div class="card-header bg-dark text-light">
                <h2 class="card-title">Ficha mascota</h2>
            </div>
            <form v-on:submit.prevent="editarMascota">
                <div class="card">
                    <div class="btn-group w-100" role="group" aria-label="">
                        <router-link :to="{ name: 'NuevaVisita' }" class="btn btn-success w-50" title="Nueva Visita">
                            <i class="fa fa-clinic-medical"></i></router-link>
                        <router-link :to="{ name: 'ListarVisitas' }" class="btn btn-info w-50" title="Listar visitas">
                            <i class="fa-solid fa-eye" style="color: #ffffff;"></i> <i
                                class="fa fa-clinic-medical" style="color: #ffffff;"></i></router-link>
                    </div>
                    <div class="card-header">
                        <h5 class="card-title">Datos identificación</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Campos de datos personales aquí -->
                            <div class="col-md-3 col-sm-6">
                                <label for="nombre"><b>Nombre:</b></label>
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
                            <div v-if="mostrar_span" class="col-md-3 col-sm-6">
                                <label><b>Propietario:</b></label>
                                <span class="form-control">{{ mascota.nombre_cliente }}</span>
                            </div>
                            <div v-if="false" class="col-md-3 col-sm-6">
                                <label for="cliente_id"><b>Propietario id:</b></label>
                                <input type="text" class="form-control" name="cliente_id" v-model="mascota.cliente_id"
                                    id="cliente_id" aria-describedby="helpId" placeholder="cliente_id">
                            </div>
                            <div v-if="mostrar_span" class="col-md-3 col-sm-6">
                                <br>
                                <button class="btn btn-danger w-100" title="Cambiar propietario" @click="visibilidad()"> <i
                                        class="fa fa-user fa-fw"></i>
                                    <i class="fa fa-exchange-alt fa-fw"></i>
                                    <i class="fa fa-user fa-fw"></i></button>
                            </div>
                            <div v-if="mostrar_input" class="col-md-3 col-sm-6">
                                <label for="cliente_id"><b>Propietario:</b></label>
                                <input type="text" id="searchInput" @input="searchTerm = $event.target.value"
                                    placeholder="Buscar cliente" class="form-control">
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
                                <label for="especie_id"><b>Especie:</b></label>
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
                                <label for="razas_id"><b>Raza:</b></label>
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
                                <label for="caracter"><b>Carácter:</b></label>
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
                                <label for="sexo"><b>Sexo:</b></label>
                                <select class="form-select" id="sexo" v-model="mascota.sexo">
                                    <option disabled value="">Selecciona un sexo</option>
                                    <option value="Macho">Macho</option>
                                    <option value="Hembra">Hembra</option>
                                </select>
                                <div class="alert alert-danger" v-if="errores.sexo">{{ errores.sexo[0]
                                }}</div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label for="estado"><b>Estado:</b></label>
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

                <div class="btn-group w-100" role="group" aria-label="">
                    <button type="submit" class="btn btn-success" title="Guardar">
                        <i class="fa fa-save"></i>
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
            mascota: {
                nombre_cliente: "",
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
            id: this.$route.params.id,
            clienteToDelete: null,
            searchTerm: '',
            selectedClient: null,
            mostrar_span: true,
            mostrar_input: false
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
                const response = await axios.get('mascotas/' + id);
                console.log(response.data); // Agregar esta línea para depurar
                this.mascota = response.data;
                await this.consultar_razas();
            } catch (error) {
                console.error(error);
            }
        },

        // Edita mascota en la base de datos
        async editarMascota() {
            console.log(this.mascota)
            const res = await axios.put('mascotas/' + this.id, this.mascota)
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
            this.mostrar_input = false;
            this.mostrar_span = true;
        },

        async consultar_razas() {

            try {
                const response = await axios.get('razas/' + this.mascota.especie_id);
                console.log(this.mascota.especie_id);
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

            return `${year}-${month}-${day}`;
        },

        visibilidad() {
            this.mostrar_input = true;
            this.mostrar_span = false;
            this.cambiar_propietario();
        },

        cambiar_propietario() {
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
                                // vm.$router.push({ name: 'FichaCliente', params: { id: vm.selectedClient.id } });
                                this.mascota.cliente_id = vm.selectedClient.id;
                                this.mascota.nombre_cliente = vm.selectedClient.nombre_apellidos;
                                this.mostrar_input = false;
                                this.mostrar_span = true;
                            }

                            return false;
                        },

                    });
                })
                .catch((error) => {
                    console.error(error);
                });
        }

    },



};
</script>

<style>
h2 {
    text-align: center;
}
</style>