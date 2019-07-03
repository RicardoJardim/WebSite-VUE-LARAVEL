<template>
  <div>
    <b-card class="text-left">
      <b-card-text>
        <div> <a <router-link class="user" v-bind:to="{ path: `/user/${getObject.profissional.user.id}` }"> <button type="button"  class="btn btn-outline-primary open-button float-right" @click='reloadPage()' >Visitar</button> </router-link></a> </div>

        <h4><b>{{ getObject.profissional.user.nome }}</b>: {{ getObject.descricao }}</a></h4>
        <h4>Descrição da obra: {{ getObject.proposta.descricao }}</h4>
        <h4>Custo: {{ getObject.proposta.custo_inicial }}€</h4>
        <i>{{ getObject.proposta.data_inicio }} a {{ getObject.proposta.data_final }}</i>
        <div class="float-right" v-if="bool == true">
            <img
              class="stars"
              src="/star.png"
              v-for="index in getObject.avaliacao"
              alt="stars"
              v-bind:key="index"
              width="60" 
              height="60"
            />
          </div>        
      </b-card-text>
    </b-card>
  </div>
</template>

<script>
export default {
  props: {
    getObject: Object
  },
  data() {
    return {
      bool: null
    };
  },
  created() {
    //Verifica se a avaliação é um inteiro ou um double
    if (this.getObject.avaliacao % 1 == 0) {
      this.bool = true;
    } else {
      this.bool = false;
    }
  },
  methods:{
      reloadPage: function()
      {
        setTimeout(function(){ window.location.reload();});
        
      },
    }
};
</script>

<style lang="scss" scoped>
@import "~vue-material/dist/theme/engine";
.text-left {
  margin-left: 1%;
  margin-right: 1%;
}

@import "~vue-material/dist/theme/all";
</style>