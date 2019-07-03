<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-11">
          <div class="card">
            <h2> <div class="card-header">Propostas</div> </h2>
            <div v-if="user.user.tipo == 'privado'">
                <button type="submit" class="btn btn-default"><router-link class="user" v-bind:to="{ name: `propostaAdd` }"> Adicionar proposta </router-link></button>
            </div>
            <div v-else-if="user.user.tipo == 'comercial'">
                <button type="submit" class="btn btn-default"><router-link class="user" v-bind:to="{ name: `propostaAdd` }"> Adicionar proposta </router-link></button>
            </div>
            
            <div class="card-body">
                <div class="prop">
                    <propostaComponent
                        v-for="proposta in propostas" 
                        :key="proposta.id" 
                        :proposta="proposta">
                    </propostaComponent>        
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</template>

<script>
  import propostaComponent from './Proposta.vue'

  export default {
    data() {
      return {
        propostas: [],
        user: []
      }
    },
    components: {
      propostaComponent
    },
    mounted() {
        axios.get(`http://localhost:8000/api/propostas`).then((response) => {
            this.propostas = response.data;
        })
        .then(response => { 
          console.log(response.data)
        })
        .catch(error => {
            console.log(error.response)
        })
        axios.get(`http://localhost:8000/api/me`).then((response) => {
            this.user = response.data.user;
        })
        .then(response => { 
          console.log(response.data)
        })
        .catch(error => {
            console.log(error.response)
        });
    }
  }
</script>

