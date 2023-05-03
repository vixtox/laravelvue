<template>
    <div class="container">

        <div class="card">
            <div class="card-header bg-dark text-light">
                <h2 class="card-title">Alta cliente</h2>
            </div>
            <form v-on:submit.prevent="agregarRegistro">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Datos personales</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Campos de datos personales aquí -->
                            <div class="col-md-3">
                                <label for="nombre"><b>Nombre:</b></label>
                                <input type="text" class="form-control" required name="nombre" v-model="cliente.nombre"
                                    id="nombre" aria-describedby="helpId" placeholder="Nombre">
                            </div>
                            <div class="col-md-3">
                                <label for="apellidos"><b>Apellidos:</b></label>
                                <input type="text" class="form-control" required name="apellidos"
                                    v-model="cliente.apellidos" id="apellidos" aria-describedby="helpId"
                                    placeholder="Apellidos">
                            </div>
                            <div class="col-md-3">
                                <label for="documento_identidad"><b>NIF/CIF:</b></label>
                                <input type="text" class="form-control" name="documento_identidad"
                                    v-model="cliente.documento_identidad" id="documento_identidad" aria-describedby="helpId"
                                    placeholder="Nº Documento">
                            </div>
                            <div class="col-md-3">
                                <label for="fecha_nacimiento"><b>Fecha nacimiento:</b></label>
                                <input type="date" class="form-control" name="fecha_nacimiento"
                                    v-model="cliente.fecha_nacimiento" id="fecha_nacimiento" aria-describedby="helpId">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Dirección</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Campos de dirección aquí -->
                            <div class="col-md-3">
                                <label for="domicilio"><b>Domicilio:</b></label>
                                <input type="text" class="form-control" required name="domicilio"
                                    v-model="cliente.domicilio" id="domicilio" aria-describedby="helpId"
                                    placeholder="Domicilio">
                            </div>

                            <div class="col-md-3">
                                <label for="codigo_postal"><b>Código postal:</b></label>
                                <input type="text" class="form-control" name="codigo_postal" v-model="cliente.codigo_postal" id="codigo_postal"
                                    aria-describedby="helpId" placeholder="Código postal">
                            </div>
                            <div class="col-md-3">
                                <label for="provincia"><b>Provincia:</b></label>
                                <select class="form-select" id="provincia" v-model="cliente.provincia"
                                    v-on:change="consultar_municipio()" required>
                                    <option disabled value="">Selecciona una provincia</option>
                                    <option v-for="provincia in provincias" :value="provincia.id"
                                        :key="provincia.provincia">
                                        {{ provincia.provincia }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="municipio"><b>Municipio:</b></label>
                                <select class="form-select" id="municipio" v-model="cliente.municipio" required>
                                    <option disabled value="">Selecciona un municipio</option>
                                    <option v-for="municipio in localidades" :value="municipio.municipio"
                                        :key="municipio.municipio">
                                        {{ municipio.municipio }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Datos de contacto</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Campos de datos de contacto aquí -->
                            <div class="col-md-3">
                                <label for="telefono"><b>Teléfono:</b></label>
                                <input type="telefono" class="form-control" required name="telefono"
                                    v-model="cliente.telefono" id="telefono" aria-describedby="helpId"
                                    placeholder="Teléfono">
                            </div>
                            <div class="col-md-3">
                                <label for="email"><b>Email:</b></label>
                                <input type="email" class="form-control" required name="email" v-model="cliente.email"
                                    id="email" aria-describedby="helpId" placeholder="Email">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn-group w-100" role="group" aria-label="">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-person-add"></i>
                    </button>

                    <router-link :to="{ name: 'ExampleComponent' }" class="btn btn-warning">
                        <i class="bi bi-arrow-return-left"></i>
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
            cliente: {
                nombre: "",
                apellidos: "",
                nombre_apellidos: "",
                documento_identidad: "",
                fecha_nacimiento: "",
                domicilio: "",
                municipio: "",
                codigo_postal: "",
                provincia: "",
                provincia_nombre: "",
                telefono: "",
                email: "",
                estado: "Alta",

            },
            provincias: [],
            localidades: [],
        };
    },

    created() {
        const token = document.querySelector('meta[name="csrf-token"]');
        if (token) {
            this.csrfToken = token.content;
        }
    },

    methods: {
        // Inserta en la base de datos una tarea
        agregarRegistro() {

            //Unificamos nombre y apellidos en un único campo
            this.cliente.nombre_apellidos = this.cliente.nombre + " " + this.cliente.apellidos;
              // Buscamos el objeto provincia correspondiente al id seleccionado
              const provincia = this.provincias.find(
                (p) => p.id === this.cliente.provincia
            );
            // Cambiamos el valor de cliente.provincia de id a nombre
            this.cliente.provincia_nombre = provincia.provincia;

            const apiUrl = window.location.origin + '/proyecto/public/';

            fetch(apiUrl + 'clientes', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken,
                },
                body: JSON.stringify({
                    nombre_apellidos: this.cliente.nombre_apellidos,
                    documento_identidad: this.cliente.documento_identidad,
                    fecha_nacimiento: this.cliente.fecha_nacimiento,
                    domicilio: this.cliente.domicilio,
                    codigo_postal: this.cliente.codigo_postal,
                    municipio: this.cliente.municipio,
                    provincia: this.cliente.provincia,
                    provincia_nombre: this.cliente.provincia_nombre,
                    telefono: this.cliente.telefono,
                    email: this.cliente.email,
                    estado: this.cliente.estado
                })
            })
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.error(error);
                });

            this.$router.push('/listarclientes');
        },

        async consultar_provincia() {
            const respuesta = await fetch(
                "php/index.php?consultar_provincias"
            );
            const datosRespuesta = await respuesta.json();
            this.provincias = datosRespuesta;
            console.log(this.provincias)
        },
        async consultar_municipio() {
            console.log(this.cliente.provincia)
            const respuesta = await fetch("php/index.php?consultar_municipio=" + this.cliente.provincia);

            const datosRespuesta = await respuesta.json();
            this.localidades = datosRespuesta;
            console.log(this.localidades)
        },
    },
    mounted() {
        this.consultar_provincia();
    },
};
</script>

<style>
h2 {
    text-align: center;
}
</style>