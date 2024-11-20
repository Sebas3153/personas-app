<template>
    <div class="container text-start">
        <h1 class="text-primary fw-bold">Editar Municipio</h1>
        <div class="card">
            <div class="card-header fw-bold">
                Municipio
            </div>
            <div class="card-body">
                <form @submit.prevent="updateMunicipio">
                    <div class="row mb-3">
                        <label for="muni_codi" class="form-label">Código:</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <font-awesome-icon icon="tag" />
                            </div>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="muni_codi" 
                                placeholder="Código Municipio" 
                                v-model="municipio.muni_codi" 
                                disabled />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="muni_nomb" class="form-label">Nombre:</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <font-awesome-icon icon="building" />
                            </div>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="muni_nomb" 
                                placeholder="Nombre Municipio" 
                                v-model="municipio.muni_nomb" />
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Actualizar</button>
                    <button class="btn btn-secondary mx-2" @click="cancelar">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    name: 'EditMunicipio',
    data() {
        return {
            municipio: {
                muni_codi: null,
                muni_nomb: '',
            },
        };
    },
    methods: {
        cancelar() {
            this.$router.push({ name: 'Municipios' });
        },

        async updateMunicipio() {
            try {
                const res = await axios.put(`http://127.0.0.1:8000/api/municipios/${this.municipio.muni_codi}`, this.municipio);

                if (res.status === 200) {
                    this.$router.push({ name: 'Municipios' });
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Municipio actualizado correctamente',
                        showConfirmButton: false,
                        timer: 2000,
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al actualizar el municipio.',
                });
            }
        },
    },

    mounted() {
        const id = this.$route.params.id;

        axios.get(`http://127.0.0.1:8000/api/municipios/${id}`).then(response => {
            this.municipio = response.data.municipio;
        }).catch(() => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo cargar la información del municipio.',
            });
        });
    },
};
</script>
