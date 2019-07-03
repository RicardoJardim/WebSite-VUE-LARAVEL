<template>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-11">
        <div class="card">
          <h2> <div class="card-header">Proposta <button class="btn btn-danger open-button float-right" @click='endProposta()'>Dar obra por terminada</button></div> </h2>

          <div class="card-body">

            <div v-if="proposta.profissional == true">
              <button class="btn btn-success float-right btn-sm">Profissional</button>
            </div>
            <div v-else-if="proposta.profissional == false">
              <button class="btn btn-warning float-right btn-sm">Profissional</button>
            </div>
            <div v-if="proposta.user == true">
              <button class="btn btn-success float-right btn-sm">Cliente</button>
            </div>
            <div v-else-if="proposta.user == false">
              <button class="btn btn-warning float-right btn-sm">Cliente</button>
            </div>

            <div v-if="proposta.avaliar == false">
              <button class="btn btn-dark open-button" disabled>Avaliar</button>
            </div>
            <div v-else-if="proposta.avaliar == true">
              <button class="btn btn-warning open-button" @click='openAvaliacao()'>Avaliar</button>
            </div>
            

            <p><b>Estado:</b> {{ proposta.estado }}</p>
            <p><b>Especialidade:</b> {{ proposta.especialidade }}</p>
            <p><b>Descrição:</b> {{ proposta.descricao }}</p>
            <p><b>Morada:</b> {{ proposta.morada }}</p>
            <p><b>Data início de obra:</b> {{ proposta.data_inicio }}</p>
            <p><b>Data fim de obra:</b> {{ proposta.data_final }}</p>


            <div class="bloco">
              <div class="grupo">
                <button class="teste btn btn-info open-button" @click='openEquipamento()'>Adicionar registo de equipamento</button>
                <button class="teste btn btn-info open-button" @click='openHoras()'>Adicionar registo de horas</button>
              </div>
            </div>

        </div>      

        </div>

        <div class="form-add" id="horasForm">
          <form autocomplete="off" @submit.prevent="insertHora" method="post" class="form-container">
            <h1>Registo</h1>

            <label for="dia"><b>Dia</b></label>
            <input type="date" id="dia" class="form-control" name="dia" v-model="dia" required>

            <label for="justificacao"><b>Descrição</b></label>
            <input type="text" id="justificacao" v-model="justificacao" class="form-control" name="justificacao" required>

            <button type="submit" class="btn" @click="reloadPage()">Criar Registo</button>
            <button type="button" class="btn cancel" @click="openHoras()">Fechar</button>
          </form>
        </div>

        <div class="form-add" id="equipamentoForm">
          <form autocomplete="off" @submit.prevent="insertEquipamento" method="post" class="form-container">   
            <h1> Equipamento </h1>                
              <label for="equipamento">Equipamento utilizado</label>
                <input type="text" id="equipamento" placeholder="e.g. rebarbadora, martelo.." v-model="equip_input">
                <img width="30" height="30" src="/add.png" alt="add" @click="addEquipamento(equip_input)"/>

            <div v-if="!equipamento.lenght">
              <h4 v-for="(value, index) in equipamento" v-bind:key="index">
                <b> {{ value }} </b> <img width="30" height="30" src="/remove.png" alt="remove" @click="remEquipamento(index)"/>
              </h4>
            </div>

            <button type="submit" class="btn" @click="reloadPage()">Inserir Equipamento</button>
            <button type="button" class="btn cancel" @click="openEquipamento()">Fechar</button>
          </form>
        </div>

        <div class="form-add" id="avaliacaoForm">
          <form autocomplete="off" @submit.prevent="insertAvaliacao" method="post" class="form-container">
            <h1>Avaliação</h1>

            <label for="descricao"><b>Comentário</b></label>
            <input type="text" id="descricao" class="form-control" name="descricao" v-model="descricao" required>

            <label for="avaliacao">Avaliacao</label>
            <select id='avaliacao' class="form-control" v-model="avaliacao">
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
                <option value='5'>5</option>
            </select> 

            <button type="submit" class="btn" @click="reloadPage()">Avaliar serviço</button>
            <button type="button" class="btn cancel" @click="openAvaliacao()">Fechar</button>
          </form>
        </div>

        <div class="card card-default">
          <button class="btn btn-primary btn-lg btn-block" v-on:click="showPropostas = !showPropostas"> Equipamento </button>
          <div v-show="showPropostas" class="card-body">
              <propostasComponent></propostasComponent>              
          </div>
        </div>

        <div class="card card-default">
          <button class="btn btn-primary btn-lg btn-block" v-on:click="showUsers = !showUsers"> Registo de horas </button>
          <div v-show="showUsers" class="card-body">
              <usersComponent></usersComponent> 
          </div>
        </div>     
    </div>
  </div>
  </div>
</template>

<style scoped>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

.bloco {
  position: relative;
}
.bloco .grupo {
  width: 100%;
}
.teste{
  width: 49%;
}

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
  max-width: 400px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
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
  import propostasComponent from './equipamento-list.vue'
  import usersComponent from './horas-list.vue'
  export default {
    data() {
      return {
        showPropostas: false,
        showUsers: false,
        proposta: [],
        has_error: false,
        error: '',
        errors: {},
        success: false,
        justificacao: '',
        descricao: '',
        avaliacao: '',
        dia: '',
        equipamento: [],
        equip_input: '',
      }
    },
    mounted() {
        axios.get(`http://localhost:8000/api/propostas/${this.$route.params.id}`).then((response) => {
            this.proposta = response.data.proposta;
        })
        .then(response => { 
          console.log(response.data)
        })
        .catch(error => {
            console.log(error.response)
        });
    },
    components: {
      propostasComponent,
      usersComponent
    },
    methods:{
      reloadPage: function(){
        window.location.reload()
      },
      openHoras: function()
      {
        if (document.getElementById("horasForm").style.display == "block") 
        {
          document.getElementById("horasForm").style.display = "none";
        }
        else{
          document.getElementById("horasForm").style.display = "block";
        }
      },
      openEquipamento: function()
      {
        if (document.getElementById("equipamentoForm").style.display == "block") 
        {
          document.getElementById("equipamentoForm").style.display = "none";
        }
        else{
          document.getElementById("equipamentoForm").style.display = "block";
        }
      },
      openAvaliacao: function()
      {
        if (document.getElementById("avaliacaoForm").style.display == "block") 
        {
          document.getElementById("avaliacaoForm").style.display = "none";
        }
        else{
          document.getElementById("avaliacaoForm").style.display = "block";
        }
      },
      addEquipamento: function(equip_input) {
      if (equip_input) {
        this.equipamento.push(equip_input);
        this.equip_input = "";
      }
      },
      remEquipamento: function(index) {
        this.equipamento.splice(index, 1);
      },
      insertEquipamento() 
      {
        axios.post(`http://localhost:8000/api/me/propostas/equipamento/create/${this.$route.params.id}`, {
            equipamento: this.equipamento
        }).catch(error => {
            console.log(error.response)
            this.has_error = true
            this.error = error.response.data.error
            this.errors = error.response.data.errors || {}
        });
      },
      insertHora() 
      {
        axios.post(`http://localhost:8000/api/me/propostas/horas/create/${this.$route.params.id}`, {
            justificacao: this.justificacao,
            dia: this.dia,
        }).catch(error => {
            console.log(error.response)
            this.has_error = true
            this.error = error.response.data.error
            this.errors = error.response.data.errors || {}
        });
      },
      insertAvaliacao() 
      {
        axios.post(`http://localhost:8000/api/me/propostas/avaliacao/create/${this.$route.params.id}`, {
            descricao: this.descricao,
            avaliacao: this.avaliacao,
        }).catch(error => {
            console.log(error.response)
            this.has_error = true
            this.error = error.response.data.error
            this.errors = error.response.data.errors || {}
        });
      },
      endProposta() 
      {
        axios.put(`http://localhost:8000/api/me/propostas/end/${this.$route.params.id}`, {
        }).catch(error => {
            console.log(error.response)
            this.has_error = true
            this.error = error.response.data.error
            this.errors = error.response.data.errors || {}
        });
        this.$router.push({name: 'me'})
      },
    }
  }
</script>