<template>
    <div>
        ficha hemograma
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2'
export default {
    data() {
        return {
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
                mascotas_id: null,
                visita_id: null,
            },
            id: 1,
        };
    },

    created() {
        console.log(this.id)
        this.obtenerInformacionID(this.id);
        const token = document.querySelector('meta[name="csrf-token"]');
        if (token) {
            this.csrfToken = token.content;
        }
    },

    methods: {
        async obtenerInformacionID(id) {
            try {
                const response = await axios.get('hemogramas/' + id);
                console.log(response.data); // Agregar esta línea para depurar
                this.hemograma = response.data;
                await this.consultar_municipio(false);
            } catch (error) {
                console.error(error);
            }
        },

    },

};
</script>