<template>
<div>
    <center> <h3>Registo de Horas</h3> </center>
    <div class="alert alert-danger" v-if="has_error">
       <center > <p>Não é possível apresentar o registo de horas de momento</p> </center>
    </div>

    <table class="table">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Data</th>
            <th scope="col">Justificação</th>
        </tr>
        <tr v-for="hora in horas" :key="hora.id" style="margin-bottom: 5px;">
            <th scope="row">{{ hora.id }}</th>
            <td>{{ hora.dia }}</td>
            <td>{{ hora.justificacao }}</td>
        </tr>
    </table>

</div>
</template>

<script>
  export default {
    data() {
      return {
        has_error: false,
        horas: []
      }
    },

    mounted() {
        axios.get(`http://localhost:8000/api/me/propostas/horas/${this.$route.params.id}`).then((response) => {
            this.horas = response.data.hora;
        }, () => {
          this.has_error = true
        })
        .catch(error => {
            console.log(error.response)
        });
    }
  }
</script>