<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
          <div class="card">
            <h2> <div class="card-header">Minhas Propostas</div> </h2>
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
  import propostaComponent from './MinhaProposta.vue'

  export default {
    data() {
      return {
        propostas: []
      }
    },
    components: {
      propostaComponent
    },
    mounted() {
        axios.get(`http://localhost:8000/api/me/propostas`).then((response) => {
            this.propostas = response.data;
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

