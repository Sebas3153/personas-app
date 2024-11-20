<template>
    <div class="container text-start">
        <h1 class="text-primary fw-bold">Nuevo Municipio</h1>
        <div class="card">
            <div class="card-header fw-bold">
                Municipio
            </div>
            <div class="card-body">
                <form @submit.prevent="saveMunicipio">
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
                                disabled 
                                v-model="municipio.muni_codi" />
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

                    <button class="btn btn-primary" type="submit">Guardar</button>
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
    name: 'NewMunicipio',
    data() {
        return {
            municipio: {
                muni_codi: '',
                muni_nomb: '',
            },
        };
    },
    methods: {
        cancelar() {
            this.$router.push({ name: 'Municipios' });
        },

        async saveMunicipio() {
            try {
                const res = await axios.post('http://127.0.0.1:8000/api/municipios', this.municipio);

                if (res.status === 200 || res.status === 201) {
                    this.$router.push({ name: 'Municipios' });
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Municipio ha sido creado',
                        showConfirmButton: false,
                        timer: 2000,
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '¡Hubo un problema al crear el municipio!',
                });
            }
        },
    },
};
</script>
