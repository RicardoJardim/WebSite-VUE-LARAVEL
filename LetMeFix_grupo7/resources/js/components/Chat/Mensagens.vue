<template>
    <div class="chat_messages">
        <mensagemComponent
            v-for="mensagem in mensagens" 
            :key="mensagem.id" 
            :mensagem="mensagem">
        </mensagemComponent>        
    </div>
</template>

<style scoped>
    .chat_messages {
        height: 600px;
        max-height: 600px;
        overflow-y: auto;
        padding: 15px;
        border-bottom: 1px solid #eee;

    }
</style>

<script>
  import mensagemComponent from './Mensagem.vue'
  import Event from './event.js';

  export default {
    data() {
      return {
        mensagens: []
      }
    },
    components: {
      mensagemComponent
    },
    mounted() {
        axios.get(`http://localhost:8000/api/mensagem/${this.$route.params.id}`).then((response) => {
            this.mensagens = response.data.mensagens;
        })
        .then(response => { 
          console.log(response.data)
        })
        .catch(error => {
            console.log(error.response)
        })
        Event.$on('added_message', (mensagem) => {
            this.mensagens.push(mensagem);
        });
    }
  }
</script>

