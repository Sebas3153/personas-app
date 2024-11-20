<template>
    <div class="container text-start">
        <h1 class="text-primary fw-bold">New</h1>
        <div class="card">
            <div class="card-header fw-bold">
                Comuna
            </div>
            <div class="card-body">
                <form @submit.prevent="saveComuna">
                    <div class="row mb-3">
                        <label for="comu_codi" class="form-label">Código:</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <font-awesome-icon icon="tag" />
                            </div>
                            <input type="text" class="form-control" id="comu_codi" placeholder="Código Comuna" v-model="comuna.comu_codi">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="comu_nomb" class="form-label">Nombre:</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <font-awesome-icon icon="building" />
                            </div>
                            <input type="text" class="form-control" id="comu_nomb" placeholder="Nombre Comuna" v-model="comuna.comu_nomb">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="muni_codi" class="form-label">Municipio:</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <font-awesome-icon icon="bank" />
                            </div>
                            <select class="form-select" v-model="comuna.muni_codi">
                                <option selected value="0">Seleccione un Municipio</option>
                                <option v-for="municipio in municipios" v-bind:value="municipio.muni_codi">
                                    {{ municipio.muni_nomb }}
                                </option>
                            </select>
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
    name: 'NewComuna',
    data() {
        return {
            comuna: {
                comu_codi: '',
                comu_nomb: '',
                muni_codi: 0,
            },
            municipios: []
        };
    },
    methods: {
        cancelar() {
            this.$router.push({ name: 'Comunas' });
        },

        async saveComuna() {
            try {
                const res = await axios.post('http://127.0.0.1:8000/api/comunas', this.comuna);

                if (res.status === 200 || res.status === 201) {
                    this.$router.push({ name: 'Comunas' });
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Comuna has been created',
                        showConfirmButton: false,
                        timer: 2000,
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was an issue creating the comuna!',
                });
            }
        },
    },

    mounted() {
        axios.get('http://127.0.0.1:8000/api/municipios')
            .then(response => {
                this.municipios = response.data.municipios;
            })
            .catch(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Could not load municipalities!',
                });
            });
    },
};
</script>
