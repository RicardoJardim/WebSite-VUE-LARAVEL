<template>
<body>
	<button class="open-button btn-lg btn-block" @click='openNegociacao()'>{{negociacao.titulo}}</button>
	<div class="form-popup" v-bind:id="negociacao.id">
	  <form action="/#" class="form-container">

	    <p><b>Descrição:</b> {{negociacao.descricao}}</p>
	    <p><b>Data de início:</b> {{negociacao.data_inicio}}</p>
	    <p><b>Data de finalização:</b> {{negociacao.data_final}}</p>
	    <p><b>Custo:</b> {{negociacao.custo}} €</p>

	    <button type="button" class="btn btn-lg btn-block" @click="addNegociacao()">Aceitar</button>
	    <button type="button" class="btn cancel" @click="closeNegociacao()">Recusar</button>
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
export default {
	props: ['negociacao'],

	methods:{
		openNegociacao: function()
	    {
		  	document.getElementById(this.negociacao.id).style.display = "block";
		},
		closeNegociacao: function() 
		{
		  	document.getElementById(this.negociacao.id).style.display = "none";
		},
		addNegociacao: function()
  		{
        	axios.put(`http://localhost:8000/api/propostas/update/${this.negociacao.id}`, {

	        }).catch(error => {
	            console.log(error.response)
	            this.has_error = true
	            this.error = error.response.data.error
	            this.errors = error.response.data.errors || {}
	        });
          this.$router.push({path: '/me'})
      	}
	}
}
    
</script>

