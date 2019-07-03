<template>
<div>
    <center> <h3>Histórico de Propostas</h3> </center>
    <div class="alert alert-danger" v-if="has_error">
       <center > <p>Não é possível apresentar as propostas de momento</p> </center>
    </div>

    <table class="table">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Área</th>
            <th scope="col">Data</th>
            <th scope="col">Descrição</th>
            <th scope="col">Morada</th>
            <th scope="col">Custo</th>
        </tr>
        <tr v-for="proposta in propostas" :key="proposta.id" style="margin-bottom: 5px;">
            <th scope="row">{{ proposta.id }}</th>
            <td>{{ proposta.especialidade }}</td>
            <td>De {{ proposta.data_inicio }} a {{ proposta.data_final }}</td>
            <td>{{ proposta.descricao}}</td>
            <td>{{ proposta.morada}}</td>
            <td>{{ proposta.custo_inicial}}</td>
        </tr>
    </table>

</div>
</template>

<script>
  export default {
    data() {
      return {
        has_error: false,
        propostas: []
      }
    },

    mounted() {
        axios.get("http://localhost:8000/api/me/finalizadas").then((response) => {
            this.propostas = response.data.propostas
        }, () => {
          this.has_error = true
        })
        .catch(error => {
            console.log(error.response)
        });
    }
  }
</script>