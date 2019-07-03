<template>
  <div class="container">
    <div class="row justify-content-center">

      <div class="col-md-8">
          <div class="card">
            <h2> <div class="card-header text-center">Chat</div> </h2>
            <div class="card-body">
              <small > <b> <i> <center> Bem vindo ao chat LetMeFix, todas as negociação deverão ser tratadas com respeito e qualquer tipo de tentativa engano não será tolerado</center> </i> </b> </small>
              <mensagensComponent></mensagensComponent>
              <formComponent></formComponent>
            </div>
          </div>
      </div>
      <negociacoesComponent></negociacoesComponent>
    </div>
  </div>
</template>

<script>
  import negociacoesComponent from './Negociacoes.vue'
  import mensagensComponent from './Mensagens.vue'
  import formComponent from './Form.vue'

  export default {
    data() {
      return {
        //
      }
    },
    components: {
      negociacoesComponent,
      mensagensComponent,
      formComponent
    }
  }
</script>