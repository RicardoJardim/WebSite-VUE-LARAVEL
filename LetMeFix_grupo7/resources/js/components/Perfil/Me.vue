<template>
    <div v-if="user.user.tipo == 'profissional'">
        <profissionalComponent></profissionalComponent>
    </div>
    <div v-else-if="user.user.tipo == 'privado'">
        <privadoComponent></privadoComponent>
    </div>
    <div v-else-if="user.user.tipo == 'comercial'">
        <comercialComponent></comercialComponent>
    </div>

</template>


<script>
import profissionalComponent from './MeProfissional.vue'
import privadoComponent from './MePrivado.vue'
import comercialComponent from './MeComercial.vue'
3
  export default {
    data() {
      return {
        user: [],
      }
    },
    components: {
        profissionalComponent,
        privadoComponent,
        comercialComponent,
    },
    mounted() {
        axios.get(`http://localhost:8000/api/me`).then((response) => {
            this.user = response.data.user;
        })
        .then(response => { 
          console.log(response.data)
        })
        .catch(error => {
            console.log(error.response)
        })
    }
  }
</script>

