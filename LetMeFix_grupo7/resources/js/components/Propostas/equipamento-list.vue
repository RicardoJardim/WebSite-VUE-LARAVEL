<template>
<div>
    <center> <h3>Lista de Equipamento</h3> </center>
    <div class="alert alert-danger" v-if="has_error">
       <center > <p>Não é possível apresentar o equipamento de momento</p> </center>
    </div>

    <table class="table">
        <tr>
            <th scope="col">Item</th>
        </tr>
        <tr v-for="teste in equipamento.item" style="margin-bottom: 5px;">
            <td scope="row">{{ teste }}</td>
        </tr>
    </table>

</div>
</template>

<script>
  export default {
    data() {
      return {
        has_error: false,
        equipamento: '',
      }
    },

    mounted() {
        axios.get(`http://localhost:8000/api/me/propostas/equipamento/${this.$route.params.id}`).then((response) => {
            this.equipamento = response.data.equipamento;
        }, () => {
          this.has_error = true
        })
        .catch(error => {
            console.log(error.response)
        });
    }
  }
</script>