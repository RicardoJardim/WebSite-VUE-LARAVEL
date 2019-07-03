<template>
    <div class="chat_messages">
        <conversaComponent
            v-for="conversa in conversas" 
            :key="conversa.id" 
            :conversa="conversa">
        </conversaComponent>        
    </div>
</template>

<style scoped>
    .chat_messages {
        height: auto;
        max-height: 400px;
        overflow-y: scroll;
        padding: 15px;
        border-bottom: 1px solid #eee;
    }
</style>



<script>
  
  import conversaComponent from './Conversa.vue'

  export default {
    data() {
      return {
        conversas: []
      }
    },
    components: {
      conversaComponent
    },
    mounted() {
        axios.get("http://localhost:8000/api/conversas").then((response) => {
            this.conversas = response.data.conversas;
        })
        .then(response => { 
          console.log(response.data)
        })
        .catch(error => {
            console.log(error.response)
        });
    }
  }
</script>

