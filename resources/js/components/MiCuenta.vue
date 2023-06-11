<template>
    <div class="container">

        <div v-if="mostrar_datos" class="card">
            <div class="card-header bg-dark text-light">
                <h2 class="card-title">Mi Cuenta</h2>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Datos usuario</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <span class="form-control gris">{{ user.name }}</span>
                                </td>
                                <td>
                                    <span class="form-control gris">{{ user.email }}</span>
                                </td>
                                <td>
                                    <span class="form-control gris">{{ user.tipo }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="btn-group w-100  mt-2 mb-2" role="group" aria-label="">
                <button class="btn btn-danger m_izq" @click="mostrarPassword()" title="Cambiar contraseña">
                    <i class="fas fa-key"></i>
                </button>
                <router-link :to="{ name: 'ListarMascotas' }" class="btn btn-warning m_der" title="Volver">
                    <i class="bi bi-arrow-return-left fw-bold"></i>
                </router-link>
            </div>
        </div>

        <div v-if="mostrar_password" class="card">
            <div class="card-header bg-dark text-light">
                <h2 class="card-title">Mi Cuenta</h2>
            </div>
            <form v-on:submit.prevent="editarPass">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Cambiar contraseña</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <label for="new_pass"><b>Nueva contraseña:</b></label>
                                <input type="password" class="form-control" name="new_pass" v-model="new_pass" id="new_pass"
                                    aria-describedby="helpId" placeholder="Nueva contraseña">
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label for="confirmar_pass"><b>Confirmar contraseña:</b></label>
                                <input type="password" class="form-control" name="confirmar_pass" v-model="confirmar_pass"
                                    id="confirmar_pass" aria-describedby="helpId" placeholder="Confirmar contraseña">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn-group w-100 mt-2 mb-2" role="group" aria-label="">
                    <button type="submit" class="btn btn-success m_izq" title="Guardar">
                        <i class="fa fa-save"></i>
                    </button>
                    <button class="btn btn-warning m_der" @click="mostrarCuenta()" title="Volver">
                        <i class="bi bi-arrow-return-left fw-bold"></i>
                    </button>
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
            user: [],
            mostrar_datos: true,
            mostrar_password: false,
            new_pass: "",
            confirmar_pass: "",
        }
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
                const response = await axios.get('users');
                console.log(response.data); // Agregar esta línea para depurar
                this.user = response.data.user;
                console.log(this.user.name);
            } catch (error) {
                console.error(error);
            }
        },

        async mostrarPassword() {
            this.mostrar_datos = false;
            this.mostrar_password = true;
        },

        async mostrarCuenta() {
            this.mostrar_datos = true;
            this.mostrar_password = false;
        },

        // Edita password en la base de datos
        async editarPass() {

            if (this.new_pass === this.confirmar_pass && this.new_pass !== "") {

                const res = await axios.put('users/' + this.new_pass)
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
                            title: 'Error actualizar contraseña',
                            text: 'Ingresa los campos correctamente',
                        })
                    });

            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'Error actualizar contraseña',
                    text: 'Las contraseñas no son iguales',
                })

            }

        },

    }



}

</script>