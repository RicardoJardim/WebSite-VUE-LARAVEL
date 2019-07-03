<template>
    <div class="container">
        <div class="card card-default">
            <h2> <div class="card-header">Proposta</div> </h2>

            <div class="card-body">
                <div class="alert alert-danger" v-if="has_error && !success">
                    <p v-if="error == 'proposta_error'">Dados incorretos</p>
                    <p v-else>Impossível criar a proposta de momento, tente mais tarde!</p>
                </div>

                <form autocomplete="off" @submit.prevent="addprop" method="post">

                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.especialidade }">
                        <label for="especialidade">Especialidade</label>
                        <select id='especialidade' class="form-control" v-model="especialidade">
                            <option value='eletricidade'>Eletricista</option>
                            <option value='construcao'>Construtor</option>
                            <option value='canalizacao'>Canalizador</option>
                            <option value='carpintaria'>Carpinteiro</option>
                        </select> 
                        <span class="help-block" v-if="has_error && errors.especialidade">{{ errors.especialidade }}</span>
                    </div>

                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.descricao }">
                        <label for="descricao">Descrição</label>
                        <input type="text" id="descricao" class="form-control" placeholder="Descrição da proposta" v-model="descricao">
                        <span class="help-block" v-if="has_error && errors.descricao">{{ errors.descricao }}</span>
                    </div>

                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.morada }">
                        <label for="morada">Morada</label>
                        <input type="text" id="morada" class="form-control" placeholder="Morada da obra" v-model="morada">
                        <span class="help-block" v-if="has_error && errors.morada">{{ errors.morada }}</span>
                    </div>

                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.data_fim_proposta }">
                        <label for="data_fim_proposta">Data de fim de proposta</label>
                        <input type="date" id="data_fim_proposta" v-model="data_fim_proposta">
                        <span class="help-block" v-if="has_error && errors.data_fim_proposta">{{ errors.data_fim_proposta }}</span>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">Criar Proposta</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        especialidade: '',
        descricao: '',
        morada: '',
        data_fim_proposta: '',
        has_error: false,
        erro: '',
        errors: {},
      }
    },

    methods: {
      addprop() 
      {
        axios.post('http://localhost:8000/api/proposta/create', {
            especialidade: this.especialidade,
            descricao: this.descricao,
            morada: this.morada,
            data_fim_proposta: this.data_fim_proposta
        }).catch(error => {
            console.log(error.response)
            this.has_error = true
            this.error = error.response.data.error
            this.errors = error.response.data.errors || {}
        });
        this.$router.push({name: 'propostas'})
      }
    }
  }
</script>

