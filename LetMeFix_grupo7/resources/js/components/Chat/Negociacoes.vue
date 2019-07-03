<template>
    <div class="col-md-4">
        <div class="card">
            <h2> <div class="card-header text-center">Negociações</div> </h2>
            <button class="btn btn-danger open-button btn-lg btn-block" @click='openNegociacao()'>Criar Negociação</button>
            <div class="card-body">
                <negociacaoComponent
                    v-for="negociacao in negociacoes" 
                    :key="negociacao.id" 
                    :negociacao="negociacao">
                </negociacaoComponent>   
            </div>

            <div class="form-add" id="myForm">
              <form autocomplete="off" @submit.prevent="addNegociacao" method="post" class="form-container">
                <h1>Negociação</h1>

                <label for="titulo"><b>Título</b></label>
                <input type="text" id="titulo" class="form-control" placeholder="Introduza um título" name="titulo" v-model="titulo" required>

                <label for="data_inicio"><b>Data de início</b></label>
                <input type="date" id="data_inicio" v-model="data_inicio" class="form-control" name="data_inicio" required>

                <label for="data_final"><b>Data de finalização</b></label>
                <input type="date" id="data_final" v-model="data_final" class="form-control" name="data_final" required>

                <label for="custo"><b>Custo</b></label>
                <input type="number" id="custo" v-model="custo" class="form-control" name="custo" min="1" required>

                <label for="descricao"><b>Descrição</b></label>
                <input type="text" class="form-control" id="descricao" v-model="descricao" placeholder="Justificação das opções" name="descricao" required>

                <button type="submit" class="btn" @click="reloadPage()" >Criar</button>
                <button type="button" class="btn cancel" @click="closeNegociacao()">Fechar</button>
              </form>
            </div>
        </div>
    </div>
</template>

<style scoped>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* The popup form - hidden by default */
.form-add {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>


<script>
  
  import negociacaoComponent from './Negociacao.vue'

  export default {
    data() {
      return {
        negociacoes: [],
        titulo: '',
        data_inicio: '',
        data_final: '',
        custo: '',
        descricao: '',
        conversa_id: '',
        has_error: false,
        erro: '',
        errors: {},
      }
    },
    components: {
      negociacaoComponent
    },
    mounted() {
        axios.get(`http://localhost:8000/api/negociacao/${this.$route.params.id}`).then((response) => {
            this.negociacoes = response.data.negociacoes;
        })
        .then(response => { 
          console.log(response.data)
        })
        .catch(error => {
            console.log(error.response)
        });
    },
    methods:{
      reloadPage: function(){
        window.location.reload()
      },
      openNegociacao: function()
        {
        document.getElementById("myForm").style.display = "block";
      },
      closeNegociacao: function() 
      {
        document.getElementById("myForm").style.display = "none";
      },
      addNegociacao: function()
      {
        axios.post('http://localhost:8000/api/negociacao/create', {
            titulo: this.titulo,
            data_inicio: this.data_inicio,
            data_final: this.data_final,
            custo: this.custo,
            descricao: this.descricao,
            conversa_id: this.$route.params.id
        }).catch(error => {
            console.log(error.response)
            this.has_error = true
            this.error = error.response.data.error
            this.errors = error.response.data.errors || {}
        });
      }
    }
  }
</script>

