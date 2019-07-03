<template>
    <div class="container">
        <div class="card card-default">
            <h2> <center> Admin Dashboard </center> </h2>
            <hr>
        </div>

        <button class="btn btn-danger open-button btn-lg btn-block" @click='openForm()'>Criar Funcionário</button>

        <div class="form-add" id="myForm">
          <form autocomplete="off" @submit.prevent="addFuncionario" method="post" class="form-container">
            <h1>Funcionário</h1>

            <label for="email"><b>Email</b></label>
            <input type="email" id="email" class="form-control" name="email" v-model="email" required>

            <label for="password"><b>Password</b></label>
            <input type="password" id="password" v-model="password" class="form-control" name="password" required>

            <button type="submit" class="btn" @click="reloadPage()" >Criar Funcionário</button>
            <button type="button" class="btn cancel" @click="closeForm()">Fechar</button>
          </form>
        </div>

        <div class="card card-default">
          <button class="btn btn-primary btn-lg btn-block" v-on:click="showPropostas = !showPropostas"> Propostas </button>
          <div v-show="showPropostas" class="card-body">
              <propostasComponent></propostasComponent>              
          </div>
        </div>

        <div class="card card-default">
          <button class="btn btn-success btn-lg btn-block" v-on:click="showUsers = !showUsers"> Utilizadores </button>
          <div v-show="showUsers" class="card-body">
              <usersComponent></usersComponent> 
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
  import propostasComponent from './propostas-list.vue'
  import usersComponent from './user-list.vue'
  export default {
    data() {
      return {
        showPropostas: false,
        showUsers: false,
        email: '',
        password: '',
      }
    },
    mounted() {
      //
    },
    components: {
      propostasComponent,
      usersComponent
    },
    methods:{
      reloadPage: function(){
        window.location.reload()
      },
      openForm: function()
        {
        document.getElementById("myForm").style.display = "block";
      },
      closeForm: function() 
      {
        document.getElementById("myForm").style.display = "none";
      },
      addFuncionario: function()
      {
        axios.post('http://localhost:8000/api/funcionario/create', {
            email: this.email,
            password: this.password,
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