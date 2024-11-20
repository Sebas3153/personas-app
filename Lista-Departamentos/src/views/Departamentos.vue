<template>
    <div class="container">
      <h1>Listado de Departamentos |
        <button @click="newDepartamento()" class="btn btn-success mx-2">
          <font-awesome-icon icon="plus" />
        </button>
      </h1>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Código</th>
            <th scope="col">Nombre</th>
            <th scope="col">Municipios</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(departamento, index) in departamentos" :key="index">
            <th scope="row">{{ index + 1 }}</th>
            <td>{{ departamento.depto_codi }}</td>
            <td>{{ departamento.depto_nomb }}</td>
            <td v-if="departamento.municipios && departamento.municipios.length > 0">
              <ul>
                <li v-for="municipio in departamento.municipios" :key="municipio.muni_codi">
                  {{ municipio.muni_nomb }}
                </li>
              </ul>
            </td>
            <td v-else>
              Sin municipios
            </td>
            <td>
              <button @click="editDepartamento(departamento.depto_codi)" class="btn btn-warning mx-2">
                <font-awesome-icon icon="pencil" />
              </button>
              <button @click="deleteDepartamento(departamento.depto_codi)" class="btn btn-danger mx-2">
                <font-awesome-icon icon="trash" />
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
import axios from 'axios';

export default {
  data() {
    return {
      error: null
    };
  },
  methods: {
    fetchData() {
      axios.get('http://127.0.0.1:8000/api/departamentos')
        .then(response => {
          // Handle successful response
        })
        .catch(error => {
          this.error = error;
          console.error('Error fetching data:', error);
        });
    }
  }
}
</script>