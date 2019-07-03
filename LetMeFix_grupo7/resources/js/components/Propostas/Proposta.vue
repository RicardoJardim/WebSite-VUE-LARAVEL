<template>
<body>
    <b>Data limite:</b> {{ proposta.proposta.data_fim_proposta }}
    <button class="open-button btn-lg btn-block" @click='openProposta()'><b>{{proposta.user.nome }}:</b> {{ proposta.proposta.descricao }}
    </button>
    <div class="form-popup" v-bind:id="proposta.proposta.id">
      <form action="/#" class="form-container">

        <p><b>Estado:</b> {{ proposta.proposta.estado }}</p>
        <p><b>Especialidade:</b> {{ proposta.proposta.especialidade }}</p>
        <p><b>Descrição:</b> {{ proposta.proposta.descricao }}</p>
        <p><b>Data de criação:</b> {{ proposta.proposta.created_at }}</p>

        <button type="button" class="btn btn-success btn-block float-right" @click="createConversa()">Responder</button>
        
      </form>
    </div>
    <hr>
</body>
</template>

<style scoped>

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #054f77;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

.form-container .btn {
  color: white;
  border: none;
  cursor: pointer;
  opacity: 0.8;
}

/* Add styles to the form container */
.form-container {
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
export default {
    props: ['proposta'],

    methods:{
        openProposta: function()
        {
          if (document.getElementById(this.proposta.proposta.id).style.display == "block") 
          {
            document.getElementById(this.proposta.proposta.id).style.display = "none";
          }
          else{
            document.getElementById(this.proposta.proposta.id).style.display = "block";
          }
        },
        createConversa: function()
        { 
          axios.post(`http://localhost:8000/api/conversa/create/${this.proposta.proposta.id}`, {

          }).catch(error => {
              console.log(error.response)
              this.has_error = true
              this.error = error.response.data.error
              this.errors = error.response.data.errors || {}
          });
          this.$router.push({name: 'ChatGlobal'})
        }
    }
}
    
</script>


